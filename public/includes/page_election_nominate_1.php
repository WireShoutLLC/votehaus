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
	<section class="content">
		<div class="row">
			
		</div>
	</section>
</div>

<?php 

require_once('page_template_dash_foot.php');

?>