<?php
require_once('includes/config.php');

if(session_is_logged_in()) {
	if(session_get_type() == "user") {
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
				$stage = get_election_stage($_GET['id']);
				if($stage == "ready") {
					require('includes/page_election_nominate_1_accepted.php');
				} else if($stage == "polling") {
					require('includes/page_election_nominate_1_locked.php');
				} else {
					http_response_code(404);
					require('includes/page_template_dash_404.php');
				}
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
			die(header("Location: /vote"));
		} else if($_GET['pg'] == "vote") {
			if(!has_voter_voted()) {
				require('includes/page_voter_dashboard.php');
			} else {
				require('includes/page_voter_success.php');
			}
		} else if($_GET['pg'] == "ballot") {
			if(!has_voter_voted()) {
				require('includes/page_voter_ballot.php');
			} else { 
				require('includes/page_voter_success.php');
			}
		} else if($_GET['pg'] == "logout") {
			session_logout_user();
			header("Location: /vote");
		} else {
			http_response_code(404);
			require('includes/page_template_dash_404.php');
		}
	}
} else {
	if(!isset($_GET['pg']) || empty($_GET['pg'])) {
		die(header("Location: /login"));
	} else if($_GET['pg'] == "login") {
		require('includes/page_login.php');
	} else if($_GET['pg'] == "register" && has_valid_reg_key($_GET['email'], $_GET['key'])) {
		require('includes/page_register.php');
	} else if($_GET['pg'] == "vote") {
		require('includes/page_voter_login.php');
	} else {
		http_response_code(404);
		die(header("Location: /login"));
	}
}

?>
