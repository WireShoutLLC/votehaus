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
			<div class="col-xs-12">
				<div class="alert alert-info">
					<h4><i class="icon fa fa-info"></i> Under Construction</h4>
					We are still working on this page. Please work on your questions and we will email you when this page is ready.
				</div>
			</div>
		</div>
	</section>
</div>

<?php 

require_once('page_template_dash_foot.php');

?>
