<?php
require_once('../includes/config.php');
require_once('../includes/credentials.php');

$errors	= array();
$data	= array();

if(isset($_POST['csrf']) && session_csrf_check($_POST['csrf'])) {
	if((isset($_POST['name']) && !empty($_POST['name'])) && (isset($_POST['pk']) && !empty($_POST['pk']) && is_numeric($_POST['pk'])) && (isset($_POST['value']) && !empty($_POST['value']))) {
		if($_POST['name'] == "election_name") {
			
			
			$data['success'] = true;
			$data['message'] = 'Success!';
		} else {
			$errors['name'] = 'Invalid name.';	
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
