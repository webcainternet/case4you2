<?php

// admin
// fe050100

$e_environment = 'production';

// $http_url = 'http://localhost:8000/';
// $ssl_url = 'http://localhost:8000/';

$http_url = 'http://localhost/case4you/';
$ssl_url = 'http://localhost/case4you/';
$e_db = array(
    'driver' => 'mysqli',
    'host' => 'localhost',
    'user' => 'root',
    'password' => 'root',
    'name' => 'case4you3',
    'prefix' => 'oc_'
);
$fb_app_id = '471823169628940';
$instagram_app_id = '9a41ddd0fb534e4fbafda7f33e7a7cdc';

switch ($e_environment) {
    case 'production':
        $http_url = 'http://case4you.com.br/';
        $ssl_url = 'https://case4you.com.br/';
        $e_db['host'] = 'localhost';
        $e_db['user'] = 'case4you';
        $e_db['password'] = 'c12qw12qw';
        $e_db['name'] = 'case4you';
        $fb_app_id = '438300016306972';
        $instagram_app_id = '273ebb9258394cf3a5fcb5f73baa0e31';
        break;

    case 'test':
        break;

    default:
        break;
}

define('FB_APP_ID', $fb_app_id);
define('INSTAGRAM_APP_ID', $instagram_app_id);

define('E_HTTP', $http_url);
define('E_SSL', $ssl_url);

define('DB_DRIVER', $e_db['driver']);
define('DB_HOSTNAME', $e_db['host']);
define('DB_USERNAME', $e_db['user']);
define('DB_PASSWORD', $e_db['password']);
define('DB_DATABASE', $e_db['name']);
define('DB_PREFIX', $e_db['prefix']);

?>
