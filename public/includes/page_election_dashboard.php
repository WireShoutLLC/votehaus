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
		<h1 id="election_name" data-type="text" data-url="/endpoints/process_election_modify.php" data-pk="<?php echo $election_id; ?>">
			<?php echo $election_name; ?>
		</h1>
		<ol class="breadcrumb">
			<li><i class="fa fa-th-list"></i> Elections</li>
			<li><?php echo $election_name; ?></li>
			<li class="active">Dashboard</li>
		</ol>
	</section>
	<script>$(document).ready(function() { $('#election_name').editable({ params: function(params) { params.csrf = "<?php echo session_csrf_add(); ?>"; return params; }});});</script>
	<section class="content">
		<div class="row">
			<div class="col-lg-8 col-xs-12">
				<!-- Questions -->
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Ballot Questions</h3>
					</div>
					<div class="box-body">
						<div class="nav-tabs-custom">
							<ul class="nav nav-tabs">
								<?php $questions = get_questions_for_election($election_id); 
								foreach($questions as $question) { ?>
								<li><a href="#tab_<?php echo $question['order']; ?>" data-toggle="tab" aria-expanded="false"><?php $data = json_decode($question['data'], true); echo $data['name']; ?><?php if($data['required']) { echo "*"; } ?></a></li>
								<?php } ?>
								<li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-plus-circle"></i></a></li>
							</ul>
							<div class="tab-content">
								<?php foreach($questions as $question) { ?>
								<div class="tab-pane" id="tab_<?php echo $question['order']; ?>">
									<p><?php echo $question['data']; ?></p>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-xs-12">
				<!-- Committee -->
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Election Administrators</h3>
			
						<div class="box-tools">
							<ul class="pagination pagination-sm no-margin pull-right">
								<li><a href="#" data-toggle="modal" data-target="#addElectionAdmin"><i class="fa fa-plus-circle"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="box-body">
						<table class="table">
							<tr id="admin-<?php echo $admin['user']; ?>">
								<th>Email</th>
								<th style="width: 40px">Action</th>
							</tr>
							<?php foreach($admins as $admin) { 
							$email = get_user_email($admin['user']); ?>
							<tr>
								<td><?php echo $email; ?></td>
								<td id="delete-admin-<?php echo $admin['user']; ?>">
									<form name="deleteadminbox" id="deleteadminbox" action="endpoints/process_delete_election_admin.php" method="post">
										<?php csrf_render_html(); ?>
										<input type="hidden" name="election_id_deleteadmin" value="<?php echo $election_id; ?>" />
										<input type="hidden" name="admin_id_deleteadmin" value="<?php echo $admin['user']; ?>" />
										<button type="submit" class="btn btn-block btn-danger btn-xs"><i class="fa fa-minus-square"></i></button>
									</form>
								</td>
							</tr>
							<?php } ?>
						</table>
					</div>
				</div>
				<!-- Voters -->
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Voter Import</h3>
					</div>
					<div class="box-body">
						<form>
							<div class="form-group">
								<label for="voterFile">Upload Voter CSV</label>
								<input type="file" id="voterFile">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<div class="modal fade" id="addElectionAdmin" tabindex="-1" role="dialog" aria-labelledby="addElectionAdminLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form name="newadminbox" id="newadminbox" action="endpoints/process_new_election_admin.php" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="addElectionAdminLabel">Add Election Administrator</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Admin Email Address</label>
						<?php csrf_render_html(); ?>
						<input type="hidden" name="election_id_newadmin" value="<?php echo $election_id; ?>" />
						<input type="text" class="form-control" placeholder="richard.nixon@not.crook" name="email" />
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" id="submitbtn_newadmin">Add</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php 

require_once('page_template_dash_foot.php');

?>
