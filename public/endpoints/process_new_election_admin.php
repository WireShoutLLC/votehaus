<?php
require_once('../includes/config.php');

$errors	= array();
$data	= array();

if(isset($_POST['_csrf']) && session_csrf_check($_POST['_csrf'])) {
	if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['election']) && !empty($_POST['election']) && does_election_exist($_POST['election'])) {
		$email = $_POST['email'];
		$uid_of_email = get_user_id($email);
		$election_id = $_POST['election'];
		if($uid_of_email != FALSE) {
			set_user_election_access($uid_of_email, $election_id, 254);
			$data['success'] = true;
			$data['message'] = 'Success!';
		} else {
			if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
				create_keyed_user_account($email);
				$uid = get_user_id($email);
				set_user_election_access($uid, $election_id, 254);
				$data['success'] = true;
				$data['message'] = 'Success!';
			} else {
				$errors['name'] = 'Invalid email.';
			}
		}
	} else {
		$errors['name'] = 'Invalid name.';
	}
} else {
	$errors['req'] = 'Request is invalid.';
}

if(!empty($errors)) {
	$data['success'] = false;
	$data['errors']  = $errors;
}

echo json_encode($data);
