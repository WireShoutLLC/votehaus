<?php
require_once('../includes/config.php');

$errors	= array();
$data	= array();

if(isset($_POST['_csrf']) && session_csrf_check($_POST['_csrf']) && session_get_type() == "user") {
	if(isset($_POST['election_id']) && !empty($_POST['election_id']) && does_election_exist($_POST['election_id'])) {
		$election_id = $_POST['election_id'];
		$voterguidedata = array("voter_guide" => array());
		$questions = get_questions_for_election($election_id);
		foreach($questions as $electionquestion) {
			$questiondata = json_decode($electionquestion['data'], true);
			if($questiondata['type'] == "nominee_1") {
				$qnum = 0;
				$voter_guide = $questiondata['data']['voter_guide'];
				foreach($voter_guide as $question) {
					$questionform = 'question-' . $qnum;
					if(isset($_POST[$questionform]) && strlen($_POST[$questionform]) <= $question['limit']) {
						$descript = htmlspecialchars($_POST[$questionform]);
						
						$voterguidedata['voter_guide'][$qnum] = $descript;
					} else {
						$voterguidedata['voter_guide'][$qnum] = "";
					}
					$qnum++;
				}
			}
		}
		$json = json_encode($voterguidedata);
		set_user_election_access(session_get_user_id(), $election_id, 101, $json);
		$data['success'] = true;
		$data['message'] = 'Success!';
		
		//Redirect them for now, will ajax later
		header("Location: /election?id=" . $election_id);
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
