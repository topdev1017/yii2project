$(document).ready(function() {
    $(".view-large").qtip({
        content: {
            text: function(event, api) {
                var wrap = $("<div>",{
                    'class':'img-content'
                });
                var target = event.currentTarget;
                var image = $(target).find("> img").clone();
                var caption = $(target).parent().find(".bx-caption span").html();
                wrap.append(image);
                if(typeof caption !== typeof undefined && caption.length > 0) {
                    var captionWrap = $("<div>",{
                        'class':'caption'
                    });
                    captionWrap.html(caption);
                    wrap.append(captionWrap);
                }
                api.set('content.text', wrap);
                return wrap;
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
            classes: "qtip-bootstrap local-projects-popup"
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
})