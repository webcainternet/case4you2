<?php

$root = dirname(__FILE__);
$ds = DIRECTORY_SEPARATOR;
$base_path = $root . $ds . '..' . $ds;

require $base_path . 'env.php';

$http_url = E_HTTP;
$ssl_url = E_SSL;

// HTTP
define('HTTP_SERVER', $http_url . 'admin/');
define('HTTP_CATALOG', $http_url);

// HTTPS
define('HTTPS_SERVER', $ssl_url . 'admin/');
define('HTTPS_CATALOG', $ssl_url);

// DIR
define('DIR_APPLICATION', $base_path . 'admin' . $ds);
define('DIR_SYSTEM', $base_path . 'system' . $ds);
define('DIR_DATABASE', $base_path . 'system' . $ds . 'database' . $ds);
define('DIR_LANGUAGE', $base_path . 'admin' . $ds . 'language' . $ds);
define('DIR_TEMPLATE', $base_path . 'admin' . $ds . 'view' . $ds . 'template' . $ds);
define('DIR_CONFIG', $base_path . 'system' . $ds . 'config' . $ds);
define('DIR_IMAGE', $base_path . 'image' . $ds);
define('DIR_CACHE', $base_path . 'system' . $ds . 'cache' . $ds);
define('DIR_DOWNLOAD', $base_path . 'download' . $ds);
define('DIR_LOGS', $base_path . 'system' . $ds . 'logs' . $ds);
define('DIR_CATALOG', $base_path . 'catalog' . $ds);

?>