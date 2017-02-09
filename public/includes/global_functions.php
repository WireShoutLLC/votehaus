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