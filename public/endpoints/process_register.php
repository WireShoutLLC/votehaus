<?php
require_once('../includes/config.php');

$errors	= array();
$data	= array();

if(isset($_POST['_csrf']) && session_csrf_check($_POST['_csrf'])) {
	$recaptcha = new \ReCaptcha\ReCaptcha($config['captcha']['priv'], new \ReCaptcha\RequestMethod\CurlPost());
	$resp = $recaptcha->verify($_POST['g-recaptcha-response']);
	if ($resp->isSuccess()) {
		if((isset($_POST['email']) && !empty($_POST['email']) && get_user_id($_POST['email']) == FALSE) && (isset($_POST['password']) && !empty($_POST['password']))) {
			global $pdo;
			
			$email = $_POST['email'];
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
			
			reset_user_password($email, $password);
			
			$data['success'] = true;
			$data['message'] = 'Success!';
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
