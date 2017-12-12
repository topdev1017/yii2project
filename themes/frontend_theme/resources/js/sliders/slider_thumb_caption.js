$(document).ready(function() {
    
    
    /*$(".pager").on("click","a",function(e) {
        var that = $(this);
        var slideIndex = that.attr("data-slide-index");
        
        $(".slide-info .slide").hide();;
        $(".slide-info .slide").eq(slideIndex).show();
    });*/
    
    $(".question-popup").qtip({
            content: {
                text: function(event, api) {
                    $.ajax({ 
                        url: applications_help_form_url,                         
                        type: 'GET'
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
                classes: "qtip-bootstrap applications-popup"
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
});