<?php
require_once('../includes/config.php');

$errors	= array();
$data	= array();

if(isset($_POST['_csrf']) && session_csrf_check($_POST['_csrf'])) {
	if(isset($_POST['email']) && !empty($_POST['email'])) {
		global $pdo;
		
		$email = $_POST['email'];
		
		$uid = session_get_user_id();
    $uid_of_email = get_user_id($email);
		$stmt = $pdo->prepare("INSERT INTO `access` (`election`, `user`, `level`) VALUES (?, ?, 254)");
		$stmt->bindParam(1, $election_id);
		$stmt->bindParam(2, $uid_of_email);
		$stmt->execute();
		log_auditable_action($uid, "make_elecadmin", $uid_of_email);
		
		$data['success'] = true;
		$data['message'] = 'Success!';
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
