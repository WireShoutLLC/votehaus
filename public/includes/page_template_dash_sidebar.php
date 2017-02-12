<?php

require_once('config.php');
global $config;

$userid = session_get_user_id();
$stmt = $pdo->prepare("SELECT `election` FROM `access` WHERE `user`= ?");
$stmt->bindParam(1, $userid);
$stmt->execute();
$elections = $stmt->fetchAll();

?>

  <aside class="main-sidebar">

    <section class="sidebar">

      <ul class="sidebar-menu">
        <li class="header">ELECTIONS</li>
        <?php foreach ($elections as $row) {
        	$stmt = $pdo->prepare("SELECT `name`,`stage` FROM `elections` WHERE `id`= ?");
        	$stmt->bindParam(1, $row["election"]);
        	$stmt->execute();
        	$row2 = $stmt->fetch(PDO::FETCH_NUM);
        	
        	$election_name = $row2[0];
        	$stage = $row2[1];
        	
        	if($stage == "created")
        		$infobox = '<span class="pull-right-container"><small class="label pull-right bg-yellow">new</small></span>';
        	else if($stage == "polling")
        		$infobox = '<span class="pull-right-container"><small class="label pull-right bg-red">running</small></span>';
        	else if($stage == "done")
        		$infobox = '<span class="pull-right-container"><small class="label pull-right bg-green">done</small></span>';
        	else if($stage == "archived")
        		$infobox = '<span class="pull-right-container"><small class="label pull-right bg-gray">archived</small></span>';
        	else
        		$infobox = '';
        	
        	?>
        	<li <?php if($_GET['id'] == $row['election']) { ?>class="active"<?php } ?>><a href="/election?id=<?php echo $row["election"]; ?>&subid=dashboard"><i class="fa fa-users"></i> <span><?php echo $election_name; ?></span><?php echo $infobox; ?></a></li>
        	<?php 
        } ?>
        <li <?php if($_GET['id'] == "new") { ?>class="active"<?php } ?>><a href="/election?id=new"><i class="fa fa-pencil-square-o"></i> <span>New Election...</span></a></li>
      </ul>
    </section>
  </aside>