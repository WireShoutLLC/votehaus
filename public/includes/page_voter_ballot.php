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
			<li class="active">Ballot</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="alert alert-info">
					<h4><i class="icon fa fa-info"></i> Instructions</h4>
					This election uses the single transferable voting method. To vote, drag the names of the candidates you would like to vote for to the ballot, then order them from top to bottom by preferance, with the top being your favorite candidate and the bottom your least. If you do not want to vote for a candidate, leave them off of your ballot.
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 col-xs-12">
				<!-- Ballot -->
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-tag"></i> Ballot</h3>
					</div>
					<div class="box-body">
						<p>Test</p>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-xs-12">
				<!-- Options -->
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-tag"></i> Candidate Options</h3>
					</div>
					<div class="box-body">
						<p>Test</p>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php 

require_once('page_template_voter_foot.php');

?>
