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
		$level = $access[0]['level'];
		return $level; 
	} else {
		return false;
	}
}

function does_user_have_election_access($uid, $eid) {
	global $pdo;

	$stmt = $pdo->prepare("SELECT `level` FROM `access` WHERE `user`= ? AND `election`= ?");
	$stmt->bindParam(1, $uid);
	$stmt->bindParam(2, $eid);
	$stmt->execute();
	if($stmt->rowCount() == 1) {
		return true;
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
        if($stmt->rowCount() == 1) {
		$email = $result[0]['email'];
		return $email;
	} else {
		return false;
	}
}

function get_user_id($email) {
        global $pdo;

        $stmt = $pdo->prepare("SELECT `id` FROM `users` WHERE `email`= ?");
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if($stmt->rowCount() == 1) {
		$id = $result[0]['id'];
		return $id;
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

function get_election_name($eid) {
	global $pdo;

	$stmt = $pdo->prepare("SELECT `name` FROM `elections` WHERE `id`= ?");
	$stmt->bindParam(1, $_GET['id']);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_NUM)[0];
	return $result;
}

function get_questions_for_election($id) {
        global $pdo;

        $stmt = $pdo->prepare("SELECT `id`, `order`, `data` FROM `questions` WHERE `election`= ? ORDER BY `order` ASC");
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

function make_user_elecadmin($uid, $eid) {
	global $pdo;
	
	$stmt = $pdo->prepare("INSERT INTO `access` (`election`, `user`, `level`) VALUES (?, ?, 254)");
	$stmt->bindParam(1, $eid);
	$stmt->bindParam(2, $uid);
	$stmt->execute();
	
	$admin = session_get_user_id();
	log_auditable_action($admin, "make_elecadmin", $uid);
}

function delete_user_elecadmin($uid, $eid, $override = false) {
	global $pdo;
	
	$admin = session_get_user_id();
	$adminaccess = get_user_election_access($admin, $eid);
	
	if(($uid != $admin && $adminaccess == 255) || $override) { 
		$stmt = $pdo->prepare("DELETE FROM `access` WHERE `election` = ? AND `user` = ?");
		$stmt->bindParam(1, $eid);
		$stmt->bindParam(2, $uid);
		$stmt->execute();

		log_auditable_action($admin, "del_elecadmin", $uid);
		
		return true;
	} else {
		return false;
	}
}

function render_question($questiondata) {
	global $pdo;
	
	if($questiondata['type'] == "nominee_1") {
		?>
		<div class="alert alert-success">
			<h4><i class="icon fa fa-ban"></i><?php echo $questiondata['type']; ?></h4>
			It works!
		</div>
		<?php 
	} else {
		?>
		<div class="alert alert-danger">
			<h4><i class="icon fa fa-ban"></i>Invalid Question Type</h4>
			The question type "<?php echo $questiondata['type']; ?>" does not exist.
		</div>
		<?php 
	}
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
