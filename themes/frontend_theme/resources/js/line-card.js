$(document).ready(function() {
    $(".main-content").on("click",".scale-filter a",function(e) {
        e.preventDefault();
        var that = $(this);
        var container = that.closest(".scale-filter");
        var value = that.attr("data-cost-range");
        var form = $("#line-card-form");
        var formInput = $("#line-card-form .cost-range");

        if(typeof value !== typeof undefined) {
            if(value == "all") {
                var value = "";
            }
            formInput.val(value);
            form.submit();
        }

    });

    $(".main-content").on("change",".search-manufacture-input",function(e) {
        var val = $(this).val();
        var transitionSpeed = 500;
        var letter = val.charAt(0).toUpperCase();
        if(!/^[A-Z]/i.test(letter)) {
            letter = 'numeric';
        }
        var target = '.manufacture-group_'+letter;

        var offset = 0;

        if(typeof target !== typeof undefined) {
            // scroll to target
            offset = $(target).offset().top;
        } 
        $("html, body").animate({ scrollTop: offset }, transitionSpeed);
    });
});