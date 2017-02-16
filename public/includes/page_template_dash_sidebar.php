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
        <li><a data-toggle="modal" data-target="#myModal><i class="fa fa-pencil-square-o"></i> <span>New Election...</span></a></li>
      </ul>
    </section>
  </aside>
  
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
	      </div>
	      <div class="modal-body">
	        ...
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Save changes</button>
	      </div>
	    </div>
	  </div>
	</div>