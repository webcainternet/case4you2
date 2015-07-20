<?php

require 'env.php';

define('HTTP_SERVER', E_HTTP);
define('HTTPS_SERVER', E_SSL);

$root = dirname(__FILE__);
$ds = DIRECTORY_SEPARATOR;
$base_path = $root . $ds;

// DIR
define('DIR_APPLICATION', $base_path . 'catalog' . $ds);
define('DIR_SYSTEM', $base_path . 'system' . $ds);
define('DIR_DATABASE', $base_path . 'system' . $ds . 'database' . $ds);
define('DIR_LANGUAGE', $base_path . 'catalog' . $ds . 'language' . $ds);
define('DIR_TEMPLATE', $base_path . 'catalog' . $ds . 'view' . $ds . 'theme' . $ds);
define('DIR_CONFIG', $base_path . 'system' . $ds . 'config' . $ds);
define('DIR_IMAGE', $base_path . 'image' . $ds);
define('DIR_CACHE', $base_path . 'system' . $ds . 'cache' . $ds);
define('DIR_DOWNLOAD', $base_path . 'download' . $ds);
define('DIR_LOGS', $base_path . 'system' . $ds . 'logs' . $ds);
?>
