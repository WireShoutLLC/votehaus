$(document).ready(function() {
    $('#loginbox').submit(function(event) {
        var formData = {
            'email'                : $('input[name=email]').val(),
            'password'             : $('input[name=password]').val(),
            '_csrf'                : $('input[name=_csrf]').val(),
            'g-recaptcha-response' : $('textarea[name=g-recaptcha-response]').val()
        };

        $('#loginbox').hide("slow");
        document.getElementById("greeting").innerHTML = "Processing Login";

        var formsub = $.ajax({
            type        : 'POST',
            url         : '/endpoints/process_login.php',
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
                setTimeout(function() { window.location.href = "/dashboard"; }, 2000);
            }
        });

        event.preventDefault();
    });
});
