$(document).ready(function() {
    $('#ballot_response').submit(function(event) {
        var $sortableList = $("#candidates");
        var listElements = $sortableList.children();
        var listValues = [];
        listElement.forEach(function(element){
            listValues.push(element.innerHTML);
        });
        
        var formData = {
            'ballot'               : listValues,
            '_csrf'                : $('input[name=_csrf]').val(),
            'g-recaptcha-response' : $('textarea[name=g-recaptcha-response]').val()
        };

        var formsub = $.ajax({
            type        : 'POST',
            url         : '/endpoints/process_ballot.php',
            data        : formData,
            dataType    : 'json',
            encode      : true 
        });

        formsub.done(function(data) {
            if (data.success) {
              setTimeout(function() { window.location.href = "/vote"; }, 100);
            }
        });

        event.preventDefault();
    });
});
