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

    $dir = DIR_IMAGE . 'data/gallery4you/Igor-Rosa/';
    $now = date('Y-m-d H:i:s', time());
    $gallery_name = "Igor Rosa";

    $sql = "SELECT id FROM oc_g4y_galleries WHERE name = '$gallery_name'";
    $rs = $mysqli->query($sql);
    if ($rs->num_rows < 1) {
        $sql = "INSERT INTO oc_g4y_galleries (name, created_at, updated_at) VALUES('$gallery_name', '$now', '$now');";
        $mysqli->query($sql);

        $id_sql = "SELECT id FROM oc_g4y_galleries ORDER BY id DESC LIMIT 1";
    } else {
        $id_sql = "SELECT id FROM oc_g4y_galleries WHERE name = '$gallery_name' ORDER BY id DESC LIMIT 1";
    }
    $rs = $mysqli->query($sql);
    $id = 0;
    while ($row = $rs->fetch_row()) {
        $id = (int) $row[0];
    }

    foreach (glob($dir . '*.png') as $filename) {
        $size = getimagesize($filename);
        $width = $size[0];
        $height = $size[1];

        echo "> Start: $filename;\n";

        $picture = explode('data', $filename);
        $picture = 'data' . $picture[1];

        $now = date('Y-m-d H:i:s', time());

        $sql = "SELECT * FROM oc_g4y_gallery_items WHERE g4y_gallery_id = $id AND picture = '$picture'";

        $rs = $mysqli->query($sql);

        if ($rs->num_rows < 1) {
            $sql = "INSERT INTO oc_g4y_gallery_items (g4y_gallery_id, picture, created_at, updated_at) VALUES($id, '$picture', '$now', '$now');";

            $mysqli->query($sql);

            echo ">>> CREATED;";
        } else {
            echo ">>> SKIP;";
        }

        echo "\n\n";
    }

    foreach (glob($dir . '*.jpg') as $filename) {
        $size = getimagesize($filename);
        $width = $size[0];
        $height = $size[1];

        echo "> Start: $filename;\n";

        $picture = explode('data', $filename);
        $picture = 'data' . $picture[1];

        $now = date('Y-m-d H:i:s', time());

        $sql = "SELECT * FROM oc_g4y_gallery_items WHERE g4y_gallery_id = $id AND picture = '$picture'";

        $rs = $mysqli->query($sql);

        if ($rs->num_rows < 1) {
            $sql = "INSERT INTO oc_g4y_gallery_items (g4y_gallery_id, picture, created_at, updated_at) VALUES($id, '$picture', '$now', '$now');";

            $mysqli->query($sql);

            echo ">>> CREATED;";
        } else {
            echo ">>> SKIP;";
        }

        echo "\n\n";
    }

    foreach (glob($dir . '*.jpeg') as $filename) {
        $size = getimagesize($filename);
        $width = $size[0];
        $height = $size[1];

        echo "> Start: $filename;\n";

        $picture = explode('data', $filename);
        $picture = 'data' . $picture[1];

        $now = date('Y-m-d H:i:s', time());

        $sql = "SELECT * FROM oc_g4y_gallery_items WHERE g4y_gallery_id = $id AND picture = '$picture'";

        $rs = $mysqli->query($sql);

        if ($rs->num_rows < 1) {
            $sql = "INSERT INTO oc_g4y_gallery_items (g4y_gallery_id, picture, created_at, updated_at) VALUES($id, '$picture', '$now', '$now');";

            $mysqli->query($sql);

            echo ">>> CREATED;";
        } else {
            echo ">>> SKIP;";
        }

        echo "\n\n";
    }
    exit;
?>
