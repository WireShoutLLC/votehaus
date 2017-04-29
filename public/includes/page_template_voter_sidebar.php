<?php

require_once('config.php');
global $config;

$election_id = get_voter_election_id();
$election_nominees = get_election_users_at_access($election_id, 101);

?>

<aside class="main-sidebar">
	<section class="sidebar">
		<ul class="sidebar-menu">
			<li class="header">Candidates</li>
			<?php foreach($election_nominees as $nominee) { 
			$voter_guide = json_decode($nominee['data'], true)['voter_guide']; ?>
			<li><a href="/vote#<?php echo $nominee['user']; ?>"><span><?php echo $voter_guide[0]; ?></span></a></li>
			<?php } ?>
			<li class="header">Ballot</li>
			<li><a href="/ballot"><span>Ballot</span></a></li>
		</ul>
    	</section>
</aside>
