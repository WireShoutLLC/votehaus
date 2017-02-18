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
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Messages</span>
              <span class="info-box-number">0</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Votes Collected</span>
              <span class="info-box-number">0</span>
              <div class="progress">
                <div class="progress-bar" style="width: 0%"></div>
              </div>
                  <span class="progress-description">
                    0 out of 0 votes have been cast
                  </span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Uploads</span>
              <span class="info-box-number">0</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Likes</span>
              <span class="info-box-number">0</span>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<?php 

require_once('page_template_dash_foot.php');

?>