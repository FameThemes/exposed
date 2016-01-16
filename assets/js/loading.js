var stLoading= function(selector){
    var ld;
    if(typeof(selector)==='string'){
        ld = jQuery(selector);
    }else{
        ld = selector;
    }

    if(typeof(ld)==='undefined' || ld.length<=0){
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

jQuery(window).ready(function(){
    stLoading('.loading-icon');
});