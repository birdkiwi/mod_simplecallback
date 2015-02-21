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
                            alert('Благодарим вас, ваше сообщение было отправлено. Наш менеджер свяжется при необходимости');
                            form[0].reset();
                        } else {
                            alert('Произошла ошибка, пожалуйста, попробуйте снова или позвоните нам!');
                            alert(data.messages);
                            console.log(data.messages);
                        }
                        //overlay.fadeOut();
                    }
                });
                return false;
            });
        });
    });
})(jQuery);