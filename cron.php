#!/usr/bin/php
<?php
$file = dirname(__FILE__) . '/cron.log';
$now = date('Y-m-d H:i:s', time());
file_put_contents($file, $now . "\n", FILE_APPEND | LOCK_EX);
exit;

?>
