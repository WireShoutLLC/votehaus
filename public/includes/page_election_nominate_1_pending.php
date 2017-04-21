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
			<div class="col-lg-9 col-xs-12">
				<!-- Questions -->
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Nomination Notice</h3>
					</div>
					<div class="box-body">
						<h3>Congratulations, you have been nominated!</h3>
						<p>Please read the following notice from the Election Administrators:</p>
						<?php
						$questions = get_questions_for_election($election_id); 
						foreach($questions as $question) {
							$questiondata = json_decode($question['data'], true);
							if($questiondata['type'] == "nominee_1") {
								echo $questiondata['data']['acceptance_notice'];
							}
						}
						?>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-xs-12">
				<!-- Questions -->
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Nomination Acceptance</h3>
					</div>
					<div class="box-body">
						<p>Would you like to accept this nomination and participate in this election?</p>
						<form name="nomination_acceptance" id="nomination_acceptance" action="endpoints/process_election_nomination_acceptance.php" method="post">
							<?php csrf_render_html(); ?>
							<input type="hidden" name="election_id" value="<?php echo $election_id; ?>" />
							<button type="submit" name="accept" class="btn btn-block btn-success btn-lg">I Accept</button>
							<button type="submit" name="decline" class="btn btn-block btn-danger btn-lg">I Decline</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php 

require_once('page_template_dash_foot.php');

?>
