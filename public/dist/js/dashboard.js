$.fn.editable.defaults.mode = 'inline';

$(document).ready(function() {
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
    
    $('#newadminbox').submit(function(event) {
        document.getElementById("submitbtn_newadmin").disabled = true;
        document.getElementById("submitbtn_newadmin").innerHTML = "Adding...";
        
        var formData = {
            'election'             : $('input[name=election_id_newadmin]').val(),
            'email'                : $('input[name=email]').val(),
            '_csrf'                : $('input[name=_csrf]').val()
        };

        var formsub = $.ajax({
            type        : 'POST',
            url         : '/endpoints/process_new_election_admin.php',
            data        : formData,
            dataType    : 'json',
            encode      : true
        });
        
        formsub.done(function(data) {
            if (!data.success) {
                document.getElementById("submitbtn_newadmin").disabled = false;
                document.getElementById("submitbtn_newadmin").innerHTML = "Error";
            } else {
            	$('#newadminbox').modal('hide');
            	location.reload();
            }
        });
        event.preventDefault();
    });
});
