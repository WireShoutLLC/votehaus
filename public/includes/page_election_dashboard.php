<?php

require_once('config.php');
global $config;

require_once('page_template_dash_head.php');
require_once('page_template_dash_sidebar.php');

$stmt = $pdo->prepare("SELECT `name` FROM `elections` WHERE `id`= ?");
$stmt->bindParam(1, $_GET['id']);
$stmt->execute();
$election_name = $stmt->fetch(PDO::FETCH_NUM)[0];

$admins = get_election_admins($_GET['id']);

?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1 id="election_name" data-type="text" data-url="/endpoints/process_election_modify.php" data-pk="<?php echo $_GET['id']; ?>">
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
        <div class="col-lg-5 col-xs-12">
          <!-- Questions -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Ballot Questions</h3>
            </div>
            <div class="box-body">
              <?php $questions = get_questions_for_election($_GET['id']); ?>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-xs-12">
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
              <?php $voters = get_voters_for_election($_GET['id']); ?>
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
                <tr>
                  <th>Email</th>
                  <th style="width: 40px">Action</th>
                </tr>
		<?php foreach($admins as $admin) { 
                        $email = get_user_email($admin['user']);?>
                <tr>
                  <td><?php echo $admin['user']; ?></td>
                  <td><button type="button" class="btn btn-block btn-danger btn-xs"><i class="fa fa-minus-square"></i></button></td>
                </tr>
		<?php } ?>
              </table>
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
						<input type="text" class="form-control" placeholder="richard.nixon@not.crook" name="email" />
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" id="submitbtn">Add</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php 

require_once('page_template_dash_foot.php');

?>
