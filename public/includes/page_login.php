<?php

require_once('config.php');
require_once('page_template_login_head.php');

global $config;
?>

<div class="login-logo">
	<a href="https://vote.haus"><b>vote</b>haus</a>
</div>
<div class="login-box-body">
	<p class="login-box-msg">Sign in</p>
	<form action="endpoints/process_login.php" method="post">
		<div class="form-group has-feedback">
			<input type="email" class="form-control" placeholder="Email">
			<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
		</div>
		<div class="form-group has-feedback">
			<input type="password" class="form-control" placeholder="Password">
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
				<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
			</div>
		</div>
	</form>
</div>

<?php
require_once('page_template_login_foot.php');
?>