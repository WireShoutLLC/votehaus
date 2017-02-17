$.fn.editable.defaults.mode = 'inline';

$(document).ready(function() {
	$('#election_name').editable();
	
    $('#newelectionbox').submit(function(event) {
        document.getElementById("submitbtn").disabled = true;
        document.getElementById("submitbtn").innerHTML = "Creating...";
        
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
        
        formsub.done(function(data) {
            if (!data.success) {
                document.getElementById("submitbtn").disabled = false;
                document.getElementById("submitbtn").innerHTML = "Error";
            } else {
            	$('#newelectionbox').modal('hide');
            	location.reload();
            }
        });
        event.preventDefault();
    });
});