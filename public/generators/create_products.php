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

    $dir = DIR_IMAGE . 'data/builder4you/assets/capinhas/modelos/';

    $product_order = array(
        "iPhone 4/ 4S",
        "iPhone 5/ 5S",
        "iPhone 5C",
        "Galaxy S2",
        "Galaxy S3",
        "Galaxy S3 Mini",
        "Galaxy S3 Duos",
        "Galaxy S4",
        "Galaxy S4 Mini",
        "Galaxy S5",
        "Galaxy Note 2",
        "Galaxy Note 3",
        "Galaxy Grand Duos",
        "Galaxy S Duos",
        "Galaxy Ace",
        "Galaxy Ace 2",
        "Galaxy Ace 3/ Duos",
        "Galaxy Ace Duos",
        "Galaxy Pocket/ Duos",
        "Galaxy Pocket Neo/ Duos",
        "Galaxy Win/ Duos",
        "Galaxy Trend",
        "Galaxy Trend Lite/ Duos",
        "Galaxy Y/ Duos",
        "Galaxy Fame/ Duos",
        "Galaxy Express GT",
        "LG Nexus 4",
        "LG Nexus 5",
        "LG L3",
        "LG L5/ L5 Dual",
        "LG L7",
        "LG L9",
        "LG G Pro",
        "Motorola Razr D3",
        "Motorola Moto G",
        "Motorola Moto X",
        "Nokia N520",
        "Nokia N620",
        "Nokia N625",
        "Nokia N720",
        "Nokia N820",
        "Nokia N920",
        "Nokia N925",
        "Nokia N1020",
        "Sony Xperia C",
        "Sony Xperia E/ E Dual",
        "Sony Xperia U",
        "Sony Xperia J",
        "Sony Xperia L",
        "Sony Xperia M/ M Dual",
        "Sony Xperia S",
        "Sony Xperia SP",
        "Sony Xperia ZQ",
        "Sony Xperia Z1",
        "Sony Xperia Z2",
        "Sony Xperia Z Ultra"
    );

    function calculate_item_order($porder, $item) {
        $max = 90;

        if (in_array($item, $porder)) {
            for ($i = 0; $i < count($porder); $i++) {
                if ($porder[$i] == $item) {
                    $factor = $i;
                }
            }
        } else {
            $factor = $max;
        }

        return $max - $factor;
    }

    foreach (glob($dir . '*.png') as $filename) {
        $oldname = $filename;

        $path = explode('/', $filename);
        $name = end($path);
        array_pop($path);

        $name = strtolower($name);
        $name = str_replace(' ', '_', $name);
        $name = str_replace('-', '_', $name);
        $name = str_replace('componentes', 'overlay', $name);
        $name = str_replace('mascara', 'overlay', $name);
        array_push($path, $name);

        $filename = implode('/', $path);

        rename($oldname, $filename);
    }

    foreach (glob($dir . '*.png') as $filename) {
        if (!strpos($filename, 'mask') && !strpos($filename, 'overlay')) {
            $size = getimagesize($filename);
            $width = $size[0];
            $height = $size[1];

            $name = explode('/', $filename);
            $name = end($name);
            $name = str_replace('.png', '', $name);
            $name = str_replace('__b__', '/ ', $name);
            $name = str_replace('_', ' ', $name);
            $name = ucwords($name);

            $name = str_replace('Lg ', 'LG ', $name);
            $name = str_replace('Iphone', 'iPhone', $name);
            $name = str_replace('/duos', '/Duos', $name);
            $name = str_replace('/e', '/E', $name);
            $name = str_replace('/m', '/M', $name);
            $name = str_replace(' Gt', ' GT', $name);
            $name = str_replace(' Sp', ' SP', $name);
            $name = str_replace(' Zq', ' ZQ', $name);
            $name = str_replace('4s', '4S', $name);
            $name = str_replace('5s', '5S', $name);
            $name = str_replace('5c', '5C', $name);

            echo "> Start: $name;\n";

            $background = explode('data', $filename);
            $background = 'data' . $background[1];

            $mask = str_replace('.png', '_mask.png', $background);
            $overlay = str_replace('.png', '_overlay.png', $background);

            $now = date('Y-m-d H:i:s', time());

            $sql = "SELECT * FROM oc_b4y_products WHERE name = '$name'";

            $rs = $mysqli->query($sql);

            $order_int = calculate_item_order($product_order, $name);

            if ($rs->num_rows < 1) {
                $sql = "INSERT INTO oc_b4y_products (b4y_category_id, name, background, overlay, mask, width, height, real_width, real_height, `order`, created_at, updated_at) VALUES(7, '$name', '$background', '$overlay', '$mask', $width, $height, $width, $height, $order_int, '$now', '$now');";

                $mysqli->query($sql);

                echo ">>> CREATED;";
            } else {
                echo ">>> SKIP;";
            }

            echo "\n\n";
        }
    }
    exit;
?>
