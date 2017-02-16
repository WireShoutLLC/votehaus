$(document).ready(function() {
    $('#newelectionbox').submit(function(event) {
        var formData = {
            'election'             : $('input[name=election]').val(),
            '_csrf'                : $('input[name=_csrf]').val()
        };


        var formsub = $.ajax({
            type        : 'POST',
            url         : '/endpoints/process_new_election.php',
            data        : formData,
            dataType    : 'json',
            encode      : true
        });

        event.preventDefault();
    });
});
