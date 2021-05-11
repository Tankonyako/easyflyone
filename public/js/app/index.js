$(document).ready(function() {

    let app = {};

    window.rebuildSelect2 = function() {
        setTimeout(function() {

            $('.e-select-advanced').each(function(i, e) {
                let selector = $(e);
                let placeholder = $(e).attr('placeholder');
                let select2Box = $(e).select2({
                    matcher: function (params, data) {
                        var original_matcher = $.fn.select2.defaults.defaults.matcher;
                        var result = original_matcher(params, data);

                        if (result && data.children && result.children && data.children.length != result.children.length) {
                            result.children = data.children;
                        }
                        return result;
                    }
                });

                $(e).on('select2:open', function(e) {
                    // $('.select2-dropdown').hide();
                    $('.select2-search__field').attr('placeholder', placeholder);
                    // $('.select2-dropdown').fadeIn(500);
                });

                // $(e).on('select2:closing', function(e) {
                //     e.preventDefault();
                //
                //     $('.select2-dropdown').fadeOut(500, function() {
                //         selector.select2().trigger("select2:close");
                //     });
                // });
            });
        }, 100)
    }

    rebuildSelect2()

    $('.e-datepicker').datepicker({
        format: 'dd/mm/yyyy'
    });

    // setTimeout(function() {
    //     $(document.body).append($('.grecaptcha-badge').detach())
    // }, 500);

    setInterval(function() {
        $('iframe[title="recaptcha challenge"]').parent()
            .css('position', 'fixed')
            .css('top', '40px');

        $($('iframe[title="recaptcha challenge"]').parent().parent().children().get(0))
            .css('backdrop-filter', 'blur(10px)')
            .css('opacity', '1')
            .css('background-color', 'rgba(255, 255, 255, 0.2)');
    }, 500)

    window.app = app;
});
