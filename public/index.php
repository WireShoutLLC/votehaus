<?php
require_once('includes/config.php');

if(session_is_logged_in()) {
	if(!isset($_GET['pg']) || empty($_GET['pg'])) {
		die(header("Location: /dashboard"));
	} else if($_GET['pg'] == "dashboard") {
		require('includes/page_dashboard.php');
	} else if($_GET['pg'] == "election") {
		$uid = session_get_user_id();
		$access = get_user_election_access($uid, $_GET['id']);
		if($access >= 250) {
			//Election Administrator
			require('includes/page_election_dashboard.php');
		} else if($access == 101) {
			//Nominee Acceptance
			require('includes/page_election_nominate_1_accepted.php');
		} else if($access == 100) {
			//Nominee Acceptance
			require('includes/page_election_nominate_1_pending.php');
		} else {
			http_response_code(404);
			require('includes/page_template_dash_404.php');
		}
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
	} else if($_GET['pg'] == "register") {
		require('includes/page_register.php');
	} else if($_GET['pg'] == "vote") {
		require('includes/page_voter_login.php');
	} else {
		http_response_code(404);
		die(header("Location: /login"));
	}
}

?>
