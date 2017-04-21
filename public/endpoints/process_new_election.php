<?php
require_once('../includes/config.php');

$errors	= array();
$data	= array();

if(isset($_POST['_csrf']) && session_csrf_check($_POST['_csrf'])) {
	if(isset($_POST['election']) && !empty($_POST['election'])) {
		global $pdo;
		
		$election = htmlspecialchars($_POST['election']);
		
		$stmt = $pdo->prepare("INSERT INTO `elections` (`name`) VALUES (?)");
		$stmt->bindParam(1, $election);
		$stmt->execute();
		$election_id = $pdo->lastInsertId();
		$uid = session_get_user_id();
		$stmt = $pdo->prepare("INSERT INTO `access` (`election`, `user`, `level`) VALUES (?, ?, 255)");
		$stmt->bindParam(1, $election_id);
		$stmt->bindParam(2, $uid);
		$stmt->execute();
		log_auditable_action($uid, "create_election", $election_id);
		
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
