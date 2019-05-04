<?php

require_once('public/includes/config.php');
global $pdo;

$sql = file_get_contents('database.sql');
$qr = $pdo->exec($sql);