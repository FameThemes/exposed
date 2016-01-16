/*
   ========================================================
        script: image-flow
        author: Gerard Ferrandez - [Ge1doot]
          date: March 15, 2008
           maj: May 24, 2008 - AJAXification bank images
          site: http://www.dhteumeuleu.com
       license: CC-BY-NC - do not remove this notice
   ========================================================
*/

var imf = function() {
	var lf = 0;
	var instances = [];
	var AJAX = (function(AJAX) {
		return function(url) {
			var ajax = AJAX();
			ajax.open("GET", url, false);
			ajax.send("");
			return ajax;
		};
	})(this.XMLHttpRequest ?
	function() {
		return new XMLHttpRequest;
	} : function() {
		return new ActiveXObject("Microsoft.XMLHTTP");
	});
	function getElementsByClass(object, tag, className) {
		var o = object.getElementsByTagName(tag);
		for (var i = 0, n = o.length, ret = []; i < n; i++)
		if (o[i].className == className) ret.push(o[i]);
		if (ret.length == 1) ret = ret[0];
		return ret;
	}

	function addEvent(o, e, f) {
		if (window.addEventListener) o.addEventListener(e, f, false);
		else if (window.attachEvent) r = o.attachEvent('on' + e, f);
	}

	function createReflexion(cont, img) {
		var flx = false;
		if (document.createElement("canvas").getContext) {
			flx = document.createElement("canvas");
			flx.width = img.width;
			flx.height = img.height;
			var context = flx.getContext("2d");
			context.translate(0, img.height);
			context.scale(1, -1);
			context.drawImage(img, 0, 0, img.width, img.height);
			if (jQuery('#pp_enable_reflection').attr('value') != '') {
				flx.style.opacity = '0.3';
			} else {
				flx.style.opacity = '0';
			}
		} else {
			flx = document.createElement('img');
			flx.src = img.src;
			flx.style.filter = 'flipv progid:DXImageTransform.Microsoft.Alpha(' + 'opacity=50, style=1, finishOpacity=0, startx=0, starty=0, finishx=0, finishy=' + (img.height * .25) + ')';
		}
		flx.style.position = 'absolute';
		flx.style.left = '-4000px';
		cont.appendChild(flx);
		return flx;
	}

	function ImageFlow(oCont, xmlfile, horizon, size, zoom, border, start, interval) {
		this.diapos = [];
		this.scr = false;
		this.size = size;
		this.zoom = zoom;
		this.horizon = horizon;
		this.bdw = border;
		this.oCont = oCont;
		this.oc = document.getElementById(oCont);
		this.scrollbar = getElementsByClass(this.oc, 'div', 'scrollbar');
		this.text = getElementsByClass(this.oc, 'div', 'text');
		this.title = getElementsByClass(this.text, 'div', 'title');
		this.legend = getElementsByClass(this.text, 'div', 'legend');
		this.bar = getElementsByClass(this.oc, 'img', 'bar');
		this.arL = getElementsByClass(this.oc, 'img', 'arrow-left');
		this.arR = getElementsByClass(this.oc, 'img', 'arrow-right');
		this.bw = this.bar.width;
		this.alw = this.arL.width - 5;
		this.arw = this.arR.width - 5;
		this.bar.parent = this.oc.parent = this;
		this.arL.parent = this.arR.parent = this;
		this.view = this.back = -1;
		this.time_start = start * 62.5 || 0;
		this.time_inter = interval * 62.5 || 0;
		this.time_out = this.time_start;
		this.time = 0;
		this.time_dir = 1;
		this.resize();
		this.oc.onselectstart = function() {
			return false;
		}
		var bank = AJAX(xmlfile).responseXML.getElementsByTagName("bank").item(0).getElementsByTagName("img");
		this.NF = bank.length;
		for (var i = 0; i < this.NF; i++) {
			var img = bank.item(i);
			var val = function(tag) {
				var t = img.getElementsByTagName(tag);
				return (t.length && t[0].firstChild) ? t[0].firstChild.nodeValue : '';
			}
			this.diapos[i] = new Diapo(this, i, val("src"), val("title"), val("caption"), val("link"), val("target") || '_self');
		}
		if (window.addEventListener) this.oc.addEventListener('DOMMouseScroll', function(e) {
			if (e.preventDefault) e.preventDefault();
			this.parent.scroll(-e.detail);
			return false;
		}, false);
		this.oc.onmousewheel = function() {
			this.parent.scroll(event.wheelDelta);
			return false;
		}
		this.bar.onmousedown = function(e) {
			if (!e) e = window.event;
			var scl = e.screenX - this.offsetLeft;
			var self = this.parent;
			this.parent.oc.onmousemove = function(e) {
				if (!e) e = window.event;
				self.bar.style.left = Math.round(Math.min((self.ws - self.arw - self.bw), Math.max(self.alw, e.screenX - scl))) + 'px';
				self.view = Math.round(((e.screenX - scl)) / (self.ws - self.alw - self.arw - self.bw) * (self.NF - 1));
				if (self.view != self.back) self.calc();
				return false;
			}
			this.parent.oc.onmouseup = function(e) {
				self.oc.onmousemove = null;
				return false;
			}
			return false;
		}
		this.arR.onclick = this.arR.ondblclick = function() {
			if (this.parent.view < this.parent.NF - 1) this.parent.calc(1);
		}
		this.arL.onclick = this.arL.ondblclick = function() {
			if (this.parent.view > 0) this.parent.calc(-1);
		}
		var flipImf = this;
		jQuery('#imageFlow').touchwipe({
			wipeLeft: function() {
				flipImf.calc(1);
			},
			wipeRight: function() {
				flipImf.calc(-1);
			}
		});
		jQuery("body").keydown(function(e) {
			if (e.keyCode == 37) {
				flipImf.calc(-1);
			} else if (e.keyCode == 39) {
				flipImf.calc(1);
			}
		});
	}
	ImageFlow.prototype = {
		calc: function(inc) {
			if (inc) {
				this.view += inc;
				this.time = 0;
				this.time_out = this.time_start;
			}
			var tw = 0;
			var lw = 0;
			var o = this.diapos[this.view];
			if (o && o.loaded) {
				var ob = this.diapos[this.back];
				if (ob && ob != o) {
					ob.img.className = 'diapo';
					ob.z1 = 1;
				}
				this.title.innerHTML = o.title;
				this.legend.innerHTML = o.text;
				if (o.url) {
					o.img.className = 'diapo';
					window.status = 'hyperlink: ' + o.url;
				} else {
					o.img.className = 'diapo current';
					window.status = '';
				}
				if (o.r < 1) o.w1 = Math.min(o.iw, this.wh * .8, Math.round(this.ht * this.horizon / o.r)) * o.z1;
				else o.w1 = Math.round(this.ht * this.horizon / o.r) * o.z1;
				var x0 = o.x1 = (this.wh * .5) - (o.w1 * .5);
				var x = x0 + o.w1 + this.bdw;
				for (var i = this.view + 1, o; o = this.diapos[i]; i++) {
					if (o.loaded) {
						o.x1 = x;
						o.w1 = (this.ht / o.r) * this.size;
						x += o.w1 + this.bdw;
						tw += o.w1 + this.bdw;
					}
				}
				x = x0 - this.bdw;
				for (var i = this.view - 1, o; o = this.diapos[i]; i--) {
					if (o.loaded) {
						o.w1 = (this.ht / o.r) * this.size;
						o.x1 = x - o.w1;
						x -= o.w1 + this.bdw;
						tw += o.w1 + this.bdw;
						lw += o.w1 + this.bdw;
					}
				}
				if (!this.scr && tw) {
					var r = (this.ws - this.alw - this.arw - this.bw) / tw;
					this.bar.style.left = Math.round(this.alw + lw * r) + 'px';
				}
				this.back = this.view;
			}
		},
		scroll: function(sc) {
			if (sc < 0) {
				if (this.view < this.NF - 1) this.calc(1);
			} else {
				if (this.view > 0) this.calc(-1);
			}
		},
		resize: function() {
			this.wh = this.oc.clientWidth;
			this.ht = this.oc.clientHeight;
			this.ws = this.scrollbar.offsetWidth;
			this.calc();
			this.run(true);
		},
		run: function(res) {
			var i = this.NF;
			while (i--) this.diapos[i].move(res);
		}
	}
	Diapo = function(parent, N, src, title, text, url, target) {
		this.parent = parent;
		this.loaded = false;
		this.title = title;
		this.text = text;
		this.url = url;
		this.target = target;
		this.N = N;
		this.img = document.createElement('img');
		this.img.src = src;
		this.img.parent = this;
		this.img.className = 'diapo';
		this.x0 = this.parent.oc.clientWidth;
		this.x1 = this.x0;
		this.w0 = 0;
		this.w1 = 0;
		this.z1 = 1;
		this.z2 = 0;
		this.img.parent = this;
		this.img.onclick = function() {
			this.parent.click();
		}
		this.parent.oc.appendChild(this.img);
		if (url) {
			this.img.onmouseover = function() {
				this.className = 'diapo';
			}
			this.img.onmouseout = function() {
				this.className = 'diapo';
			}
		}
	}
	Diapo.prototype = {
		move: function(res) {
			var that = this.parent;
			if (this.loaded) {
				var sx = this.x1 - this.x0;
				var sw = this.w1 - this.w0;
				if (Math.abs(sx) > 2 || Math.abs(sw) > 2 || res) {
					this.x0 += sx * .1;
					this.w0 += sw * .1;
					var h = this.w0 * this.r;
					this.z2 = (that.ht * that.horizon + 1 - this.z2 - h) * .5;
					if (this.x0 < that.wh && this.x0 + this.w0 > 0) {
						this.visible = true;
						var o = this.img.style;
						o.left = Math.round(this.x0) + 'px';
						o.bottom = Math.floor(that.ht * (1 - that.horizon) + this.z2) + 'px';
						o.width = Math.round(this.w0) + 'px';
						o.height = Math.floor(h) + 'px';
						if (this.flx) {
							var o = this.flx.style;
							o.left = Math.round(this.x0) + 'px';
							o.top = Math.ceil(that.ht * that.horizon + 1 - this.z2) + 'px';
							o.width = Math.round(this.w0) + 'px';
							o.height = Math.floor(h) + 'px';
						}
					} else {
						if (this.visible) {
							this.visible = false;
							this.img.style.width = '0px';
							if (this.flx) this.flx.style.width = '0px';
						}
					}
				}
			} else {
				if (this.img.complete && this.img.width) {
					this.iw = this.img.width;
					this.ih = this.img.height;
					this.r = this.ih / this.iw;
					this.loaded = true;
					this.flx = createReflexion(that.oc, this.img);
					if (that.view < 0) that.view = this.N;
					else if (this.N == 0) {
						that.view = 1;
					}
					that.calc();
				}
			}
		},
		click: function() {
			this.parent.time = 0;
			this.parent.time_out = this.parent.time_start;
			if (this.parent.view == this.N) {
				if (this.url) {} else {}
			} else {
				this.parent.view = this.N;
				this.parent.calc();
			}
			return false;
		}
	}
	return {
		create: function(div, xmlfile, horizon, size, zoom, border, start, interval) {
			var load = function() {
				var loaded = false;
				var i = instances.length;
				while (i--) if (instances[i].oCont == div) loaded = true;
				if (!loaded) {
					instances.push(new ImageFlow(div, xmlfile, horizon, size, zoom, border, start, interval));
					if (!imf.initialized) {
						imf.initialized = true;
						addEvent(window, 'resize', function() {
							var i = instances.length;
							while (i--) instances[i].resize();
						});
						addEvent(document.getElementById(div), 'mouseout', function(e) {
							if (!e) e = window.event;
							var tg = e.relatedTarget || e.toElement;
							if (tg && tg.tagName == 'HTML') {
								var i = instances.length;
								while (i--) instances[i].oc.onmousemove = null;
							}
							return false;
						});
						setInterval(function() {
							var i = instances.length;
							while (i--) instances[i].run();
						}, 1);
					}
				}
                jQuery('#'+div+' .scrollbar').css('opacity','1');
			}
			addEvent(window, 'load', function() {
				load();
			});
		}
	}
}();