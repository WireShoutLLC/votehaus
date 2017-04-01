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
              <h3 class="box-title">Election Committee</h3>
		    
              <div class="box-tools">
                <ul class="pagination pagination-sm no-margin pull-right">
                  <li><a href="#">+</a></li>
                </ul>
              </div>
            </div>
            <div class="box-body">
              <table class="table">
                <tr>
                  <th>Email</th>
                  <th>Action</th>
                </tr>
                <tr>
                  <td>jdoe@example.com</td>
                  <td><button type="button" class="btn btn-block btn-danger btn-xs">-</button></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <ul class="timeline timeline-inverse">
            <li class="time-label">
              <span class="bg-red">
                10 Feb. 2014
              </span>
            </li>
            <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                <div class="timeline-body">
                  Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                </div>
                <div class="timeline-footer">
                  <a class="btn btn-primary btn-xs">Read more</a>
                  <a class="btn btn-danger btn-xs">Delete</a>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </section>
  </div>

<?php 

require_once('page_template_dash_foot.php');

?>
