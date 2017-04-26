<?php

require_once('config.php');
global $config;

$elections = get_current_user_all_elections();
$election_id = $_GET['id'];

?>
<aside class="main-sidebar">
	<section class="sidebar">
		<ul class="sidebar-menu">
			<li class="header">ELECTIONS</li>
	        <?php foreach ($elections as $row) {
	        	$election_name = get_election_name($election_id);
	        	$stage = get_election_stage($election_id);
	        	
	        	if($stage == "created")
	        		$infobox = '<span class="pull-right-container"><small class="label pull-right bg-yellow">new</small></span>';
	        	else if($stage == "ready")
	        		$infobox = '<span class="pull-right-container"><small class="label pull-right bg-green">ready</small></span>';
	        	else if($stage == "polling")
	        		$infobox = '<span class="pull-right-container"><small class="label pull-right bg-red">running</small></span>';
	        	else if($stage == "done")
	        		$infobox = '<span class="pull-right-container"><small class="label pull-right bg-gray">done</small></span>';
	        	else
	        		$infobox = '';
	        	
	        	if($stage != "archived") {
	        	?>
        	<li <?php if($election_id == $row['election']) { ?>class="active"<?php } ?>><a href="/election?id=<?php echo $row["election"]; ?>"><i class="fa fa-users"></i> <span><?php echo $election_name; ?></span><?php echo $infobox; ?></a></li>
	        	<?php 
	        	}
	        } ?>
		<?php if (get_user_sysadmin_level(session_get_user_id()) > 0) { ?>
        	<li><a href="#" data-toggle="modal" data-target="#createElection"><i class="fa fa-pencil-square-o"></i> <span>New Election...</span></a></li>
		<?php } ?>
      	</ul>
    </section>
</aside>
  
<div class="modal fade" id="createElection" tabindex="-1" role="dialog" aria-labelledby="createElectionLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form name="newelectionbox" id="newelectionbox" action="endpoints/process_new_election.php" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="createElectionLabel">Create Election</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Election Name</label>
						<?php csrf_render_html(); ?>
						<input type="text" class="form-control" placeholder="The Most Democratic Election Ever" name="election" />
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" id="submitbtn">Create</button>
				</div>
			</form>
		</div>
	</div>
</div>
