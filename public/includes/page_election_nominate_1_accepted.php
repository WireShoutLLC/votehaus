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
					<form class="form-horizontal">
						<div class="box-body">
							<?php 
							$questions = get_questions_for_election($election_id); 
							foreach($questions as $electionquestion) {
								$questiondata = json_decode($electionquestion['data'], true);
								if($questiondata['type'] == "nominee_1") {
									$voter_guide = $questiondata['data']['voter_guide']; 
									foreach($voter_guide as $question) { ?>
									<div class="form-group">
										<label><?php echo $question['question']; ?></label>
										<textarea class="form-control" rows="3" maxlength="<?php echo $question['limit']; ?>" placeholder="Input your answer here"></textarea>
									</div>
									<?php
									}
								}
							} ?>
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
