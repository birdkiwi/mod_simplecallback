(function ($) {
    $(function () {
        $('[data-simplecallback-form]').each(function() {
            var form = $(this),
                actionUrl = form.attr('action'),
                overlay = form.data('simplecallback-overlay');

            console.log(form);

            $(this).on('submit', function(){
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
                        //overlay.fadeOut();
                    }
                });
                return false;
            });
        });
    });
})(jQuery);