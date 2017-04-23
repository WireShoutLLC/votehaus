<?php

require_once('config.php');
global $config;

require_once('page_template_dash_head.php');
require_once('page_template_dash_sidebar.php');

$election_id = $_GET['id'];
$election_name = get_election_name($election_id);

?>

<div class="content-wrapper">
	<section class="content-header">
		<h1 id="election_name">
			<?php echo $election_name; ?>
		</h1>
		<ol class="breadcrumb">
			<li><i class="fa fa-th-list"></i> Elections</li>
			<li><?php echo $election_name; ?></li>
			<li class="active">Dashboard</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Voter Guide</h3>
					</div>
					<form name="nomination_questions" id="nomination_questions" action="endpoints/process_election_nomination_voter_answers.php" method="post">
						<div class="box-body">
							<?php csrf_render_html(); ?>
							<input type="hidden" name="election_id" value="<?php echo $election_id; ?>" />
							<?php 
							$questions = get_questions_for_election($election_id); 
							foreach($questions as $electionquestion) {
								$questiondata = json_decode($electionquestion['data'], true);
								if($questiondata['type'] == "nominee_1") {
									$qnum = 0;
									$voter_guide = $questiondata['data']['voter_guide'];
									$existing_guide = get_user_election_access_data(session_get_user_id(), $election_id);
									if(isset($existing_guide) && !empty($existing_guide)) {
										$guide = json_decode($existing_guide, true);
									}
									foreach($voter_guide as $question) { 
									if(isset($existing_guide) && !empty($existing_guide)) {
										$prefill = $guide['voter_guide'][$qnum];
									} else {
										$prefill = "";
									} ?>
									<div class="form-group">
										<label><?php echo $question['question']; ?></label>
										<textarea class="form-control" name="question-<?php echo $qnum; ?>" rows="3" maxlength="<?php echo $question['limit']; ?>" placeholder="Input your answer here"><?php echo $prefill; ?></textarea>
									</div>
									<?php
									$qnum++;
									}
								}
							} ?>
						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-info pull-right">Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>

<?php 

require_once('page_template_dash_foot.php');

?>
