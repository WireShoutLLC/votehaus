<?php

require_once('config.php');
require_once('page_template_login_head.php');

global $config;
?>

<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<a href="https://vote.haus"><b>vote</b>haus</a>
		</div>
		<div class="login-box-body">
			<h2 class="login-box-msg" id="greeting">Sign In</h2>
			<form name="loginbox" id="loginbox" action="endpoints/process_login.php" method="post">
				<div class="form-group has-feedback">
					<input name="email" id="email" type="email" class="form-control" placeholder="Email">
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input name="password" id="password" type="password" class="form-control" placeholder="Password">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<div class="g-recaptcha" data-sitekey="<?php echo $config['captcha']['pub']; ?>"></div>
				</div>
				<?php csrf_render_html(); ?>
				<div class="row">
					<div class="col-xs-8">
						<a href="#" class="btn btn-primary btn-block btn-flat">Forgot Password</a>
					</div>
					<div class="col-xs-4">
						<button class="btn btn-primary btn-block btn-flat">Sign In</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	
	<!-- jQuery 2.2.3 -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
	<script src="dist/js/login.js"></script>
</body>
<?php
require_once('page_template_login_foot.php');
?>