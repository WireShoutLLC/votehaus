<?php

$config['captcha']['pub']       = getenv('RECAPTCHA_PUBLIC');
$config['captcha']['priv']      = getenv('RECAPTCHA_SECRET');

$pdo = new PDO(getenv('CLEARDB_DATABASE_URL'));
