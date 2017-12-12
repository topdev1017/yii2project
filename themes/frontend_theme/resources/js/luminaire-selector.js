var sidebarTopOffset;
var sidebarBottomOffset;

// initialize the sidebar affix core
function init_sidebarAffix() {
    var sidebar = $("#sidebar");
    if(sidebar.length > 0 && $(window).width() > 768) {
        // init the scroller 
        sidebar.find(".main-menu-wrapper").mCustomScrollbar({
            autoHideScrollbar:false,
            scrollInertia:200,
            mouseWheel:{ 
//                preventDefault: true,
                scrollAmount: 150,
            
            },
            autoExpandScrollbar:true,
            scrollButtons:{ enable: true },
            theme:"dark-3"
        }); 
        
        update_sidebarOffsets(); // update the sidebar affix offsets
        
        // update the offsets in case the content has modified
        $(".main-content-of-page").bind("DOMSubtreeModified",function() {
            update_sidebarOffsets();
        });
        
        // update the offsets in case the window was resized
        $(window).bind("resize",function() {
            update_sidebarOffsets();
        });
        
        var scroll = $(window).scrollTop(); // check current scroll position
        _fixIt(scroll,sidebar); // fix the sidebar depending to current scroll position
        
        // the brains of the operation
        $(window).scroll(function() {
            var scroll = $(this).scrollTop();
            _fixIt(scroll,sidebar);
        });
    } else if(sidebar.length > 0 && $(window).width() < 768) {
        sidebar.find(".main-menu-wrapper").mCustomScrollbar('destroy');
    }
    
}


// update the sidebar affix offsets, it was needed to be responsive friendly
function update_sidebarOffsets() {
    var sidebar = $("#sidebar");
    var container = sidebar.parent().find(".main-content-of-page");
    if(sidebar.length > 0 && $(window).width() > 768) {
        sidebarTopOffset = container.offset().top;
        sidebar.find(".mCustomScrollbar").css({
            'height':$(window).height(),
            'max-height':$(window).height()
        });
        if(container.height() > sidebar.height()) {
            sidebarBottomOffset = container.offset().top + (container.height() - ($(window).height() - 20));
        } else {
            sidebarBottomOffset = container.offset().top + (container.height() - (sidebar.height() - 20));
        }
        
        
    } else if(sidebar.length > 0 && $(window).width() < 768) {
        sidebar.find(".main-menu-wrapper").mCustomScrollbar('destroy');
    }
}

// add/remove affix classes to sidebar depending on the scroll amount
function _fixIt(scroll,sidebar) {
    if($(window).width() > 767) {
        if(scroll < sidebarTopOffset) {
            sidebar.removeClass("affix");
            sidebar.removeClass("affix-bottom");
        } else if (scroll > sidebarBottomOffset) {
            sidebar.addClass("affix-bottom");
            sidebar.removeClass("affix");
        } else {
            sidebar.addClass("affix");
            sidebar.removeClass("affix-bottom");
        } 
        
    } else {
        sidebar.
        removeClass("affix").
        removeClass("affix-bottom").
        removeAttr("style");
    }
}

$(window).load(function() {
    init_sidebarAffix(); // init the sidebar affix function
})

$(document).ready(function() {
    
    
    
    setCategoriesTrigger();
    
    // main filter
    $(".luminaire-selector-content").on("click",".main-filter .thumb-filter a",function(e) {
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
    $(".luminaire-selector-content").on("click",".group-filter .thumb-filter a",function(e) {
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

   
    History.Adapter.bind(window, 'statechange', function () {
        var state = History.getState();
        var ajaxContainer = $(".ajax-content");
        
        if(ajaxContainer.length < 1) {
            window.location.href = state.url;
            return;
        }
        
        if(typeof(state.data.next_url) !== "undefined") {
            
            var activeSub = $(".luminaire-categories").find("li.selected");
            if(activeSub.length > 0) {
                activeSub.find("> ul").slideUp("slow");
                activeSub.removeClass("selected");
                activeSub.find(".subnav-trigger").removeClass("show");
            }
            var item = $('.categories .categ-link[href="'+state.data.next_url+'"]');
            var submenus = item.parent().find("> ul");
            
            $.ajax({
                url: state.data.next_url,     
                type: 'GET',
                dataType: "html",
                success: function(response) {
                    ajaxContainer.stop().animate({opacity:0},300,function() {
                        ajaxContainer.html(response);
                        
                        ajaxContainer.stop().animate({opacity:1},300);
                        submenus.slideDown('slow',function() {
                            item.parent().addClass("selected");
                            item.addClass("selected");
                        });
                        
                        registerPopups();
                    });
                }
            });
        } else if(/luminaire\/index/.test(state.url)) {
            ajaxContainer.stop().animate({opacity:0.3},300);
            ajaxContainer.load(state.url+" .ajax-content > *",function() {
                ajaxContainer.stop().animate({opacity:1},300);
                var activeSub = $(".luminaire-categories").find("li.selected");
                if(activeSub.length > 0) {
                    activeSub.find("> ul").slideUp("slow");
                    activeSub.removeClass("selected");
                    activeSub.find(".subnav-trigger").removeClass("show");
                }
            });
        }
    });
    

    $(".mobile-accordion h3").on("click",function(e) {
        var that = $(this);
        var subnav = that.closest("li").find("> ul");
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
    
    
    $(".categories .luminaire-categories").on("click","a.categ-link",function(e) {
        e.preventDefault();
        
        var that = $(this);
        var container = that.closest(".luminaire-categories");
        
        History.pushState({
            item:that,
            next_url: that.attr("href"),
            prev_url: window.location.href
        },document.title,that.attr("href"));
        

        var activeSub = $(".luminaire-categories").find("li.selected");
        if(activeSub.length > 0) {
            activeSub.find("> ul").slideUp("slow");
            activeSub.removeClass("selected");
            activeSub.find(".subnav-trigger").removeClass("show");
        }

        var menu = $(this).closest(".categories");
        var submenus = that.parent().find("> ul");
        submenus.hide();
        
    });
    
    //$(".luminaire-categories a.categ-link").on("click",function(e) {
//        if(!$(".main-menu .categories").hasClass("mobile-accordion")) {
//            var that = $(this);
//            var main_parent = that.parent().closest(".luminaire-categories");
//            
//            var activeMenus = main_parent.find("li.selected > ul").slideUp(500,function() {
//                $(this).parent().find(".subnav-trigger").removeClass("show");
//                $(this).parent().removeClass("selected");
//            });
//            
//            
//            var parent = that.parent();
//            var subnav = parent.find(">ul");
//            
//            if(typeof subnav !== typeof undefined && subnav.length > 0) {
//                if(!subnav.is(":visible")) {
//                    subnav.slideDown(500,function() {
//                        that.parent().addClass("selected");
//                        that.find(".subnav-trigger").addClass("show")
//                    });
//                }
//            }
//        }
//        
//    });
    
    //$(".main-menu .categories .luminaire-categories").on("click","a.categ-link",function(e) {
//        
//        var that = $(this);
//        var href = that.attr("href"); 
//        var ajaxContainer = $(".main-content .ajax-content");
//        var container = that.closest(".luminaire-categories");
//        
//        if(ajaxContainer.length > 0) {
//            e.preventDefault();
//        } else {
//            return;
//        }
//        
//        var activeSub = $(".luminaire-categories").find("ul.selected");
//        if(activeSub.length > 0) {
//            activeSub.slideUp("slow");
//        }
//        
//        var activeSub = $(".luminaire-categories").find("li.selected");
//        if(activeSub.length > 0) {
//            activeSub.removeClass("selected");
//            activeSub.find(".subnav-trigger").removeClass("show");
//        }
//        
//        var menu = $(this).closest(".categories");
//        var submenus = that.parent().find("> ul");
//        submenus.hide();
//        
//        if(menu.hasClass("mobile-accordion")) {
//            /*menu.css("position","relative");
//            menu.find(".dom-loader").remove();
//            var loader = $("<div>",{
//                'class':'dom-loader',
//                'style':''
//            }).html("<span>Loading...</span>");
//            menu.append(loader);*/
//        }
//        
//        
//        var selected = ajaxContainer.find(".main-filter .thumb-filter").find("a.active");
//        if(typeof selected !== typeof undefined && selected.length > 0) {
//            size = selected.attr("data-size");
//            switch(size) {
//                case "small":
//                    var itemClass = "product-box-small";
//                    break;
//                case "medium":
//                    var itemClass = "product-box";
//                    break;
//                case "large":
//                    var itemClass = "product-box-large";
//                    break;
//                default:
//                    var itemClass = "product-box";
//                    break;
//            }
//        } else {
//            size = 'medium';
//            var itemClass = "product-box";
//        }
//        
//        
//        $.ajax({
//            url: href,     
//            type: 'GET',
//            dataType: "html",
//            success: function(response) {
//                /*if(typeof loader !== typeof undefined && menu.hasClass("mobile-accordion")) {
//                    loader.stop().animate({opacity:0},300,function() {
//                        $(this).remove();
//                    });
//                }*/
//                ajaxContainer.stop().animate({opacity:0},300,function() {
//                    var replace = $(response);
//                    replace.find(".item.product-box").removeClass("product-box").addClass(itemClass);
//                    replace.find(".thumb-filter a.active").removeClass("active");
//                    replace.find('.thumb-filter a[data-size="'+size+'"]').addClass("active");
//                    ajaxContainer.html(replace);
//                    ajaxContainer.stop().animate({opacity:1},300);
//                    registerPopups();
//                    submenus.slideDown('slow',function() {
//                        $(this).parent().addClass("selected");
//                        $(this).addClass("selected");
//                    });
//                });
//                
//                /*if(menu.hasClass("mobile-accordion")) {
//                    var target = $(".ajax-content");
//                    var offset = 0;
//                    if(typeof target !== typeof undefined) {
//                        offset = target.offset().top;
//                    } 
//                    $("html, body").animate({ scrollTop: offset }, 500);
//                }*/
//            }
//        })
//        
//    });
    
    


    $("body").on("change",".mobile-scroll-to",function(e) {
        e.preventDefault();
        var that = $(this);
        var value = that.val();
        var target = $(".manufacture_"+value);
        var offset = 0;
        var transitionSpeed = 500;
        if(typeof target !== typeof undefined) {
            // scroll to target
            offset = $(target).offset().top - 70;
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

    $(".luminaire-selector-content").on("click",".main-filter .by-filter a", function(e) {
        e.preventDefault();

        var container = $(this).closest(".by-filter");
        var cid = container.closest(".main-filter").attr("data-cid");

        var qs = container.find(".quick-ship");
        var l = container.find(".led-only");

        var quick_ship = 0;
        var led = 0;

        $(".group-filter .by-filter .active").removeClass("active");

        if($(this).hasClass("active")) {
            $(this).removeClass("active");
        } else {
            $(this).addClass("active");
        }

        if(qs.hasClass("active")) {
            var quick_ship = 1;
            $(".group-filter .by-filter .quick-ship").addClass("active");
        }
        if(l.hasClass("active")) {
            var led = 1;
            $(".group-filter .by-filter .led-only").addClass("active");
        }
        
        var selected = container.parent().find(".thumb-filter").find("a.active");
        if(typeof selected !== typeof undefined && selected.length > 0) {
            size = selected.attr("data-size");
            switch(size) {
                case "small":
                    var itemClass = "product-box-small";
                    break;
                case "medium":
                    var itemClass = "product-box";
                    break;
                case "large":
                    var itemClass = "product-box-large";
                    break;
                default:
                    var itemClass = "product-box";
                    break;
            }
        } else {
            var itemClass = "product-box";
        }
        
        
        if(container.hasClass("manufactures")) {
            var mid = $(".main-filter").attr("data-mid");
            var cid = $(".main-filter").attr("data-cid");
            var url = manufacture_view_search+'?mid='+mid+'&cat='+cid+'&quick_ship='+quick_ship+'&led='+led;
        } else {
            var url = luminaire_selector_search+'?cat='+cid+'&quick_ship='+quick_ship+'&led='+led;
        }
        $.ajax({
            type: 'GET',
            url: url,
            success: function(data){
                var res = $(data);
                res.find(".item.product-box").removeClass("product-box").addClass(itemClass);
                $("#results-content").html(res);
                registerPopups();
            }
        });

    }); 

    $(".luminaire-selector-content").on("click",".group-filter .by-filter a",function(e) {
        e.preventDefault();

        var container = $(this).closest(".by-filter");
        var resultsBlock = container.closest(".item").find(".group-results");
        var mid = container.closest(".filters").attr("data-mid");
        var cid = container.closest(".group-filter").attr("data-cid");

        var qs = container.find(".quick-ship");
        var l = container.find(".led-only");

        var quick_ship = 0;
        var led = 0;

        if($(this).hasClass("active")) {
            $(this).removeClass("active");
        } else {
            $(this).addClass("active");
        }

        if(qs.hasClass("active")) {
            var quick_ship = 1
        }
        if(l.hasClass("active")) {
            var led = 1
        }
        
        var selected = container.parent().find(".thumb-filter").find("a.active");
        if(typeof selected !== typeof undefined && selected.length > 0) {
            size = selected.attr("data-size");
            switch(size) {
                case "small":
                    var itemClass = "product-box-small";
                    break;
                case "medium":
                    var itemClass = "product-box";
                    break;
                case "large":
                    var itemClass = "product-box-large";
                    break;
                default:
                    var itemClass = "product-box";
                    break;
            }
        } else {
            var itemClass = "product-box";
        }
        
        $.ajax({
            type: 'GET',
            url: luminaire_selector_search_group+'?cid='+cid+'&mid='+mid+'&quick_ship='+quick_ship+'&led='+led,
            success: function(data){
                var res = $(data);
                res.find(".item.product-box").removeClass("product-box").addClass(itemClass);
                resultsBlock.html(res);
                registerPopups();
            }
        });

    });

    registerPopups();

    $(".ajax-content").on("click",".products-group .group-pager a",function(e) {
        e.preventDefault();

        var url = $(this).attr("href");
        var ajaxContainer = $(this).closest(".group-results");
        var productsContainer = $(this).closest(".products-group");
        
        var selected = ajaxContainer.parent().find(".thumb-filter").find("a.active");
        if(typeof size == typeof undefined || selected.length < 1) {
            var selected = $(".main-filter .thumb-filter a.active");
        }
        if(typeof selected !== typeof undefined && selected.length > 0) {
            size = selected.attr("data-size");
            switch(size) {
                case "small":
                    var itemClass = "product-box-small";
                    break;
                case "medium":
                    var itemClass = "product-box";
                    break;
                case "large":
                    var itemClass = "product-box-large";
                    break;
                default:
                    var itemClass = "product-box";
                    break;
            }
        } else {
            var itemClass = "product-box";
        }
        var transitionSpeed = 300;
        var productsGroupID = $(this).closest(".products-group").attr("id");

        /* SCROLLING EFFECT */
        var offset = 0;
        var target = ajaxContainer.closest(".item");
        if(typeof target !== typeof undefined) {
            // scroll to target
            offset = $(target).offset().top;
        } 
        $("html, body").stop().delay(100).animate({ scrollTop: offset }, 1000,function() {
            productsContainer.stop().animate({
                opacity:0   
                },transitionSpeed,function() {
                    ajaxContainer.addClass("show-loading");
                    ajaxContainer.css("min-height","100px");
                    ajaxContainer.html("");
                    $.ajax({
                        type: 'GET',
                        url: url,
                        dataType:"html",
                        success: function(response){

                            var res = $(response).find("#"+productsGroupID).css("opacity",0);
                            res.find(".item.product-box").removeClass("product-box").addClass(itemClass);
                            ajaxContainer.html(res);
                            registerPopups();
                            ajaxContainer.removeClass("show-loading");
                            ajaxContainer.find(".products-group").stop().animate({
                                opacity:1   
                                },transitionSpeed);
                        },
                        error: function(xhr,status,error) {
                            window.location.href = url;
                        }
                    });
            });
        });
        /* SCROLLING EFFECT END */

    });
});

$(window).resize(function() {
    setCategoriesTrigger();
})

function setCategoriesTrigger() {
    if($(window).width() < 767) {

        //        var transitionSpeed = 500;
        //        offset = $(".luminaire-content, .luminaire-selector-content").offset().top;
        //        $("html, body").animate({ scrollTop: offset }, transitionSpeed);

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

function registerPopups() {
    $(".show-product-info").qtip({
        content: {
            text: function(event, api) {
                $.ajax({ 
                    url: luminaire_product_info_popup,                         
                    type: 'GET',
                    data: {
                        pid: $(this).attr("data-pid"),
                        target: $(this).attr("data-target")
                    }
                }).done(function(html) {
                    api.set('content.text', html);
                    api.reposition(); 
                }).fail(function(xhr, status, error) {
                    api.set('content.text', status + ': ' + error)
                })

                return '';
            }, 
            title: {
                text: '',
                button: 'Close'
            }
        },
        position: {
            my: 'center', // ...at the center of the viewport
            at: 'center',
            target: $(window),
            adjust : {
                screen : true,
                effect : {
                    type: 'slide',
                    duration: 2220,
                    threshold: 50
                }
            }
        },
        hide: {
            event: 'unfocus'
        },
        show: {
            event: 'click',
            solo: true, // ...and hide all other tooltips...
            modal: true // ...and make it modal
        },
        style: {
            classes: "qtip-bootstrap luminaire-popup wishlist-popup",
            //                'width': 700,
            //                'width': 1000
        },
        events: {
            show: function(event, api) {

            },
            hide: function(event, api) {
            }
        }
    });
}