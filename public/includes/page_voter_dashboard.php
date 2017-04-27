<?php

require_once('config.php');
global $config;

require_once('page_template_voter_head.php');
require_once('page_template_voter_sidebar.php');

$election_id = get_voter_election_id();
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
			<li class="active">Vote</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			
		</div>
	</section>
</div>

<?php 

require_once('page_template_dash_foot.php');

?>
