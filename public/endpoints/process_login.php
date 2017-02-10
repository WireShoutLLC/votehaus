<?php
require_once('../includes/config.php');

$errors	= array();
$data	= array();

if(isset($_POST['_csrf']) && session_csrf_check($_POST['_csrf'])) {
	$recaptcha = new \ReCaptcha\ReCaptcha($config['captcha']['priv'], new \ReCaptcha\RequestMethod\CurlPost());
	$resp = $recaptcha->verify($_POST['g-recaptcha-response']);
	if ($resp->isSuccess()) {
		if((isset($_POST['email']) && !empty($_POST['email'])) && (isset($_POST['password']) && !empty($_POST['password']))) {
			global $pdo;
			
			$email = $_POST['email'];
			$password = $_POST['password'];
			
			$stmt = $pdo->prepare("SELECT `password`,`id` FROM `users` WHERE `email`= ?");
			$stmt->bindParam(1, $email);
			$stmt->execute();
			if($stmt->rowCount() == 1) {
				$passwordhash = $stmt->fetch(PDO::FETCH_NUM)[0];
				$userid = $stmt->fetch(PDO::FETCH_NUM)[1];
				
				if(password_verify($password, $passwordhash)) {
					session_login_user($userid);
			
					$data['success'] = true;
				    $data['message'] = 'Success!';
				} else {
					$errors['name'] = 'Email or password is invalid.';
				}
			} else {
				$errors['name'] = 'Email or password is invalid.';
			}
		} else {
			$errors['name'] = 'Email or password is invalid.';
		}
	} else {
		$errors['captcha'] = 'Captcha is invalid.';
	}
} else {
	$errors['req'] = 'Request is invalid.';
}

if(!empty($errors)) {
    $data['success'] = false;
    $data['errors']  = $errors;
}

echo json_encode($data);