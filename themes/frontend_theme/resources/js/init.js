/*function showAddToWishlistPopUp() {
    document.getElementById('wishlist-popup').style.display = "block";
}

function hideAddToWishlistPopUp(){
    document.getElementById('wishlist-popup').style.display = "none";
}

function showAddToWishlistPopUp2() {
    document.getElementById('wishlist-popup-loggedin').style.display = "block";
}

function hideAddToWishlistPopUp2(){
    document.getElementById('wishlist-popup-loggedin').style.display = "none";
}*/
$(document).ready(function() {
    
    // mobile navigation menu trigger
    $(".nav-trigger").on("click",function(e) {
        e.preventDefault();
        var that = $(this);
        var screenWidth = $(window).width();
        var navWidth = screenWidth - 45; // 45 is the triggers width
        var transitionSpeed = 500;

// multiple nav for all page   
//        var navmobile = $(this).parent();
//        var navmobilenav = navmobile.find(".nav");
//        var trigger = that;
        
// when there is only one menu on thispage
        var navmobile = $('.nav-mobile');
        var navmobilenav = navmobile.find(".nav");
        var trigger = $(".nav-trigger");
        
        if(navmobile.hasClass("active")) {
            // closing;
            navmobile.animate({
                "left": -navWidth
            },transitionSpeed,function() {
                navmobilenav.attr("style","");
                $(this).removeClass("active").attr("style","");;
                that.attr("style","");
            })
        } else {
            
            // opening
            navmobilenav.css({
                'width':navWidth
               
            });
            trigger.css("margin-right",0);
            navmobile.css({
                "left": -navWidth,
                "width": screenWidth
            }).stop().animate({
                "left":0
            },transitionSpeed,function() {
                $(this).addClass("active");
                $(".nav-mobile .nav").mCustomScrollbar({
                });
            }); 
        }
        
    });
    
    
    /*$(".categories ul li h3, .categories ul li a").on("click",function(e) {
        e.preventDefault();
        var that = $(this).parent();
        var transitionSpeed = 500;
        if(that.find("> ul").length > 0) {
            // this means the list-item has another unordered list under it
            var submenu = that.find("> ul");
            if(that.hasClass("selected") || submenu.is(":visible")) {
                //close the submenu
                submenu.slideUp(transitionSpeed,function() {
                    that.removeClass("selected");
                    that.find(".selected").removeClass("selected");
                });
            } else {
                // open the submenu
                
                submenu.slideDown(transitionSpeed);
                that.addClass("selected");
            }
            
        }
    });*/
    
    $("body").on("click",".scroll-top",function(e) {
        if(!$(this).hasClass("dontprevent")) {
            e.preventDefault();
        }
        var that = $(this);
        var target = that.attr("data-target");
        var offset = 0;
        var transitionSpeed = 500;
        if(typeof target !== typeof undefined) {
            // scroll to target
            offset = $(target).offset().top;
            if($(window).width() < 768) {
                offset = offset - 70;
            }
        } 
        $("html, body").animate({ scrollTop: offset }, transitionSpeed);
    });
    
    $(".products > li .products-menu .trigger").click(function(e) {
        e.preventDefault();
    });
    
    $(".view-video").click(function(e){e.preventDefault();});

    $('.view-video').each(function(i,v)
        {
            var id = 'player_' + $.fn.qtip.nextid;


            var videoID = $(v).attr("href").match(/(youtu\.be\/|&*v=|\/v\/|\/embed\/)+([A-Za-z0-9\-_]{5,11})/);
            var yt = false;
            var vimeo = false;

            // If we couldn't parse the URL, continue on to the next link...
            if(!videoID || videoID.length < 1) { 
                var videoID = $(this).attr("href").match(/http(s):\/\/(www\.)?vimeo.com\/(\d+)($|\/)/);
                if(!videoID || videoID.length < 1) { return; } else {
                    var vimeo = true;
                    videoID = videoID[3];
                    var content =  {
                        text: '<iframe src="http://player.vimeo.com/video/' + videoID + '?api=1&autoplay=1&player_id='+id+'" ' +
                        'width="275" height="155" frameborder="0" id="'+id+'"></iframe>'
                    };
                }

            } else {
                var yt = true;
                videoID = videoID[2];
                var content = $('<div />', { id: videoID+"_"+i+"_content" });
            }

            $(v).qtip({
                id: videoID+"_"+i,
                content: content,
                /*position: {
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
                },*/

                show: {
                    event: 'click',
                    solo: true, // ...and hide all other tooltips...
                    modal: true, // ...and make it modal
                    /*
                    * Unfortunately for us, FF reloads iframe contents when any of its parents
                    * visibility is toggled, meaning we lose the player API reference on first hide.
                    * Luckily for us, setting and resetting the display property also causes the onReady
                    * event of the API palyer to fire! Woop. So we'll just reload it manually.
                    */
                    effect: function() {
                        var style = this[0].style;
                        style.display = 'none';
                        setTimeout(function() { style.display = 'block'; }, 1);
                    }
                },
                hide: 'unfocus',
                style: {
                    classes: 'qtip-bootstrap clean-popup',
                    'width': 600
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
                events: {
                    show: function(event, api) {
                        if(vimeo) {
                            var iframe = $('iframe', this)[0];
                            $f(iframe).addEvent('ready', function(player_id) {
                                // Set the API player
                                api.player = $f(player_id);

                                // Mute it on load
                                api.player.api('setVolume', 0);
                            });

                        } else {
                            new YT.Player(videoID+"_"+i+"_content", {
                                playerVars: {
                                    autoplay: 1,
                                    enablejsapi: 1,
                                    origin: document.location.host,
                                },
                                origin: document.location.host,
                                height: 400,
                                width: "100%",
                                videoId: videoID.substr(0, 11),
                                events: {
                                    'onReady': function(e) {
                                        api.player = e.target;
                                        //                                    api.player.mute();
                                    }
                                }
                            });
                        }

                    },
                    hide: function(event, api){
                        if(yt) {
                            api.player && api.player.stopVideo();
                        } else {
                            api.player.api('pause');
                        }

                    }
                }
            });
    });
});