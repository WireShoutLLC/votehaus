<?php
require_once('../includes/config.php');

$errors	= array();
$data	= array();

if(isset($_POST['_csrf']) && session_csrf_check($_POST['_csrf']) && session_get_type() == "voter") {
	if(isset($_POST['ballot']) && !has_voter_voted()) {
		$election_id = get_voter_election_id();
		$json = json_encode($_POST['ballot']);
		record_ballot($election_id, $json);
		
		$data['success'] = true;
		$data['message'] = 'Success!';
	} else {
		$errors['name'] = 'Invalid election.';
	}
} else {
	$errors['req'] = 'Request is invalid.';
}

if(!empty($errors)) {
	$data['success'] = false;
	$data['errors']  = $errors;
}

echo json_encode($data);
