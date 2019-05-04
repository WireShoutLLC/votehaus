<?php

require_once('includes/config.php');
global $pdo;

$sql = file_get_contents('database.sql');
$qr = $pdo->exec($sql);