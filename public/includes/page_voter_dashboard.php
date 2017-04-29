<?php

require_once('config.php');
global $config;

require_once('page_template_voter_head.php');
require_once('page_template_voter_sidebar.php');

$election_id = get_voter_election_id();
$election_name = get_election_name($election_id);
$election_nominees = get_election_users_at_access($election_id, 101);

?>

<div class="content-wrapper">
	<section class="content-header">
		<h1 id="election_name">
			<?php echo $election_name; ?>
		</h1>
		<ol class="breadcrumb">
			<li><i class="fa fa-th-list"></i> Elections</li>
			<li><?php echo $election_name; ?></li>
			<li class="active">Vote</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<?php foreach($election_nominees as $nominee) { 
				$nom_voter_guide = json_decode($nominee['data'], true)['voter_guide']; ?>
				<div class="box box-default" id="<?php echo $nominee['user']; ?>">
					<div class="box-body">
						<?php 
						$questions = get_questions_for_election($election_id); 
						foreach($questions as $electionquestion) {
							$questiondata = json_decode($electionquestion['data'], true);
							if($questiondata['type'] == "nominee_1") {
								$voter_guide = $questiondata['data']['voter_guide'];
								foreach($voter_guide as $question) { ?>
								<h3><?php echo $question['question']; ?></h3>
								<p><?php echo $nom_voter_guide[0]; ?></p>
								<hr />
								<?php
								}
							}
						} ?>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</section>
</div>

<?php 

require_once('page_template_voter_foot.php');

?>
