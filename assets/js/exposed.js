/* this is javaScript for site template  not a plugin */
/*
var FS = {
    "animation":"fade",
    "animationLoop":"false",
    "slideshow":"false",
    "slideshowSpeed":"7000",
    "animationSpeed":"6000",
    "pauseOnAction":"false",
    "pauseOnHover":"false",
    "controlNav":"true",
    "randomize":"false",
    "directionNav":"true"
};
*/

function reponsiveSize(gw) {
    "use strict";

    if(typeof(gw)==='undefined'  || gw===''){
        return '';
    }
    
    var width = 320;
    if (gw <= 320) {
        // console.log("320");
        width = Math.floor(gw / 1);
        //defaultCol = 1;
    } else if (gw >= 321 && gw <= 480) {
        //console.log("321 - 480");
        width = Math.floor(gw / 2);
        //defaultCol = 2;
    } else if (gw >= 481 && gw <= 768) {
        //console.log("481 - 768");
        width = Math.floor(gw / 3);
        //defaultCol = 3;
    } else if (gw >= 769 && gw <= 979) {
        //console.log("769 - 979");
        width = Math.floor(gw / 4);
        //defaultCol =  4;
    } else if (gw >= 980 && gw <= 1200) {
        //console.log("980 - 1200");
        width = Math.floor(gw / 4);
        //defaultCol = 4;
    } else if (gw >= 1201 && gw <= 1600) {
        //console.log("1201 - 1600");
        width = Math.floor(gw / 5);
        // defaultCol = 6;
    } else if (gw >= 1601 && gw <= 1824) {
        //console.log("1601 - 1824");
        width = Math.floor(gw / 6);
        // defaultCol = 8;
    } else if (gw >= 1825) {
        // console.log("1825");
        width = Math.floor(gw / 7);

    } else if (gw >= 2000) {
        // console.log("1825");
        width = Math.floor(gw / 8);

    }

    return width;
}

/*  TEMPLATE FUNCTION
 -------------------------------------------------------------------------*/

var Exposed = function() {
	"use strict";
    var self = this;
    var slySlider= '';
    // this.galleryContainer =jQuery('.isotope');;
    this.navMenu = function() {
        //ddsmoothmenu for primary navigation
        ddsmoothmenu.init({
            mainmenuid : "primary-nav-id", //menu DIV id
            orientation : 'h', //Horizontal or vertical menu: Set to "h" or "v"
            classname : 'primary-nav slideMenu', //class added to menu's outer DIV
            contentsource : "markup" //"markup" or ["container_id", "path_to_menu_file"]
        });

        // Primary Navigation for mobile.
        var primary_nav_mobile_button = jQuery('#primary-nav-mobile');
        var primary_nav_cloned;
        var primary_nav = jQuery('#primary-nav-id > ul');

        primary_nav.clone().attr('id', 'primary-nav-mobile-id').removeClass().appendTo(primary_nav_mobile_button);
        primary_nav_cloned = primary_nav_mobile_button.find('> ul');

        jQuery('#primary-nav-mobile-a').click(function() {

            var mwidth =  jQuery(window).width();
            if(mwidth>340){
                mwidth = 340;
            }else{
                mwidth = mwidth - 40;
            }

            if (jQuery(this).hasClass('primary-nav-close')) {
                jQuery(this).removeClass('primary-nav-close').addClass('primary-nav-opened');
                //primary_nav_cloned.slideDown(400);
                jQuery('#mobile-menu-wrapper').css({ 'width':  +mwidth+'px', left:'-'+mwidth+'px'  });
                jQuery('body').css({'overflow':'hidden'});
                jQuery('.site-wrapper').css({'position': 'absolute'});

                jQuery('#mobile-menu-wrapper').animate({'left': '0px'},{  
                                queue: false, duration: 400 ,
                                complete: function(){  
                                 }
                             });

                 jQuery('.site-wrapper').animate({'left': mwidth+'px'},{  
                                queue: false, duration: 400 ,
                                complete: function(){  
                                 }
                             });

            } else {
                jQuery(this).removeClass('primary-nav-opened').addClass('primary-nav-close');
                //primary_nav_cloned.slideUp(400);
                 jQuery('#mobile-menu-wrapper').animate({'left': '-'+mwidth+'px'},{  
                                queue: false, duration: 400 ,
                                complete: function(){  
                                    jQuery('#mobile-menu-wrapper').css({ 'width':  '0px', left:'0px'  });
                                    jQuery('body').css({'overflow':''});
                                    jQuery('.site-wrapper').css({'position': ''});
                                 }
                });

                jQuery('.site-wrapper').animate({'left': '0px'},{
                                queue: false, duration: 400,
                                complete: function(){
                                }
                             });
            }

            return false;
        });

        primary_nav_mobile_button.find('a').click(function(event) {
            event.stopPropagation();
        });
    };

    this.topSearchFrom = function() {
        jQuery('#header .search-form-icon').click(function() {
            jQuery('#header .top-search').slideToggle();
            return false;
        });

        /* When click our side of search form */
        jQuery(document).click(function(e) {
            var container = jQuery("#header .top-search");
            if (container.has(e.target).length === 0) {
                container.slideUp();
            }
        });
    };

    this.BlackWhite =  function($selecttor){

        if(typeof(window.gBlackAndWhite)!=='undefined' && window.gBlackAndWhite === true){
            $selecttor.find('.img-wrapper').BlackAndWhite({
                hoverEffect : true, // default true
                // set the path to BnWWorker.js for a superfast implementation
                webworkerPath : false,
                responsive:true,
                // to invert the hover effect
                invertHoverEffect: false,
                speed: { //this property could also be just speed: value for both fadeIn and fadeOut
                    fadeIn: 200, // 200ms for fadeIn animations
                    fadeOut: 800 // 800ms for fadeOut animations
                },
                onImageReady:function(img) {
                    // this callback gets executed anytime an image is converted
                }
            });
        }
    };

    this.getIsotopeSetWidthItems = function() {
        jQuery('.remove-when-load-completed').hide();
        // return false;
        var width = 0;
        var g, p, gw;
      
        if(jQuery('.full-width .gallery-width').length){
            g = jQuery('.full-width .gallery-width');
            p = g.parents('.full-width');
            gw = p.width();
            width = reponsiveSize(gw);
        }else{
            
            g = jQuery('.isotope');
            p = g.parent();
            width = '';
        }

        return width;

    };

    this.isotopeSetWidthItems = function(){
        var width = 0;
        var g = jQuery('.full-width .gallery-width');
        if (g.length) {
            // var isotopeData   = $container.data('isotope') ||  false;
            var p = g.parents('.full-width');
            var gw = p.width();
            width = reponsiveSize(gw);
            p.find('.isotope .item').each(function() {
                var obj = jQuery(this);
                if ( typeof (obj.attr('data-width-x')) !== 'undefined' && obj.attr('data-width-x') > 0) {
                    obj.css({
                        'width' : (width * obj.attr('data-width-x') ) + 'px'
                    });
                } else {
                    obj.css({
                        'width' : width + 'px'
                    });
                }
                //obj.css({'width' : percentW+'%'});
            });
        }
    };

    this.isotope = function() {

        var container = jQuery('.isotope');
        var setWidthItems = self.isotopeSetWidthItems;
        var getW = self.getIsotopeSetWidthItems;
        setWidthItems();
        jQuery(container).children('.item').css({'opacity': '0'});
        jQuery(container).children('.item').addClass('animated BottomToTop');
       // jQuery(container).children('.item').css({'visibility': 'visible'});
        self.initBlackAndWhite();
        if (jQuery('.isotope-loadmore').length > 0) {
           // jQuery('.isotope-loadmore').hide();
        }
        container.imagesLoaded(function() {
            container.isotope({
                resizable : false, // disable normal resizing
                itemSelector : '.item',
                layoutMode : 'masonry',
                transformsEnabled: false,
                masonry : {
                    columnWidth : getW()
                }
            }, function(){
                // done
            });

            setTimeout(function(){
                var animation_delay = 200;
                jQuery(container).children('.item').each(function(i, element){
                    setTimeout(function(){
                        jQuery(element).addClass('abc').css({
                            'opacity': '1',
                            'visibility': 'visible',
                            "-webkit-animation-delay": animation_delay + "ms",
                            "-moz-animation-delay": animation_delay + "ms",
                            "-ms-animation-delay": animation_delay + "ms",
                            "-o-animation-delay": animation_delay + "ms",
                            "animation-delay": animation_delay + "ms"
                        });
                    }, i * 100);
                });

                if (jQuery('.isotope-loadmore').length > 0) {
                    setTimeout(function(){
                        jQuery('.isotope-loadmore').fadeIn(500);
                    }, 800);
                }
            }, 300);

        });


        jQuery('.isotope-loadmore a').click(function() {
            var that = jQuery(this);
            var url = that.attr('href') || false;
            //var p = that.parents('.isotope-loadmore');
            var loadingTxt = that.attr('loading-txt') || 'Loading...';
            var loadTxt = that.html();
            that.attr('load-txt', loadTxt);
            that.html(loadingTxt);
            if (url) {
                jQuery.get(url, function(data) {
                    var jsData = jQuery(data);
                    var items = jQuery('.isotope .item', jsData);
                    if (items.length) {
                        var gw2 = getW();
                        var widtht = reponsiveSize(gw2);
                       // console.debug(widtht);	
                        if(widtht>0){
                            items.each(function() {
                                var obj = jQuery(this);
                                if ( typeof (obj.attr('data-width-x')) !== 'undefined' && obj.attr('data-width-x') > 0) {                                    
                                    obj.css({
                                        'width' : (widtht * obj.attr('data-width-x') ) + 'px'
                                    });
                                } else {
                                    obj.css({
                                        'width' : widtht + 'px'
                                    });
                                }
                            });
                        }

                        items.imagesLoaded(function() {
                            items.each(function() {
                                jQuery(this).css({'visibility': 'hidden'});
                                jQuery(this).css({'opacity': '0'});
                                jQuery(this).addClass('animated BottomToTop');
                            });
                            container.isotope('insert', items, function() {
                                //jQuery(window).resize();
                                //lb();
                                // Call repeart black and white  
                                self.initBlackAndWhite();            
                                self.lightbox();
                                // pos();
                                self.setFooterPos();
                                setTimeout(function() {
                                    jQuery(window).resize();
                                }, 50);
                            });
                            that.html(loadTxt);
                           
                            setTimeout(function(){
                                var animation_delay = 200;
                                items.each(function(i, element){
                                    setTimeout(function(){
                                        jQuery(element).addClass('abc').css({
                                            'opacity': '1',
                                            'visibility': 'visible',
                                            "-webkit-animation-delay": animation_delay + "ms",
                                            "-moz-animation-delay": animation_delay + "ms",
                                            "-ms-animation-delay": animation_delay + "ms",
                                            "-o-animation-delay": animation_delay + "ms",
                                            "animation-delay": animation_delay + "ms"

                                        });
                                    }, i * 300);                
                                });
                            }, 300);

                                                       
                        });
                    }//end check length

                    if (jQuery('.isotope-loadmore', jsData).length <= 0) {
                        jQuery('.isotope-loadmore').remove();
                    }else{
                        jQuery('.isotope-loadmore a').attr('href',jQuery('.isotope-loadmore a', jsData).attr('href'));
                    }
                }).fail(function() {
                    //jQuery('.isotope-loadmore').remove();
                });
            } else {
                jQuery('.isotope-loadmore').remove();
            }
            return false;
        });

        // update columnWidth on window resize
        jQuery(window).smartresize(function() {
            setTimeout(function(){
                self.setFooterPos();
                setWidthItems();
                container.isotope({
                    // update columnWidth to a percentage of container width
                    masonry : {
                        columnWidth : getW()
                    }
                });
               self.setFooterPos();
               self.BlackWhite(container);
            },300);
        });
    };

    this.lightbox = function(parent) {
        if ( typeof (parent) !== 'undefined') {
            jQuery('.lightbox', parent).magnificPopup({
                type : 'image',
                gallery : {
                    enabled : true
                }
            });
        } else {
            jQuery('.lightbox').magnificPopup({
                type : 'image',
                gallery : {
                    enabled : true
                }
            });
        }
    };

    this.autoFixedFooter = function() {
       return ;
    };

    this.setFooterPos = function() {
        return ;
    };

    this.jumTo = function(selector){
        if(typeof(selector)==='undefined'){
            return false;
        }
        var oTop = jQuery(selector).offset().top;
        oTop = top +10;
        jQuery('html, body').animate({
            scrollTop: oTop
        }, 1000);
    };

    this.sly = function(){
        // sly slider
        jQuery('.gallery-details-wrapper').each(function(){
            var g =  jQuery(this);
            var slyder_wrap =  g.find('.sly-slider') || false;
            var sly_slider=  g.find('.sly-frame') ||  false;
           // jQuery('.gallery-desc',g).attr('default-width' );
            var sly;// = undefined; check for
            g.slyInt = function(sly_slider, slyder_wrap){
                var sly = new Sly(sly_slider,{
                                      horizontal: 1,
                                      itemNav: 'centered',
                                      smart: 1,
                                      activateOn: 'click',
                                      activateMiddle: 1,
                                      mouseDragging: 0,
                                      touchDragging: 1,
                                      releaseSwing: 1,
                                      startAt: 0,
                                      scrollBar: slyder_wrap.find('.scrollbar'),
                                      scrollBy: 1,
                                      speed: 600,
                                      elasticBounds: 1,
                                      easing: 'easeOutExpo',
                                      dragHandle: 1,
                                      dynamicHandle: 1,
                                      clickBar: 1,

                                      // Buttons
                                      prev: slyder_wrap.find('.prev'),
                                      next: slyder_wrap.find('.next')
                                    }).init();
                return sly;
            };

             g.galleryTemplate= function(){
                /*jshint multistr: true */
                 var html ='<div class="gallery-details ">\
                                <div class="gallery-desc">\
                                     <div class="gallery-desc-inner"></div>\
                                    <div class="g-controls bg">\
                                         <a href="#" class="g-back ajax-action"><button ><i class="icon-arrow-left"></i></button></a>\
                                         <button class="g-list"><i class="icon-th-large"></i></button>\
                                         <a href="#" class="g-next ajax-action"><button ><i class="icon-arrow-right"></i></button></a>\
                                         <button class=" g-lightbox"><i class="icon-zoom-in"></i></button>\
                                    </div>\
                                </div><!-- gallery-desc -->\
                                <div class="sly-slider">\
                                    <div class="sly-frame">\
                                        <ul class="slide"></ul>\
                                    </div>\
                                    <div class="scrollbar">\
                                        <div class="handle bg" >\
                                            <div class="mousearea"></div>\
                                        </div>\
                                    </div>\
                                    <div class="controls center">\
                                        <button class="prev "><i class="icon-angle-left"></i></button>\
                                        <button class="next"><i class="icon-angle-right"></i></button>\
                                    </div>\
                                </div>\
                                <div class="clear"></div>\
                            </div><!-- gallery-details -->' ;
                     return html;
            };

            g.collapse = function(){
                    var that = this;
                    var gdw =  that.find('.gallery-desc').width();
                    that.css({'overflow': 'hidden'});
                    that.find('.gallery-desc-inner, .g-controls').css('display', 'none');   
                    that.find('.gallery-desc').css({'min-height':'auto'}); 
                        that.find('.gallery-desc').animate(
                             {
                                left: '-'+gdw+'px'
                             }, { 
                                queue: false, duration: 400 ,
                                complete: function(){
                                      // console.debug(gdw);
                                      jQuery(this).hide();
                                      self.slySlider.reload(); 
                                 }
                             }
                        );

                        that.find('.sly-slider').animate(
                            {'marginLeft':  '0px'},
                            {   queue: false, duration: 400 ,
                                complete: function(){
                                    self.slySlider.reload(); 
                                }
                            }
                        );
            };

            g.getId=  function(){
                var id=  g.attr('id');
                if(typeof(id)==='undefined' ||  id===''){
                      id = 'id-'+( new Date().getTime());
                      g.attr('id',id);
                }
                return id;
            };

            g.expanse = function(){
                 var that = this;
                 var gdw =  that.find('.gallery-desc').width();
                 that.find('.gallery-desc').animate({
                      left: '0px'  
                 }, {   queue: false, duration: 400 , 
                        complete: function(){
                          jQuery(this).css({'display' : 'block'});
                        }
                    }
                 );

                that.find('.sly-slider').animate(
                    {'marginLeft':  gdw+'px'},
                    { queue: false, duration: 400 ,
                        complete: function(){
                             self.slySlider.reload();  
                        }
                    }
                );

                 that.find('.gallery-desc-inner, .g-controls').css('display', 'block');    
                 that.css({'overflow': 'hidden'});
            };

            // hide gallery details (slider)
            g.hideGallery = function(){
                var that = this ;
                that.css({'overflow': 'hidden'}).removeClass('b30 show').addClass('hidden');
                that.animate({'height': '0px'}, {
                         queue: false, duration: 400 ,
                         complete: function(){
                            that.css({'display' :'none'});
                            self.autoFixedFooter();
                         }
                    });
            };

            // setting data for live lightbox
            g.lightboxSetting = function(images){
                if(typeof(images)==='undefined'||  images.length<=0){
                    return false;
                }
                var items = [];
                for (var i = 0;   i<  images.length;  i++) {
                    items[i] = {src: images[i].src_full ,  title: images[i].title };
                }
                 g.find('.g-lightbox').magnificPopup({
                        items: items,
                        gallery: {
                          enabled: true
                        },
                        fixedContentPos: false,
                      fixedBgPos: true,
                      overflowY: 'auto',
                      closeBtnInside: true,
                      preloader: false,
                      midClick: true,
                      removalDelay: 300,
                      //mainClass: 'my-mfp-zoom-in',
                      type: 'image' // this is default type
                 });
            };

            g.changeGalleryData = function(data, cb){
                var that = this;
               try{
                     var is_add_new=  false;
                        if(typeof(sly)==='undefined'){
                            is_add_new = true;
                            that.append(that.galleryTemplate());
                            // add loading
                            //that.append('<div class="g-overlay"><div class="loading-icon"></div></div>');
                            that.find('.gallery-details').css({'display': 'none'});

                        }
                        var imgLi=  '';
                        for(var i =0;  i<data.images.length; i++){
                            imgLi +='<li><img src="'+data.images[i].src+'"></li>';
                        }
                        that.find('.gallery-desc-inner').html(data.desc);
                        if(data.ajax_back!==''){
                            that.find('.g-back').show().attr('ajax-request',data.ajax_back);
                        }else{
                            that.find('.g-back').hide().attr('ajax-request','');
                        }
                        if(data.ajax_next!==''){
                            that.find('.g-next').show().attr('ajax-request',data.ajax_next);
                        }else{
                            that.find('.g-next').hide().attr('ajax-request','');
                        }
                        
                        // add items to slider
                        jQuery(imgLi).imagesLoaded(function(){
                                // console.debug(imgLi);
                                that.find('.sly-frame').find('ul').html(imgLi);
                                //lightbox
                                g.lightboxSetting(data.images);
                                if(typeof(sly)==='undefined'){
                                    sly_slider =  g.find('.sly-frame');  
                                    slyder_wrap = g.find('.sly-slider') || false; 
                                    sly = self.slySlider =   that.slyInt(sly_slider,slyder_wrap);
                                    //console.debug(sly);
                                    that.find('.gallery-details').css({'display': ''});
                                    g.GalleryResize();
                                    self.slySlider.reload();
                                }else{
                                }

                                if(typeof(cb)==='function'){
                                    cb();
                                }
                        });
                }catch(e){

                }
            };

            g.getHeight = function(){
                var that = this;
                var sh = 0;
               /*
                 var sh = that.find('.sly-frame ul li').eq(0).height() ||  500;
                 if(that.find('.sly-slider .scrollbar').length){
                    sh+=  that.find('.sly-slider .scrollbar').height();
                 }  
                 */
                
                that.find('.sly-frame ul li').each(function(){
                    if(sh<jQuery(this).height() ){
                        sh = jQuery(this).height();
                    }
                });

                if(that.find('.sly-slider .scrollbar').length){
                    sh+=  that.find('.sly-slider .scrollbar').height();
                }  

                if(typeof(sh)==='undefined'){
                    sh = 500;
                }  
                return sh;   
            };

            g.fixDescHeight= function(){
                 var that = this;
                 var sh = that.getHeight();
                 if(that.find('.sly-slider .scrollbar').length){
                    sh+=  that.find('.sly-slider .scrollbar').height();
                 }
                 that.find('.gallery-desc').css({'min-height': that.getHeight()+'px'});
            };

            g.preLoad = function(){
                this.addClass('b30');
                this.css({'display' :''});
                if(this.find('.g-overlay').length<=0){
                     this.append('<div class="g-overlay"></div>');
                }

                if(this.find('.loading-icon').length<=0){
                    this.find('.g-overlay').append('<div class="loading-icon"></div>');
                }
                
                if(typeof(sly)==='undefined' || this.hasClass('hidden')){
                    this.addClass('loading');
                    this.animate({'height': '50px'}, 300);
                }else{
                    this.addClass('loading');
                }

                self.loadingIcon(g.find('.loading-icon'));
                   
            };

            g.loadCompleted = function(){   
               // return false;
                // remove loading icon
                g.fixDescHeight();
                setTimeout(function(){
                     // return false;
                     //  g.find('.g-overlay').fadeIn(300);
                     // var h = this.find('.gallery-details').height();
                       var h = g.getHeight();
                       // console.debug(g.height());
                       if(g.height()< h){
                            g.animate(
                                {'height': h+'px'},{
                                 queue: false, duration: 400 ,
                                 complete: function(){
                                  
                                    g.fixDescHeight();
                                    self.autoFixedFooter();
                                    g.removeClass('loading');
                                    g.find('.loading-icon').remove();
                                    g.removeClass('control-actions');
                                    g.find('.g-overlay').fadeIn(300);
                                 }
                                }
                            );
                       }else{
                                    g.fixDescHeight();
                                    self.autoFixedFooter();
                                    g.removeClass('loading');
                                    g.find('.loading-icon').remove();
                                    g.removeClass('control-actions');
                                    g.find('.g-overlay').fadeIn(300);
                       }   
                }, 200);
            };

            // fix slider details height
           g.GalleryResize =  function(){
                var that = this;
                    var windowWidth = jQuery(window).width();
                    if (windowWidth> 768) {
                        var sh = slyder_wrap.height();
                       // jQuery('.gallery-desc',g).css({'min-height':sh+'px'});
                        that.expanse();
                    }else{
                        that.collapse();
                    }

                    if(typeof(self.slySlider)!=='undefined'){  
                        that.fixDescHeight();
                        self.slySlider.reload();
                    }
            };

            // load slider if exits
            if(sly_slider.length){
                g.removeClass('loading');
                sly = self.slySlider = g.slyInt(sly_slider,slyder_wrap);
                g.GalleryResize();
                self.slySlider.reload();
                g.fixDescHeight();
                self.autoFixedFooter();
            }

            //
            g.find('.g-controls .g-list').live('click',function(){
                    g.hideGallery();
            });

            // Load Next, back gallery when click to control button
            g.find('.g-controls .ajax-action').live('click',function(){
                    var o = jQuery(this);
                    var request = o.attr('ajax-request');
                    if(typeof(data)!==undefined){
                        g.preLoad();
                        g.addClass('control-actions');
                        jQuery.ajax({
                            url: ajaxurl,
                            data: request,
                            dataType: 'json',
                            method: 'post',
                            success: function(data){
                                g.changeGalleryData(data,function(){
                                    g.loadCompleted();
                                    g.GalleryResize();
                                });
                            }
                        });
                        return false;
                    }
            });
        
            if(typeof(sly)===undefined){
                 g.GalleryResize();
                 sly.reload();
            }

            jQuery(window).resize(function(){
                g.GalleryResize();
            });

           // ajax gallery When click to list items
           jQuery('.item .ajax-action').live('click',function(){
                var o = jQuery(this);
                var request = o.attr('ajax-request');
                self.jumTo('#'+g.getId());
                if(typeof(data)!==undefined){
                    if(g.find('.gallery-details').length){
                        g.addClass('control-actions');
                    }
                    g.preLoad();
                    jQuery.ajax({
                        url: ajaxurl,
                        data: request,
                        dataType: 'json',
                        method: 'post',
                        success: function(data){
                            g.changeGalleryData(data,function(){
                                 g.loadCompleted();
                                 g.GalleryResize();
                                 g.removeClass('hidden').addClass('show');
                            });
                        }
                    });
                    return false;
                }
            });

           // end  ajax gallery

           /* Button Lightbox Click */
            jQuery('.item .ajax-action-lightbox').live('click',function(){
                var o = jQuery(this);
                var request = o.attr('ajax-request');
                var images = '';
                var partHeight = 0;
                var wTop = jQuery(window).scrollTop();
                if(typeof(data)!==undefined){
                    jQuery(window).scrollTop(0);
                    jQuery('body').append('<div class="wrap-outer-lightbox"><div class="mfp-bg mfp-ready"></div><div class="lightbox-loader"><div class="loading-icon"></div></div></div>');
                    self.loadingIcon('.lightbox-loader .loading-icon');
                    jQuery.ajax({
                        url: ajaxurl,
                        data: request,
                        dataType: 'json',
                        method: 'post',
                        success: function(data){
                            images = data.images;
                            var items = [];
                            for (var i = 0;   i<  images.length;  i++) {
                                items[i] = {src: images[i].src_full ,  title: images[i].title };
                            }
                            jQuery.magnificPopup.open({
                                items: items,
                                gallery: {
                                      enabled: true
                                    },
                                fixedContentPos: false,
                                fixedBgPos: true,
                                overflowY: 'auto',
                                closeBtnInside: true,
                                preloader: false,
                                midClick: true,
                                removalDelay: 300,
                                //mainClass: 'my-mfp-zoom-in',
                                type: 'image', // this is default type
                                callbacks: {
                                    lazyLoad: function(item) {
                                        jQuery('.wrap-outer-lightbox, .loading-icon').remove();
                                    },
                                    close: function() {
                                        jQuery(window).scrollTop(wTop);
                                    }
                               }
                             });                             
                        }
                    });
                    return false;
                }
            });
        });
         
        // changeGalleryDesc();
        //jQuery(window).resize(changeGalleryDesc);
    };

    // create loading icon with js effect
    this.loadingIcon = function(selector){

        if(typeof(window.stLoading)==='function'){
            window.stLoading(selector);
        }else{

            var ld;
            if(typeof(selector)==='string'){
                ld = jQuery(selector);
            }else{
                ld = selector;
            }

            if(typeof(ld)==='undefined'){
                return;
            }

            var playAnimate;
            var loadingAnimate = {} ;

            if(ld.find(".shape1").length<=0){
                ld.append(jQuery('<div class="shape1 shape"></div>'));
            }
            if(ld.find(".shape2").length<=0){
                ld.append(jQuery('<div class="shape2 shape"></div>'));
            }

            loadingAnimate.shape1 =  jQuery(".shape1",ld);
            loadingAnimate.shape2 =  jQuery(".shape2",ld);
            var wwidth = ld.width();
            var bluewidth = loadingAnimate.shape1.width();
            loadingAnimate.shape1.css("left", (wwidth/2) - bluewidth);
            var bluepos =  loadingAnimate.shape1.position();
            var movex = loadingAnimate.shape1.width() + 4;
            loadingAnimate.shape2.css("left", bluepos.left + movex);
            loadingAnimate.moveleft = function($el){
                $el.animate({
                    left: '+='+movex
                }, 800, function() {
                    $el.css("z-index", "998");
                });
            };

            loadingAnimate.moveright = function($el){
                $el.animate({
                    left: '-='+movex
                }, 800, function() {
                    $el.css("z-index", "999");
                });
            };

            loadingAnimate.playAnimation = function(){
                loadingAnimate.moveleft(loadingAnimate.shape1);
                loadingAnimate.moveright(loadingAnimate.shape1);
                loadingAnimate.moveright(loadingAnimate.shape2);
                loadingAnimate.moveleft(loadingAnimate.shape2);
            };

            loadingAnimate.playAnimation();
            playAnimate = setInterval(loadingAnimate.playAnimation, 800);
        }

    };
    
    // Flex Slider For Post
    this.flexSlider = function(flexsliderSettings){
        if(typeof(flexsliderSettings)==='undefined'){
            var flexsliderSettings = {};
        } 
        // Flexslider
        flexsliderSettings.pauseOnHover = (FS.pauseOnHover === '1')? true: false;
        flexsliderSettings.pauseOnAction = (FS.pauseOnAction === '1')? true: false;
        flexsliderSettings.controlNav = (FS.controlNav === '1')? true: false;
        flexsliderSettings.directionNav = (FS.directionNav === '1')? true: false;
        flexsliderSettings.prevText ='<i class="icon-caret-left"></i>';
        flexsliderSettings.nextText ='<i class="icon-caret-right"></i>';

        jQuery('.flexslider').each(function(){
            jQuery(this).flexslider( flexsliderSettings );
        });
    };

    // load video icon
    this.loadVideoThumb = function(){
        // load video thumbnail 
        jQuery('.video-thumb').each(function(){
            var obj = jQuery(this);
            var v = obj.attr('video');
            var vi = obj.attr('video-id');
            if(typeof(v)!=='undefined' && v !==''&& typeof(vi)!=='undefined' && vi !==''){
                if(v==='youtube'){
                    obj.html('<img src="http://img.youtube.com/vi/'+vi+'/3.jpg" alt="" />');
                }else{
                     jQuery.getJSON('http://vimeo.com/api/v2/video/'+vi+'.json?callback=?',{format:"json"},function(data,status){
                        var small_thumb=  data[0].thumbnail_small;
                        obj.html('<img src="'+small_thumb+'" alt="" />');
                    });
                }
            }
        });
    };

    // For Shortcode: tabs, Accordion, Toggle, Alert
    this.shortcodes = function(){
        jQuery('.close').on('click',function(){
            jQuery(this).parent().fadeOut(500);
            return false;
        });
        // Widget Content Tabbed
        jQuery(".content-tabbed .list-tabbed li").click(function() {
            var  p = jQuery(this).parents('.content-tabbed');
            //  First remove class "active" from currently active tab
            jQuery(".list-tabbed li",p).removeClass('list-tabbed-active');
            //  Now add class "active" to the selected/clicked tab
            jQuery(this).addClass("list-tabbed-active");
            //  Hide all tab content
            jQuery(".tabbed_content",p).hide();
            //  Here we get the href value of the selected tab
            //var selected_tab = jQuery(this).find("a").attr("href");
            var selected_tab = jQuery(this).find("a").attr("for-tab");
            //  Show the selected tab content
            if(typeof(selected_tab)!=='undefined'){
                jQuery('.'+selected_tab,p).fadeIn();
            }
            //  At the end, we add return false so that the click on the link is not executed
            return false;
        });

       // tabs
        jQuery('.st-tabs').each(function(){
            var  t = jQuery(this);
            // for defaul when load;
            if(jQuery('.tab-title .current',t).length>0){
               var tab_id = jQuery('.tab-title .current',t).eq(0).attr('tab-id');
            }else{
                var tab_id = jQuery('.tab-title > li',t).eq(0).addClass('current').attr('tab-id');
            }
             t.find('div.active').removeClass('active').css('display','none');
             t.find('#' + tab_id ).fadeIn().addClass('active');
        });
        // when click
        jQuery('.st-tabs .tab-title > li').click(function(){
              var  t = jQuery(this).parents('.st-tabs');
                if(jQuery(this).hasClass('current')) {return;};
                var tab_id = jQuery(this).attr('tab-id');
                // hide all ative content
                jQuery('.tab-title li',t).removeClass('current');
                jQuery('.tab-content',t).css('display','none').removeClass('active');
                 jQuery(this).addClass('current');
                jQuery('#' + tab_id,t).fadeIn().addClass('active');
               
            });

        // Accordion
        jQuery('.st-accordion').each(function(){
            var p = jQuery(this);
            jQuery('.acc-title',p).toggleClass('acc-title-inactive');
            //Open accordion by default by class "acc-opened".
            jQuery('.acc-opened .acc-title',p).toggleClass('acc-title-active').toggleClass('acc-title-inactive');
            jQuery('.acc-opened .acc-content',p).slideDown().toggleClass('open-content');
            jQuery('li .acc-title',p).click(function(){                
                var  li =  jQuery(this).parents('li');
                var  t = jQuery(this);
                t.toggleClass('acc-title-active').toggleClass('acc-title-inactive');
                jQuery('.acc-content',li).slideToggle().toggleClass('open-content');
                jQuery('li',p).not(li).each(function(){
                    var e = jQuery(this);
                    jQuery('.acc-title',e).removeClass('acc-title-active');
                    jQuery('.acc-content',e).slideUp(400,function(){
                          jQuery('.acc-content',e).removeClass('open-content');
                    });
                });
            });
        });
       
        // Toggle
        jQuery('.toggle-title').click(function(){
            var toggle_tab = jQuery(this).parent();
            toggle_tab.find('> :last-child').stop(true, true).slideToggle();
            if (jQuery(this).hasClass('toggle_current'))
            {
                jQuery(this).removeClass('toggle_current');
            }
            else
            {
                jQuery(this).addClass('toggle_current');
            }
        });

        // share tooltip
        jQuery('.share .share-icon').click(function(){
            var $this = jQuery(this);
            var  p = jQuery(this).parent();
            var tw= $this.outerWidth(true);
            var th = $this.outerHeight(true);
            var top = $this.offset().top;
            var tooltip =  jQuery('.tooltip',$this);
            var w =  tooltip.outerWidth(true);
            var h =  tooltip.outerHeight(true );
            tooltip.css({'bottom': (th+20)+'px', 'left': -(w/2 - tw/2) +'px' }).fadeIn(300);
            return false;
        });

        /* When click our side of share tooltip */
        jQuery(document).click(function(e) {
            var container = jQuery(".share .share-icon");
            if (container.has(e.target).length === 0) {
                jQuery(".share .share-icon .tooltip").fadeOut(300);
            }
        });

        // back to top
        jQuery(window).scroll(function() {
            if(jQuery(this).scrollTop() !== 0) {
                jQuery('#sttotop').fadeIn();    
            } else {
                jQuery('#sttotop').fadeOut();
            }
        });
 
        jQuery('#sttotop').click(function() {
            jQuery('body,html').animate({scrollTop:0},800);
        });
    };
    
    // Gallery Supersize Slider
    this.fullScreenSlider = function() {

        /* Full Screen slider =========================*/
        if (typeof (window.gFullSliderData) !== 'undefined' && typeof (jQuery.supersized) !== 'undefined') {

            jQuery('#supersized-loader').append('<div class="loading-icon"></div>');
            jQuery('#supersized-loader').show();
            self.loadingIcon('#supersized-loader .loading-icon');
            jQuery.supersized.themeVars.image_path = window.gFullSliderSettings.path;
            jQuery.supersized({
                //Functionality
                slideshow : window.gFullSliderSettings.slideshow, //Slideshow on/off
                autoplay : window.gFullSliderSettings.autoplay, //Slideshow starts playing automatically
                start_slide : 1, //Start slide (0 is random)
                random : 0, //Randomize slide order (Ignores start slide)
                slide_interval : window.gFullSliderSettings.slide_interval, //Length between transitions
                transition : 1, //0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
                transition_speed : window.gFullSliderSettings.transition_speed, //Speed of transition
                new_window : 1, //Image links open in new window/tab
                pause_hover : 0, //Pause slideshow on hover
                keyboard_nav : 1, //Keyboard navigation on/off
                performance : 1, //0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
                image_protect : 1, //Disables image dragging and right click with Javascript
                image_path : window.gFullSliderSettings.path, //Default image path

                //Size & Position
                min_width : 0, //Min width allowed (in pixels)
                min_height : 400, //Min height allowed (in pixels)
                vertical_center : 0, //Vertically center background
                horizontal_center : 1, //Horizontally center background
                fit_portrait : 0, //Portrait images will not exceed browser height
                fit_landscape : 0, //Landscape images will not exceed browser width

                //Components
                navigation : 1, //Slideshow controls on/off
                thumbnail_navigation : 0, //Thumbnail navigation
                slide_counter : 1, //Display slide numbers
                slide_captions : 1, //Slide caption (Pull from "title" in slides array)
                slides : window.gFullSliderData

            });
            
            // If have a image then hidden action
            if (jQuery('#supersized li').size()===1) {jQuery('.supersized-action').hide();}
            //jQuery('#supersized-loader').css({'display': 'none'});
            //console.log(jQuery.supersized);
        } else {// end check slider data
            jQuery('#supersized').css({ 'display' : 'none'});
            jQuery('#supersized-loader').css({'display': 'none'});
            jQuery('.supersized-action').css({'display': 'none'});
        }
        if (jQuery('.main-outer-wrapper .isotope').length > 0)  {
            jQuery('#supersized').css({ 'display' : 'none'});
            jQuery('#supersized-loader').css({'display': 'none'});
            jQuery('.supersized-action').css({'display': 'none'});
        }
    };

    // Gallery Flex Slider
    this.galleryFSlider = function(){
        if (typeof(window.gFixedHeight)!=='undefined' && window.gFixedHeight===true && typeof(window.gFixedHeightSetting)!=='undefined') {
            if(jQuery('.fw-flexslider-wrap').length<=0){
                return;
            }
            jQuery('.fw-flexslider-wrap').imagesLoaded(function(){
    
                jQuery('.fw-flexslider-wrap').each(function(){
                    var fws = jQuery(this);
                    var sync =  jQuery('.fw-flexslider',fws).attr('sync')|| '';
                    var asNavFor =  jQuery('.fw-carousel',fws).attr('asNavFor')|| '';
                    jQuery('.fw-flexslider',fws).flexslider({
                        animation: "slide",
                        controlNav: false,
                        animationLoop: false,
                        slideshow: false,
                        smoothHeight: true, 
                        slideshowSpeed: window.gFixedHeightSetting.slideshowSpeed,
                        animationSpeed: window.gFixedHeightSetting.animationSpeed,
                        minItems: 1,
                        maxItems: 1,
                        prevText :'<i class="icon-caret-left"></i>',
                        nextText :'<i class="icon-caret-right"></i>',
                        sync: sync
                    });
    
                    jQuery('.fw-carousel',fws).flexslider({
                        animation: "slide",
                        controlNav: false,
                        animationLoop: false,
                        slideshow: false,
                        slideshowSpeed: window.gFixedHeightSetting.slideshowSpeed,
                        animationSpeed: window.gFixedHeightSetting.animationSpeed,
                        itemWidth: 75,
                        itemMargin: 0,
                        minItems: 1,
                        maxItems: 9,
                        prevText :'<i class="icon-caret-left"></i>',
                        nextText :'<i class="icon-caret-right"></i>',
                        asNavFor: asNavFor
                    });
    
                     var fsResize = function(){
                        jQuery('.fw-flexslider-wrap').height('auto');
                        var w= fws.innerWidth();
                         var cw= jQuery('.fw-carousel',fws).outerWidth();
                         var cc = (w-cw)/2;
                         cc = cc >0 ? cc: 0;
                         jQuery('.fw-carousel',fws).css({'margin-left':cc+'px'});
    
                         var wh = jQuery(window).height();
    
                         var mh= jQuery('.main-wrapper').outerHeight();
                         var hh=  jQuery('#header').outerHeight();
                         var fh=  jQuery('#footer').outerHeight();
    
                        jQuery('.fw-flexslider .slides li', fws).css({'margin-top': 'auto'}); 
    
                         if(wh > 380 &&  wh>(hh+fh)-35){
                            var mbh = wh-(hh+fh)-35;
                            var sh= mbh-115; // slider height
                            fws.height(mbh);
    
                            jQuery('.fw-flexslider', fws).height(sh);
                            jQuery('.fw-flexslider .slides li img', fws).css({'max-height': sh +'px'});
    
                            jQuery('.fw-flexslider .slides li', fws).each(function(){
                                    var imgh = jQuery(this).find('img').height();
                                    
                                    if(sh>imgh){
                                        jQuery(this).css({'margin-top': ((sh-imgh)/2)+'px'}); 
                                    }
                            }); 
    
                         }else{
                            fws.height(wh+95);
                             jQuery('.fw-flexslider', fws).height(wh);
                            jQuery('.fw-flexslider .slides li img', fws).css({'max-height': wh +'px'});
                            jQuery('.fw-flexslider .slides li', fws).each(function(){
                                    var imgh = jQuery(this).find('img').height();
                                    
                                    if(wh>imgh){
                                        jQuery(this).css({'margin-top': ((wh-imgh)/2)+'px'}); 
                                    }
                            }); 
                         }
                     };
                     
                    setTimeout(fsResize,300);
    
                    jQuery(window).resize(function(){
                        setTimeout(fsResize,300);
                    });
                });
            });
        }
    };
    
    // Gallery Image Flow
    this.galleryImageFlow = function(){
        if (typeof(window.gImageFlow)!=='undefined' && window.gImageFlow===true && typeof(window.gImageFlowURL)!=='undefined') {
            jQuery('.imageflow').each(function(){
                var idimageflow = jQuery(this).attr('id');
                self.loadingIcon('.imageflow .text .title .loading-icon');
                imf.create(idimageflow, window.gImageFlowURL, window.gImageFlowSetting.horizon, window.gImageFlowSetting.size, 0, window.gImageFlowSetting.border, 8, 0);
                jQuery(window).resize(function(){
                   var w_w = jQuery(window).width();
                   var h_w = jQuery(window).height();
                   var h_h = jQuery('#header').height();
                   var h_f = jQuery('#footer').height();
                   if (w_w<=768) {jQuery('#imageFlow').height(h_w-h_h-h_f-5); }
                   else {jQuery('#imageFlow').height(h_w-h_h-h_f-40); }
                });
                jQuery(window).trigger('resize');
            });
        }
    };
    
    // Gallery Ken Burns Effect
    this.galleryKenBurnsEffect = function(){
        // Check if exists gKenBurnsEffect: enable or not, gDataKenBurnsEffect: data (urls of images)
        if(typeof(window.gKenBurnsEffect)!=='undefined' && window.gKenBurnsEffect === true && typeof(window.gDataKenBurnsEffect)!=='undefined'){
            jQuery('#kenburns_overlay').css('width', jQuery(window).width() + 'px');
            jQuery('#kenburns_overlay').css('height', jQuery(window).height() + 'px');
            jQuery('#kenburns').attr('width', jQuery(window).width());
            jQuery('#kenburns').attr('height', jQuery(window).height());
            jQuery(window).resize(function() {
                jQuery('#kenburns').remove();
                jQuery('#kenburns_overlay').remove();
                jQuery('body').append('<canvas id="kenburns"></canvas><div id="kenburns_overlay"></div>');
                jQuery('#kenburns_overlay').css('width', jQuery(window).width() + 'px').css('height', jQuery(window).height() + 'px');
                jQuery('#kenburns').attr('width', jQuery(window).width()).attr('height', jQuery(window).height());
                jQuery('#kenburns').kenburns({
                    images:gDataKenBurnsEffect,
                    frames_per_second: window.gKenBurnsSetting.frames_per_second,
                    display_time: window.gKenBurnsSetting.display_time,
                    fade_time: window.gKenBurnsSetting.fade_time,
                    zoom: window.gKenBurnsSetting.zoom,
                    background_color:'#000000'
                });
            });
            jQuery(window).trigger('resize');
        }
    };
    
    // Gallery Flip 
    this.galleryFlip = function(){
        if (typeof(window.gGalleryFlip)!=='undefined' && window.gGalleryFlip===true && typeof(window.STGalleryFlip)!=='undefined') {
            
            //jQuery('.tf_loading').append('.loading-icon');
            //self.loadingIcon('.tf_loading .loading-icon');
            
            var $tf_bg				= jQuery('#tf_bg'),
                $tf_bg_images		= $tf_bg.find('img'),
                $tf_bg_img			= $tf_bg_images.eq(0),
                $tf_thumbs			= jQuery('#tf_thumbs'),
                total				= $tf_bg_images.length,
                current				= 0,
                $tf_content_wrapper	= jQuery('#tf_content_wrapper'),
                $tf_next			= jQuery('#tf_next'),
                $tf_prev			= jQuery('#tf_prev'),
                $tf_loading			= jQuery('#tf_loading');
            
            var STGalleryFlip = new window.STGalleryFlip();
            /* Selector Element */
            STGalleryFlip.choose(
                $tf_bg				,
                $tf_bg_images		,
                $tf_bg_img			,
                $tf_thumbs			,
                total				,
                current				,
                $tf_content_wrapper	,
                $tf_next			,
                $tf_prev			,
                $tf_loading			
            );
            STGalleryFlip.stinitflip();
            
            if (window.gGalleryFlipSetting.directionnav===false) {jQuery('.tf_next, .tf_prev').remove();}
            if (window.gGalleryFlipSetting.thumbnail===false) {jQuery('.tf_thumbs').remove();}
        }
    };
    
    // Effect Black and White
    this.initBlackAndWhite = function(){
        jQuery(window).load(function(){
            if(typeof(window.gBlackAndWhite)!=='undefined' && window.gBlackAndWhite === true){
                jQuery('.isotope .img-wrapper').BlackAndWhite({
                    hoverEffect : true, // default true
                    // set the path to BnWWorker.js for a superfast implementation
                    webworkerPath : false,
                    responsive:true,
                    // to invert the hover effect
                    invertHoverEffect: false,
                    speed: { //this property could also be just speed: value for both fadeIn and fadeOut
                        fadeIn: 200, // 200ms for fadeIn animations
                        fadeOut: 800 // 800ms for fadeOut animations
                    },
                    onImageReady:function(img) {
                        // this callback gets executed anytime an image is converted	
                    }
                });
        		
            }
            jQuery(window).resize();
        });
    };

    this.fixLayoutPadding = function(){
        jQuery('.site-content-inner').css({'padding-bottom': (jQuery('#footer').outerHeight())+'px'});
        jQuery(window).resize(function(){
                setTimeout(function(){
                    jQuery('.site-content-inner').css({'padding-bottom': (jQuery('#footer').outerHeight())+'px'});
                },200);
        });

    };

    // init
    this.init = function() {

        this.topSearchFrom();
        this.navMenu();
        this.isotope();
        this.lightbox();
        this.sly();
        /* Gallery Slider */
        this.fullScreenSlider();
        this.flexSlider(window.FS); // For Post
        this.galleryImageFlow();
        this.galleryKenBurnsEffect();
        this.galleryFlip();
        
        /* Effect Black and White */
        this.initBlackAndWhite();
        
        this.autoFixedFooter();
        this.shortcodes();
        // Fitvideos
        jQuery("body").fitVids();
        this.loadVideoThumb();
        // this.ajaxGallery();
        this.galleryFSlider();
        this.fixLayoutPadding();
    };
}; // end class Exposed

jQuery(document).ready(function() {
    "use strict";
    var theme = new Exposed();
    theme.init();
});


//<div class="border"><span>wedding Photography</span> <h1>EXPOSED</h1></div>