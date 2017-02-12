<?php

require_once('config.php');
global $config;

$userid = session_get_user_id();
error_log($userid);
$stmt = $pdo->prepare("SELECT `election` FROM `access` WHERE `user`= ?");
$stmt->bindParam(1, $userid);
$stmt->execute();
$elections = $stmt->fetchAll();
error_log(print_r($elections, true));

?>

  <aside class="main-sidebar">

    <section class="sidebar">

      <ul class="sidebar-menu">
        <li class="header">ELECTIONS</li>
        <?php foreach ($elections as $row) {
        	error_log(print_r($row, true));
        	$stmt = $pdo->prepare("SELECT `name` FROM `elections` WHERE `id`= ?");
        	$stmt->bindParam(1, $row["election"]);
        	$stmt->execute();
        	
        	$election_name = $stmt->fetch(PDO::FETCH_NUM)[0];
        	?>
        	<li><a href="/election?id=<?php echo $row["election"]; ?>"><i class="fa fa-users"></i> <span><?php echo $election_name; ?></span></a></li>
        	<?php 
        } ?>
        <li><a href="/election?id=new"><i class="fa fa-pencil-square-o"></i> <span>New Election...</span></a></li>
      </ul>
    </section>
  </aside>