<?php

require_once('config.php');
global $config;

require_once('page_template_dash_head.php');
require_once('page_template_dash_sidebar.php');

$stmt = $pdo->prepare("SELECT `name` FROM `elections` WHERE `id`= ?");
$stmt->bindParam(1, $_GET['id']);
$stmt->execute();
$election_name = $stmt->fetch(PDO::FETCH_NUM)[0];

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
        <div class="col-lg-6 col-xs-12">
          <!-- Questions -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Ballot Questions</h3>
            </div>
            <div class="box-body">

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

            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-xs-12">
          <!-- Committee -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Election Committee</h3>
            </div>
            <div class="box-body">

            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<?php 

require_once('page_template_dash_foot.php');

?>