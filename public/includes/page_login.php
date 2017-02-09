<?php

require_once('config.php');
require_once('page_template_login_head.php');
?>

<div class="login-logo">
<a href="https://vote.haus"><b>vote</b>haus</a>
</div>
<!-- /.login-logo -->
<div class="login-box-body">
<p class="login-box-msg">Sign in to start your session</p>

<form action="#" method="post">
<div class="form-group has-feedback">
<input type="email" class="form-control" placeholder="Email">
<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
</div>
<div class="form-group has-feedback">
<input type="password" class="form-control" placeholder="Password">
<span class="glyphicon glyphicon-lock form-control-feedback"></span>
</div>
<div class="row">
<div class="col-xs-8">
<div class="checkbox icheck">
<label>
<input type="checkbox"> Remember Me
</label>
</div>
</div>
<!-- /.col -->
<div class="col-xs-4">
<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
</div>
<!-- /.col -->
</div>
</form>

<a href="#">I forgot my password</a><br>

</div>
<!-- /.login-box-body -->

<?php
require_once('page_template_login_foot.php');
?>