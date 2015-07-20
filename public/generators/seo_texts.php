<?php

date_default_timezone_set('America/Sao_Paulo');
require "config.php";

$host = DB_HOSTNAME;
$user = DB_USERNAME;
$pass = DB_PASSWORD;
$base = DB_DATABASE;

$mysqli = new mysqli($host, $user, $pass, $base);


if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
exit();
}

$dir = dirname(__FILE__);
$file = file_get_contents($dir . '/case4you.txt');
$file = preg_split('/p(á|a)gi(.*?)\n/i', $file);

$index = 35;
$seo_id = 980;
foreach ($file as $device) {
    if (!empty($device)) {
        $device = trim($device);
        preg_match('/titulo:(.*)/i', $device, $matches);
        $title = trim($matches[1]);

        $slug = strtolower($title);
        $slug = preg_replace('/[ _&#\$]/i', '-', $slug);
        $slug = preg_replace('/[ç]/i', 'c', $slug);

        preg_match('/descrição:(.*)/i', $device, $matches);
        $description = trim($matches[1]);

        preg_match('/keywords:(.*)/i', $device, $matches);
        $keywords = trim($matches[1]);

        $device = preg_split('/h1(.*)\n/i', $device);
        $text = trim($device[1]);
        $text .= "\n";
        $text = preg_replace('/(.*?)\n/i', '<p>$1</p>', $text);
        $text = str_replace('<p></p>', '<br>', $text);
        $text = htmlspecialchars($text);

        $sql = "INSERT INTO oc_url_alias
                SET url_alias_id = $seo_id,
                    query = 'information_id=$index',
                    keyword = '$slug';";
        $mysqli->query($sql);

        $seo_id++;
        $index++;
    }

}


exit;
