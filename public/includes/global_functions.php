<?php
require_once('credentials.php');
on_load();

function on_load() {
	session_start();

	$loggedin = session_is_logged_in();
	if(!isset($loggedin)) {
		session_logout_user();
	}

	if($_SESSION['last_csrf_cleanup'] + 300 < time()) {
		session_csrf_cleanup();
	}
}

//votehaus Functions
function get_current_user_all_elections() {
	$uid = session_get_user_id();
	return get_users_all_elections($uid);
}

function get_users_all_elections($uid) {
	global $pdo;
	
	$stmt = $pdo->prepare("SELECT `election` FROM `access` WHERE `user`= ?");
	$stmt->bindParam(1, $uid);
	$stmt->execute();
	$elections = $stmt->fetchAll();
	return $elections;
}

function get_user_election_access($uid, $eid) {
        global $pdo;

        $stmt = $pdo->prepare("SELECT `level` FROM `access` WHERE `user`= ? AND `election`= ?");
        $stmt->bindParam(1, $uid);
	$stmt->bindParam(2, $eid);
        $stmt->execute();
        $access = $stmt->fetchAll();
        if($stmt->rowCount() == 1) {
		$level = $access['level'];
		return $level; 
	} else {
		return false;
	}
}

function get_user_email($uid) {
        global $pdo;

        $stmt = $pdo->prepare("SELECT `email` FROM `users` WHERE `id`= ?");
        $stmt->bindParam(1, $uid);
        $stmt->execute();
        $result = $stmt->fetchAll();
	echo print_r($result, true);
        if($stmt->rowCount() == 1) {
		$email = $result['email'];
		return $email;
	} else {
		return false;
	}
}

function get_election_admins($eid) {
        global $pdo;

        $stmt = $pdo->prepare("SELECT `user`, `level` FROM `access` WHERE `election` = ? AND `level` >= 254");
	$stmt->bindParam(1, $eid);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
}

function get_questions_for_election($id) {
        global $pdo;

        $stmt = $pdo->prepare("SELECT `id`, `order`, `data` FROM `questions` WHERE `election`= ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $questions = $stmt->fetchAll();
        return $questions;
}

function get_voters_for_election($id) {
        global $pdo;

        $stmt = $pdo->prepare("SELECT `id`, `email` FROM `voters` WHERE `election`= ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $voters = $stmt->fetchAll();
        return $voters;
}

function log_auditable_action($user, $action, $details = NULL) {
	global $pdo;

        $stmt = $pdo->prepare("INSERT INTO `audit` (`user`, `action`, `details`) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $user);
	$stmt->bindParam(2, $action);
	$stmt->bindParam(3, $details);
        $stmt->execute();
}

//Session Functions
function randString($length, $charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789') {
	$str = '';
	$count = strlen($charset);
	while ($length--) {
		$str .= $charset[mt_rand(0, $count-1)];
	}
	return $str;
}

function session_is_logged_in() {
	if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
		return true;
	} else {
		return false;
	}
}

function session_login_user($uid) {
	$_SESSION['uid'] = $uid;
	$_SESSION['logged_in'] = true;
	$_SESSION['login_time'] = time();
	session_csrf_cleanup();
}

function session_get_user_id() {
	if(isset($_SESSION['uid'])) {
		return $_SESSION['uid'];
	} else {
		return false;
	}
}

function session_logout_user() {
	session_unset();
	session_destroy();
	session_start();
	$_SESSION['logged_in'] = false;
	$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
	session_csrf_cleanup();
}

function session_set_value($name, $value) {
	$_SESSION['vars'][$name] = $value;
}

function session_delete_value($name) {
	unset($_SESSION['vars'][$name]);
}

function session_get_value($name) {
	return $_SESSION['vars'][$name];
}

function session_csrf_add() {
	$value = randString(16);
	$_SESSION['csrf'][$value] = time() + 300; //5 minute expiry
	return $value;
}

function session_csrf_check($value) {
	if(!empty($_SESSION['csrf'][$value]) && time() < $_SESSION['csrf'][$value]) {
		unset($_SESSION['csrf'][$value]);
		return true;
	} else {
		return false;
	}
}

function session_csrf_cleanup() {
	if(sizeof($_SESSION['csrf']) >= 1) {
		foreach($_SESSION['csrf'] as $str => $time) {
			if($time < time()) {
				unset($_SESSION['csrf'][$str]);
			}
		}
	}
	$_SESSION['last_csrf_cleaup'] = time();
}

function csrf_render_html($fieldname = "_csrf") {
	echo csrf_get_html($fieldname);
}

function csrf_get_html($fieldname = "_csrf") {
	return '<input type="hidden" name="' . $fieldname . '" value="' . session_csrf_add() . '" />';
}
