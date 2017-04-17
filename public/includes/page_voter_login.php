<?php

require_once('config.php');
require_once('page_template_login_head.php');

global $config;
?>

<body class="hold-transition lockscreen">
	<div class="lockscreen-wrapper">
		<div class="lockscreen-logo">
			<a href="#"><b>vote</b>haus</a>
		</div>
		<div class="lockscreen-name">Voter Token</div>
	
		<div class="lockscreen-item">
			<div class="lockscreen-image">
				<img src="/dist/img/ballot1-128x128.png" alt="User Image">
			</div>
			<form class="lockscreen-credentials">
				<div class="input-group">
					<input type="password" class="form-control" placeholder="password" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;" autocomplete="off">
					<div class="input-group-btn">
						<button type="button" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
					</div>
				</div>
			</form>
		</div>
		<div class="help-block text-center">
			Enter your voter token to retrieve your session
		</div>
		<div class="text-center">
			<a href="/login">Or sign in as an administrator</a>
		</div>
	</div>

	<!-- jQuery 2.2.3 -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>

<?php
require_once('page_template_login_foot.php');
?>