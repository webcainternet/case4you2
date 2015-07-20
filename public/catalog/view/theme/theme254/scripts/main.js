$(document).ready(function() {
    $('[placeholder]').each(function(){
        var $this = $(this);

        if (!$this.val() || $this.val() === '') {
            $this.val($this.attr('placeholder'));

            if ($this.attr('type') === 'password') {
                $this.attr('type', 'text');
                $this.attr('passworded', true);
            }
        }
    });

    $('[placeholder]').focus(function() {
        var $this = $(this),
            defaultValue = $this.attr('placeholder'),
            value = $this.val();

        if (value === defaultValue) {
            $(this).val('');
        }

        if ($this.attr('passworded')) {
            $this.attr('type', 'password');
        }
    });

    $('[placeholder]').blur(function(){
        var $this = $(this),
            defaultValue = $this.attr('placeholder'),
            value = $this.val();

        if (value === '' || value === defaultValue) {
            $this.val(defaultValue);
            if ($this.attr('type') === 'password') {
                $this.attr('type', 'text');
                $this.attr('passworded', true);
            }
        }
    });

    if ($('.main-shining .flexslider').length > 0) {
        $('.main-shining .flexslider').flexslider({
            animation: "slide"
        });
    }

    $('.newsletter-form').submit(function(e){
        e.preventDefault();

        var params = $(this).serialize();

        $.ajax({
            url: baseUrl + 'index.php?route=module/builder_4_you/record_newsletter',
            type: 'POST',
            data: params,
            success: function(data) {
                alert("Email cadastrado com sucesso!");
                $('input[name=txtnews]').val('');
            }
        });
    });

    $('.contact-form').submit(function(e){
        e.preventDefault();

        var params = $(this).serialize();

        $.ajax({
            url: baseUrl + 'index.php?route=module/builder_4_you/send_contact_email',
            type: 'POST',
            data: params,
            success: function(data) {
                $('.contact-us input').val('');
                alert("Mensagem enviada com sucesso! Responderemos o mais rápido possível.");
            }
        });
    });
});
