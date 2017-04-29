<?php
require_once('../includes/config.php');

$errors	= array();
$data	= array();

if(isset($_POST['_csrf']) && session_csrf_check($_POST['_csrf']) && session_get_type() == "user") {
	if(isset($_POST['election_id']) && !empty($_POST['election_id'] && does_election_exist($_POST['election_id'])) && (isset($_POST['accept']) || isset($_POST['decline']))) {
		if(isset($_POST['accept'])) {
			set_user_election_access(session_get_user_id(), $_POST['election_id'], 101);
			
			$data['success'] = true;
			$data['message'] = 'Success!';
			
			//Redirect them for now, will ajax later
			header("Location: /election?id=" . $_POST['election_id']);
		} else if(isset($_POST['decline'])) {
			set_user_election_access(session_get_user_id(), $_POST['election_id'], 0);
			
			$data['success'] = true;
			$data['message'] = 'Success!';
			
			//Redirect them for now, will ajax later
			header("Location: /dashboard");
		} else {
			$errors['name'] = 'An error occurred.';
		}
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
