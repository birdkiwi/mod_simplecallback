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

        $('[data-simplecallback-form]').each(function() {
            var form = $(this),
                actionUrl = form.attr('action'),
                overlay = form.data('simplecallback-overlayed');

            //console.log(form);

            $(this).on('submit', function() {
                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: form.serialize(),
                    dataType: 'json',
                    success: function(data) {
                        if(data.error === false) {
                            alert(data.message);
                            form[0].reset();
                        } else {
                            alert(data.message);
                            console.log(data.message);
                        }
                    }
                });
                return false;
            });
        });

        $('[data-simplecallback-form-overlayed]').each(function() {
            $(this).appendTo('body');
        });

        if ($('[data-simplecallback-form-overlayed]').length > 0) {
            var overlay = $('<div class="simplecallback-overlay">');
            $('body').prepend(overlay);
        }

        $('[data-simplecallback]').each(function() {
            $(this).on('click', function() {
                var formId = $(this).data('simplecallback');

                if (formId) {
                    simplecallback.show(formId);
                } else {
                    simplecallback.show();
                }
            });
        });
    });
})(jQuery);