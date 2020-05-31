<?php

$config['captcha']['pub']       = getenv('RECAPTCHA_PUBLIC');
$config['captcha']['priv']      = getenv('RECAPTCHA_SECRET');

$url = getenv('CLEARDB_DATABASE_URL');
$dsn = parse_url($url, PHP_URL_SCHEME) . ':dbname=' . parse_url($url, PHP_URL_PATH) . ';host=' . parse_url($url, PHP_URL_HOST);
$pdo = new PDO($dsn, parse_url($url, PHP_URL_USER), parse_url($url, PHP_URL_PASS));
