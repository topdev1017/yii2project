$(document).ready(function() {
    
    // main filter
    $(".wishlist-page-content").on("click",".main-filter .thumb-filter a",function(e) {
        e.preventDefault();
        var size = $(this).attr("data-size");
        
        switch(size) {
            case "small":
            var p_class = "item product-box-small";
            break;
            case "medium":
            var p_class = "item product-box";
            break;
            case "large":
            var p_class = "item product-box-large";
            break;
            default:
                var p_class = "item product-box";
            break;
        }
        
        $(".group-filter .thumb-filter").find(".active").removeClass("active");
        $(".group-filter .thumb-filter").find('a[data-size="'+size+'"]').addClass("active");
        
        $(".group-results ul.products-group > li.item").attr("class","").addClass(p_class);
        $(this).parent().parent().find(".active").removeClass("active");
        $(this).addClass("active");
    });
    
    
    
    // products filter
    $(".wishlist-page-content").on("click",".group-filter .thumb-filter a",function(e) {
        e.preventDefault();
        var size = $(this).attr("data-size");
        
        switch(size) {
            case "small":
            var p_class = "item product-box-small";
            break;
            case "medium":
            var p_class = "item product-box";
            break;
            case "large":
            var p_class = "item product-box-large";
            break;
            default:
                var p_class = "item product-box";
            break;
        }
        $(this).closest(".item").find(".products-group > li.item").removeAttr("class").addClass(p_class);
        $(this).parent().parent().find(".active").removeClass("active");
        $(this).addClass("active");
    });
    
    $(".subnav-trigger").on("click",function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        var that = $(this);
        var subnav = that.closest("li").find("> ul");
        var transitionSpeed = 300;
        
        if(typeof subnav !== typeof undefined && subnav.length > 0) {
            if(subnav.is(":visible")) {
                subnav.stop().animate({opacity:0},transitionSpeed,function() {
                    subnav.slideUp(transitionSpeed);
                });
                
            } else {
                subnav.slideDown(transitionSpeed,function() {
                    subnav.stop().animate({opacity:1},transitionSpeed);
                });
            }
        }
    });
    
    
    $(".pajax-container").on("pjax:beforeSend",function(e,response) {
        var that = $(this);
        var transitionSpeed = 300;
        var cheight = that.height();
        var cwidth = that.width();
        
        that.css({"min-height":cheight}).stop().animate({opacity:0},transitionSpeed);
        
//        that.css({"position":"absolute",'width':cwidth}).animate({left:-cwidth},transitionSpeed);
        
    });
    
    $(".pajax-container").on("pjax:complete",function() {
        
        var that = $(this);
        var transitionSpeed = 300;
        var cheight = that.height();
        
        that.css({"min-height":"1px"}).stop().animate({opacity:1},transitionSpeed);
    });
    
    setCategoriesTrigger();
    
    $(".mobile-accordion h3, .mobile-accordion a").on("click",function(e) {
        var that = $(this);
        var subnav = that.closest("li").find("> ul,> .simulate-dropdown");
        var transitionSpeed = 300;
        
        if(typeof subnav !== typeof undefined && subnav.length > 0) {
            if(subnav.is(":visible")) {
                /*if(!that.hasClass("skipped-once")) {
                    
                }*/
                subnav.slideUp(transitionSpeed);
            } else {
                /*if(!that.hasClass("skipped-once") && that.is("a")) {
                    e.preventDefault();
                    that.addClass("skipped-once");
                    
                }*/ 
                subnav.slideDown(transitionSpeed);                
            }
        }
    });
    
    
    $("body").on("change",".mobile-scroll-to",function(e) {
        e.preventDefault();
        var that = $(this);
        var value = that.val();
        var target = $(".manufacture_"+value);
        var offset = 0;
        var transitionSpeed = 500;
        if(typeof target !== typeof undefined) {
            // scroll to target
            offset = $(target).offset().top;
        } 
        $("html, body").animate({ scrollTop: offset }, transitionSpeed);
    });
    
    $("body").on("click",".products > li .products-menu .trigger", function(e) {
        e.preventDefault();
        var that = $(this);
        var popup = that.closest(".products-menu").find(".popup-content");
        
        if(popup.is(":visible")) {
            popup.hide();
        } else {
            popup.show();
        }
        
    });
});

$(window).resize(function() {
    setCategoriesTrigger();
})

function setCategoriesTrigger() {
    if($(window).width() < 767) {
        if(!$(".main-menu .categories").hasClass("mobile-accordion")) {
            $(".main-menu .categories").addClass("mobile-accordion");
        }
    } else {
        unsetCategoriesTrigger();
    }
    
    
}

function unsetCategoriesTrigger() {
    $(".mobile-accordion").removeClass("mobile-accordion");
}