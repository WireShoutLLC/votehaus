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
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-check-circle-o"></i> Ballot</h3>
					</div>
					<div class="box-body">
						<div class="alert alert-info">
							<h4><i class="icon fa fa-info"></i> Instructions</h4>
							This election uses the <a href="https://www.youtube.com/watch?v=3Y3jE3B8HsE&t=2s">alternative vote</a> method. To vote, drag the names of the candidates you would like to vote for ABOVE the --ORDER ABOVE HERE-- line, then order your chosen candidates from top to bottom by preference, with the top being your favorite candidate and the bottom your least. If you do not want to vote for a candidate, leave them below the --ORDER ABOVE HERE-- line.
						</div>
						<form name="ballot_response" id="ballot_response" action="endpoints/process_ballot.php" method="post">
							<ul id="candidates" class="list-group">
								<li class="list-group-item"><b>--ORDER ABOVE HERE--</b></li>
								<?php foreach($election_nominees as $nominee) { 
								$voter_guide = json_decode($nominee['data'], true)['voter_guide']; ?>
								<li class="list-group-item" id="<?php echo $nominee['user']; ?>" name="<?php echo $nominee['user']; ?>"><?php echo $voter_guide[0]; ?></li>
								<?php } ?>
							</ul>
							<button type="submit" class="btn btn-info pull-right">Submit Ballot</button>
						</form>

						<script>
						Sortable.create(candidates, { group: "ballotgroup" });
						</script>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php 

require_once('page_template_voter_foot.php');

?>
