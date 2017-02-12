<?php
require_once('includes/config.php');

if(session_is_logged_in()) {
	if(!isset($_GET['pg']) || empty($_GET['pg'])) {
		die(header("Location: /dashboard"));
	} else if($_GET['pg'] == "dashboard") {
		require('includes/page_dashboard.php');
	} else if($_GET['pg'] == "election" && $_GET['id'] == "new") {
		require('includes/page_election_new.php');
	} else if($_GET['pg'] == "election" && $_GET['id'] != "new" && is_int($_GET['id'])) {
		require('includes/page_election_edit.php');
	} else if($_GET['pg'] == "logout") {
		session_logout_user();
		header("Location: /login");
	} else {
		http_response_code(404);
		die("404: Not Found.");
	}
} else {
	if(!isset($_GET['pg']) || empty($_GET['pg'])) {
		die(header("Location: /login"));
	} else if($_GET['pg'] == "login") {
		require('includes/page_login.php');
	} else {
		http_response_code(404);
		die(header("Location: /login"));
	}
}

?>