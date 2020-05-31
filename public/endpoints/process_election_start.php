<?php
require_once('../includes/config.php');

$errors	= array();
$data	= array();

if(isset($_POST['_csrf']) && session_csrf_check($_POST['_csrf']) && session_get_type() == "user") {
	if(isset($_POST['election_id']) && !empty($_POST['election_id']) && does_election_exist($_POST['election_id']) && (isset($_POST['start']) || isset($_POST['start_election']) || isset($_POST['end_election']))) {
		if(isset($_POST['start'])) {
			$election_id = $_POST['election_id'];
			$questions = get_questions_for_election($election_id); 
			foreach($questions as $question) {
				$questiondata = json_decode($question['data'], true);
				if($questiondata['type'] == "nominee_1") {
					$nominees = $questiondata['data']['nominees']; 
					foreach($nominees as $nominee) {
						if(get_user_id($nominee) == FALSE) {
							create_keyed_user_account($nominee);
						}
						set_user_election_access(get_user_id($nominee), $election_id, 100);
					}
				}
			}

			change_election_stage($election_id, 'ready');
			log_auditable_action($uid, "start_nom", $election_id);

			$data['success'] = true;
			$data['message'] = 'Success!';
		} else if(isset($_POST['start_election'])) {
			$election_id = $_POST['election_id'];
			$questions = get_questions_for_election($election_id); 
			foreach($questions as $question) {
				$questiondata = json_decode($question['data'], true);
				if($questiondata['type'] == "nominee_1") {
					$nominees = $questiondata['data']['nominees']; 
					foreach($nominees as $nominee) {
						$nom = get_user_id($nominee);
						if(get_user_election_access($nom) == 100) {
							//Auto-decline those who havent accepted
							set_user_election_access($nom, $election_id, 0);
						}
					}
				}
			}

			change_election_stage($election_id, 'polling');
			log_auditable_action($uid, "start_election", $election_id);

			$data['success'] = true;
			$data['message'] = 'Success!';
		} else if(isset($_POST['end_election'])) {
			$election_id = $_POST['election_id'];
			$questions = get_questions_for_election($election_id); 

			change_election_stage($election_id, 'done');
			log_auditable_action($uid, "end_election", $election_id);

			$data['success'] = true;
			$data['message'] = 'Success!';
		}
	} else {
		$errors['name'] = 'Invalid election.';
	}
} else {
	$errors['req'] = 'Request is invalid.';
}

if(!empty($errors)) {
	$data['success'] = false;
	$data['errors']  = $errors;
}

echo json_encode($data);
