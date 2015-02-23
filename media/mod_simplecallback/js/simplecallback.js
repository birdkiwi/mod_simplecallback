(function ($) {
    $(function () {

        var simplecallback = {
            show: function(id) {
                $('.simplecallback-overlay').fadeIn();

                if (id) {
                    $('body > #simplecallback-' + id).fadeIn();
                } else {
                    $('[data-simplecallback-form-overlayed]').first().fadeIn();
                }
            },
            hide: function() {
                $('body > [id^="simplecallback-"]').fadeOut();
                $('.simplecallback-overlay').fadeOut();
            }
        };

        window.simplecallback = simplecallback;

        $('[data-simplecallback-form]').on('submit', function() {
            var form = $(this),
                actionUrl = form.attr('action'),
                captcha = form.find('.simplecallback-captcha');

            $.ajax({
                type: "POST",
                url: actionUrl,
                data: form.serialize(),
                dataType: 'json',
                success: function(data) {
                    if(data.error === false) {
                        alert(data.message);
                        form[0].reset();
                        simplecallback.hide();
                    } else {
                        alert(data.message);
                        //console.log(data.message);
                    }
                }
            });

            captcha.attr('src', captcha.attr('src') + '?rand=' + Math.random());

            return false;
        });

        $('[data-simplecallback-form-overlayed]').each(function() {
            $(this).appendTo('body');
        });

        if ($('[data-simplecallback-form-overlayed]').length > 0) {
            var overlay = $('<div class="simplecallback-overlay">');
            $('body').prepend(overlay);
        }

        $('[data-simplecallback-open]').on('click', function() {
            var formId = $(this).data('simplecallback');

            if (formId) {
                simplecallback.show(formId);
            } else {
                simplecallback.show();
            }

            return false;
        });

        $('[data-simplecallback-close]').on('click', function() {
            simplecallback.hide();

            return false;
        });
    });
})(jQuery);