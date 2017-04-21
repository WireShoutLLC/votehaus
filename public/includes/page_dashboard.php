<?php

require_once('config.php');
global $config;

require_once('page_template_dash_head.php');
require_once('page_template_dash_sidebar.php');

?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
      	Dashboard
      </h1>
      <ol class="breadcrumb">
        <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="alert alert-info">
            <h4><i class="icon fa fa-info"></i> Select an Election</h4>
            Please select an election from the sidebar.
          </div>
        </div>
      </div>
    </section>
  </div>

<?php 

require_once('page_template_dash_foot.php');

?>
