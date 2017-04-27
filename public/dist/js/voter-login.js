$(document).ready(function() {
    $("#voter_token").keyup(function(event){
        if(event.keyCode == 13){
            $("#next_btn").click();
        }
    });
    
    $(function() {
        $(".g-recaptcha-response").change(function() {
            $("voterloginbox").submit();
        });
    });
    
    $('#voterloginbox').submit(function(event) {
        var formData = {
            'voter_token'          : $('input[name=voter_token]').val(),
            '_csrf'                : $('input[name=_csrf]').val(),
            'g-recaptcha-response' : $('textarea[name=g-recaptcha-response]').val()
        };

        var formsub = $.ajax({
            type        : 'POST',
            url         : '/endpoints/process_voter_login.php',
            data        : formData,
            dataType    : 'json',
            encode      : true 
        });

        formsub.done(function(data) {
            if (data.success) {
              setTimeout(function() { window.location.href = "/vote"; }, 2000);
            }
        });

        event.preventDefault();
    });
});
