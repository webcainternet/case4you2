#!/usr/bin/php
<?php
if (empty($argc) || $argc !== 2) exit;
define('ABANDONEDCARTS_CLI', $argc);
$_GET['route'] = 'module/abandonedcarts/sendReminder';
$_POST['store_id'] =  $argv[1];
$dir = dirname(__FILE__) . '/../../';

$file = dirname(__FILE__) . '/cron.log';
$now = date('Y-m-d H:i:s', time());
file_put_contents($file, $now . "; STORE: " . $_POST['store_id'] . "\n", FILE_APPEND | LOCK_EX);

require_once($dir . 'index.php');
?>
