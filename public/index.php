<?php
require_once('includes/config.php');

if(session_is_logged_in()) {
	if(!isset($_GET['pg']) || empty($_GET['pg'])) {
		die(header("Location: /dashboard"));
	} else if($_GET['pg'] == "dashboard") {
		require('includes/page_dashboard.php');
	} else if($_GET['pg'] == "election" && $_GET['id'] != "new" && is_numeric($_GET['id']) && $_GET['subid'] == "dashboard") {
		require('includes/page_election_dashboard.php');
	} else if($_GET['pg'] == "election" && $_GET['id'] != "new" && is_numeric($_GET['id']) && $_GET['subid'] == "edit") {
		require('includes/page_election_edit.php');
	} else if($_GET['pg'] == "logout") {
		session_logout_user();
		header("Location: /login");
	} else {
		http_response_code(404);
		require('includes/page_template_dash_404.php');
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
