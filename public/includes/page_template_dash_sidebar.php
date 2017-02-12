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
        	
        	$election_name = $stmt->fetch(PDO::FETCH_NUM)[0];
        	
        	if($stage == "created")
        		$infobox = '<span class="pull-right-container"><small class="label pull-right bg-purple">new</small></span>';
        	else if($stage == "polling")
        		$infobox = '<span class="pull-right-container"><small class="label pull-right bg-green">polling</small></span>';
        	else if($stage == "done")
        		$infobox = '<span class="pull-right-container"><small class="label pull-right bg-red">done</small></span>';
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