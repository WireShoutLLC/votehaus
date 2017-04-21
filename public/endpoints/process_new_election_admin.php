<?php
require_once('../includes/config.php');

$errors	= array();
$data	= array();

if(isset($_POST['_csrf']) && session_csrf_check($_POST['_csrf'])) {
	if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['election']) && !empty($_POST['election']) && does_election_exist($_POST['election'])) {
		global $pdo;
		
		$email = $_POST['email'];
		$uid_of_email = get_user_id($email);
		$election_id = $_POST['election'];
		if($uid_of_email != FALSE) {
			make_user_elecadmin($uid_of_email, $election_id);
			$data['success'] = true;
			$data['message'] = 'Success!';
		} else {
			$errors['name'] = 'User does not exist.';
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
