/*
the images preload plugin
*/

var STGalleryFlip = function() {
    var self = this;
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
        
    this.choose = function(p1,p2,p3,p4,p5,p6,p7,p8,p9,p10){
        $tf_bg				= p1;
		$tf_bg_images		= p2;
		$tf_bg_img			= p3;
		$tf_thumbs			= p4;
		total				= p5;
		current				= p6;
		$tf_content_wrapper	= p7;
		$tf_next			= p8;
		$tf_prev			= p9;
		$tf_loading			= p10;
    }

	jQuery.fn.preload = function(options) {
		var opts 	= jQuery.extend({}, jQuery.fn.preload.defaults, options);
		o			= jQuery.meta ? jQuery.extend({}, opts, this.data()) : opts;
		var c		= this.length,
			l		= 0;
		return this.each(function() {
			var $i	= jQuery(this);
			jQuery('<img/>').load(function(i){
				++l;
				if(l == c) o.onComplete();
			}).attr('src',$i.attr('src'));	
		});
	};
	jQuery.fn.preload.defaults = {
		onComplete	: function(){return false;}
	};

    this.stinitflip = function(){
        //preload the images				
    	$tf_bg_images.preload({
    		onComplete	: function(){
    			$tf_loading.hide();
    			self.init();
    		}
    	});
    }
    
	
	//shows the first image and initializes events
	this.init = function(){
		//get dimentions for the image, based on the windows size
		var dim	= self.getImageDim($tf_bg_img);
		//set the returned values and show the image
		$tf_bg_img.css({
			width	: dim.width,
			height	: dim.height,
			left	: dim.left,
			top		: dim.top
		}).fadeIn();
	
		//resizing the window resizes the $tf_bg_img
    	jQuery(window).bind('resize',function(){
    		var dim	= self.getImageDim($tf_bg_img);
    		$tf_bg_img.css({
    			width	: dim.width,
    			height	: dim.height,
    			left	: dim.left,
    			top		: dim.top
    		});
    	});
	
		//expand and fit the image to the screen
		jQuery('#tf_zoom').live('click',
			function(){
			if($tf_bg_img.is(':animated'))
				return false;
	
				var $this	= jQuery(this);
				if($this.hasClass('tf_zoom')){
					self.resize($tf_bg_img);
					$this.addClass('tf_fullscreen')
						 .removeClass('tf_zoom');
				}
				else{
					var dim	= self.getImageDim($tf_bg_img);
					$tf_bg_img.animate({
						width	: dim.width,
						height	: dim.height,
						top		: dim.top,
						left	: dim.left
					},350);
					$this.addClass('tf_zoom')
						 .removeClass('tf_fullscreen');	
				}
			}
		);
		
		//click the arrow down, scrolls down
		$tf_next.bind('click',function(){
			if($tf_bg_img.is(':animated'))
				return false;
				self.scroll('tb');
		});
		
		//click the arrow up, scrolls up
		$tf_prev.bind('click',function(){
			if($tf_bg_img.is(':animated'))
			return false;
			self.scroll('bt');
		});
		
		//mousewheel events - down / up button trigger the scroll down / up
		jQuery(document).mousewheel(function(e, delta) {
			if($tf_bg_img.is(':animated'))
				return false;
				
			if(delta > 0)
				self.scroll('bt');
			else
				self.scroll('tb');
			return false;
		});
		
		//key events - down / up button trigger the scroll down / up
		jQuery(document).keydown(function(e){
			if($tf_bg_img.is(':animated'))
				return false;
			
			switch(e.which){
				case 38:	
					self.scroll('bt');
					break;	

				case 40:	
					self.scroll('tb');
					break;
			}
		});
	}
	
	//show next / prev image
	this.scroll = function(dir){
		//if dir is "tb" (top -> bottom) increment current, 
		//else if "bt" decrement it
		current	= (dir == 'tb')?current + 1:current - 1;
		
		//we want a circular slideshow, 
		//so we need to check the limits of current
		if(current == total) current = 0;
		else if(current < 0) current = total - 1;
		
		//flip the thumb
		$tf_thumbs.flip({
			direction	: dir,
			speed		: 400,
			onBefore	: function(){
				//the new thumb is set here
				var content	= '<span id="tf_zoom" class="tf_zoom"></span>';
				content		+='<img src="' + $tf_bg_images.eq(current).attr('longdesc') + '" alt="Thumb' + (current+1) + '"/>';
				$tf_thumbs.html(content);
		}
		});

		//we get the next image
		var $tf_bg_img_next	= $tf_bg_images.eq(current),
			//its dimentions
			dim				= self.getImageDim($tf_bg_img_next),
			//the top should be one that makes the image out of the viewport
			//the image should be positioned up or down depending on the direction
				top	= (dir == 'tb')?jQuery(window).height() + 'px':-parseFloat(dim.height,10) + 'px';
				
		//set the returned values and show the next image	
			$tf_bg_img_next.css({
				width	: dim.width,
				height	: dim.height,
				left	: dim.left,
				top		: top
			}).show();
			
		//now slide it to the viewport
			$tf_bg_img_next.stop().animate({
				top 	: dim.top
			},1000);
			
		//we want the old image to slide in the same direction, out of the viewport
			var slideTo	= (dir == 'tb')?-$tf_bg_img.height() + 'px':jQuery(window).height() + 'px';
			$tf_bg_img.stop().animate({
				top 	: slideTo
			},1000,function(){
			//hide it
				jQuery(this).hide();
			//the $tf_bg_img is now the shown image
				$tf_bg_img	= $tf_bg_img_next;
			//show the description for the new image
				$tf_content_wrapper.children()
								   .eq(current)
							       .show();
	});
		//hide the current description	
			$tf_content_wrapper.children(':visible')
							   .hide()
	
	}
	
	//animate the image to fit in the viewport
	this.resize = function($img){
		var w_w	= $(window).width(),
			w_h	= $(window).height(),
			i_w	= $img.width(),
			i_h	= $img.height(),
			r_i	= i_h / i_w,
			new_w,new_h;
		
		if(i_w > i_h){
			new_w	= w_w;
			new_h	= w_w * r_i;
			
			if(new_h > w_h){
				new_h	= w_h;
				new_w	= w_h / r_i;
			}
		}	
		else{
			new_h	= w_w * r_i;
			new_w	= w_w;
		}
		
		$img.animate({
			width	: new_w + 'px',
			height	: new_h + 'px',
			top		: '0px',
			left	: '0px'
		},350);
	}
	
	//get dimentions of the image, 
	//in order to make it full size and centered
	this.getImageDim = function($img){
		var w_w	= jQuery(window).width(),
			w_h	= jQuery(window).height(),
			r_w	= w_h / w_w,
			i_w	= $img.width(),
			i_h	= $img.height(),
			r_i	= i_h / i_w,
			new_w,new_h,
			new_left,new_top;
		
		if(r_w > r_i){
			new_h	= w_h;
			new_w	= w_h / r_i;
		}
		else{
			new_h	= w_w * r_i;
			new_w	= w_w;
		}


		return {
			width	: new_w + 'px',
			height	: new_h + 'px',
			left	: (w_w - new_w) / 2 + 'px',
			top		: (w_h - new_h) / 2 + 'px'
		};
    }
}