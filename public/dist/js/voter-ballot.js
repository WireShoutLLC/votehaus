$(document).ready(function() {
    $('#ballot_response').submit(function(event) {
        var sortableList = $("#candidates");
        var listElements = sortableList.children();
        var listValues = [];
        for (var i = 0; i < listElements.length; i++) {
            listValues.push(listElements[i].id);
        }
        
        var formData = {
            'ballot'               : listValues,
            '_csrf'                : $('input[name=_csrf]').val()
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
