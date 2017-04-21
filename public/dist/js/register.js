$(document).ready(function() {
    $('#registerbox').submit(function(event) {
        var formData = {
            'email'                : $('input[name=email]').val(),
            'password'             : $('input[name=password]').val(),
            'key'                  : $('input[name=key]').val(),
            '_csrf'                : $('input[name=_csrf]').val(),
            'g-recaptcha-response' : $('textarea[name=g-recaptcha-response]').val()
        };

        $('#registerbox').hide("slow");
        document.getElementById("greeting").innerHTML = "Processing Registration";

        var formsub = $.ajax({
            type        : 'POST',
            url         : '/endpoints/process_register.php',
            data        : formData,
            dataType    : 'json',
            encode      : true,
            error: function(){ document.getElementById("greeting").innerHTML = "Request timed out."; }
        });

        formsub.done(function(data) {
            if (!data.success) {
                if (data.errors.name) {
                    document.getElementById("greeting").innerHTML = data.errors.name;
                } else if (data.errors.captcha) {
                    document.getElementById("greeting").innerHTML = data.errors.captcha;
                } else if (data.errors.req) {
                    document.getElementById("greeting").innerHTML = data.errors.req;
                } else {
                    document.getElementById("greeting").innerHTML = "Unexpected error.";
                }
            } else {
            	document.getElementById("greeting").innerHTML = "Success!";
                setTimeout(function() { window.location.href = "/login"; }, 2000);
            }
        });

        event.preventDefault();
    });
});
