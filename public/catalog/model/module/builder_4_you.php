<?php
date_default_timezone_set('America/Sao_Paulo');

class Modelmodulebuilder4you extends Model {
    public function record_newsletter($email) {
        $sql = "INSERT INTO c4y_news (email) VALUE('" . $this->db->escape($email) . "')";
        $this->db->query($sql);

        return true;
    }

    public function get_entries() {
        if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
            $base_url = $this->config->get('config_ssl');
        } else {
            $base_url = $this->config->get('config_url');
        }

        $this->load->model('tool/image');
        $entries = array();

        $sql = "SELECT * FROM " . DB_PREFIX . "b4y_categories;";
        $query = $this->db->query($sql);

        foreach ($query->rows as $result) {
            $category_id = $result['id'];

            $price = number_format($result['price'], 2);

            $entries[$category_id] = array(
                'name' => $result['name'],
                'icon' => $result['icon'],
                'proportion' => $result['proportion'],
                'price' => str_replace('.', ',', $price),
                'denomination' => $result['denomination'],
                'proportion' => $result['proportion'],
                'icon_preview' => $this->model_tool_image->resize($result['icon'], 60, 60),
                'products' => array(),
                'layouts' => array()
            );

            $sql = "SELECT * FROM " . DB_PREFIX . "b4y_layouts WHERE b4y_category_id = " . $this->db->escape($category_id);
            $layouts_query = $this->db->query($sql);
            foreach ($layouts_query->rows as $layout) {
                $layout['map'] = str_replace('&quot;', '\\"', $layout['map']);
                $layout['layoutmap'] = $layout['map'];

                $layout['thumbnail'] = $base_url . 'image/' . $layout['thumbnail'];
                array_push($entries[$category_id]['layouts'], $layout);
            }

            $sql = "SELECT * FROM " . DB_PREFIX . "b4y_products WHERE b4y_category_id = " . $this->db->escape($category_id) . " ORDER BY `order` DESC";
            $products_query = $this->db->query($sql);
            foreach ($products_query->rows as $product) {
                $product['background'] = $this->model_tool_image->resize($product['background'], $product['width'], $product['height']);
                $product['overlay'] = $this->model_tool_image->resize($product['overlay'], $product['width'], $product['height']);
                $product['mask'] = $this->model_tool_image->resize($product['mask'], $product['width'], $product['height']);

                array_push($entries[$category_id]['products'], $product);
            }
        }

        return $entries;
    }

    public function get_custom_product($id, $token) {
        $this->load->model('tool/image');

        $id = trim($id);
        $id = strip_tags($id);
        $id = $this->db->escape($id);
        $id = (int) $id;

        $salt = '6d50724c486e6c643b5c512f3b30676566502065756778545b72432477';

        $sql = "SELECT cp.map as map,
                       p.background as background,
                       p.overlay as overlay,
                       p.mask as mask,
                       cp.created_at as created_at,
                       p.name as name,
                       c.name as category
                FROM " . DB_PREFIX . "b4y_custom_products cp
                JOIN " . DB_PREFIX . "b4y_products p ON p.id = cp.b4y_product_id
                JOIN " . DB_PREFIX . "b4y_categories c ON c.id = p.b4y_category_id
                WHERE cp.oc_product_id = $id";
        $query = $this->db->query($sql);

        if (count($query->rows) > 0) {
            $rs = $query->rows[0];

            $check = md5($rs['created_at'] . $salt);

            if ($check == $token) {
                $map = json_decode($rs['map'], true);

                $order_sql = "SELECT o.payment_firstname as first_name,
                                    o.payment_lastname as lastname,
                                    o.shipping_address_1 as address,
                                    o.shipping_address_2 as neighbordhood,
                                    o.shipping_city as city,
                                    o.shipping_postcode as zip_code,
                                    o.shipping_zone as state,
                                    o.shipping_method as shipping_method,
                                    o.firstname as payer_firstname,
                                    o.lastname as payer_lastname,
                                    o.email as email,
                                    o.telephone as phone
                              FROM " . DB_PREFIX . "order_product op
                              JOIN " . DB_PREFIX . "order o ON o.order_id = op.order_id
                              WHERE op.product_id = $id LIMIT 1";
                $query = $this->db->query($order_sql);
                if (count($query->rows) > 0) {
                    $payer_info = $query->rows[0];
                } else {
                    $payer_info = false;
                }

                $map['category'] = $rs['category'];
                $map['name'] = $rs['name'];
                $map['background'] = $this->model_tool_image->resize($rs['background'], $map['width'], $map['height']);
                $map['overlay'] = $this->model_tool_image->resize($rs['overlay'], $map['width'], $map['height']);
                $map['mask'] = $this->model_tool_image->resize($rs['mask'], $map['width'], $map['height']);

                $map['payer'] = $payer_info;

                $map['components'] = str_replace('&amp;', '&', $map['components']);

                return $map;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function create_product($session, $desc, $image, $type, $data) {
        $result = false;

        $sql = "SELECT price FROM " . DB_PREFIX . "b4y_categories WHERE name = '". $this->db->escape($type) ."' ORDER BY price DESC LIMIT 1;";
        $prices = $this->db->query($sql);

        $sql = "SELECT custom_price FROM " . DB_PREFIX . "b4y_products WHERE id = '". $this->db->escape($data['product_id']) ."' ORDER BY custom_price DESC LIMIT 1;";
        $custom_prices = $this->db->query($sql);

        $sql = "SELECT product_id FROM " . DB_PREFIX . "product ORDER BY product_id DESC LIMIT 1;";

        $ids = $this->db->query($sql);

        if ($ids && $prices) {
            $product_id = $ids->rows[0]['product_id'] + 1;

            if ($custom_prices) {
                $prices = $custom_prices->rows[0]['custom_price'];
            } else {
                $prices = $prices->rows[0]['price'];
            }

            $model = "'Customizada'";
            $sku = "''";
            $upc = "''";
            $ean = "''";
            $jan = "''";
            $isbn = "''";
            $mpn = "'idcsession=$session&m=0&l=0&f=0'";
            $location = "''";
            $quantity = 10000;
            $stock_status_id = 5;
            $image = explode('data', $image);
            $image = 'data' . $image[1];
            $image = "'$image'";
            $image = preg_replace('/-([0-9]{3,4})x([0-9]{3,4})\.png/i', '.png', $image);
            $manufacturer_id = 0;
            $manufacturer_id = 1;
            $shipping = 1;
            $price = $prices;
            $points = 0;
            $tax_class_id = 0;
            $date_available = "2013-11-01";
            $weight = "0.12000000";
            $weight_class_id = "1";
            $length = "24.00000000";
            $width = "16.00000000";
            $height = "8.00000000";
            $length_class_id = 1;
            $subtract = 1;
            $minimum = 1;
            $sort_order = 1;
            $status = 1;
            $date_added = "'2013-11-01 00:00:00'";
            $date_modified = "'2013-11-01 00:00:00'";
            $viewed = 1;

            $sql = "INSERT INTO " . DB_PREFIX . "product
                        (product_id, model, sku, upc, ean, jan, isbn, mpn, location, quantity, stock_status_id, image, manufacturer_id, shipping, price, points, tax_class_id, date_available, weight, weight_class_id, length, width, height, length_class_id, subtract, minimum, sort_order, status, date_added, date_modified, viewed)
                    VALUES
                        ($product_id, $model, $sku, $upc, $ean, $jan, $isbn, $mpn, $location, $quantity, $stock_status_id, $image, $manufacturer_id, $shipping, $price, $points, $tax_class_id, $date_available, $weight, $weight_class_id, $length, $width, $height, $length_class_id, $subtract, $minimum, $sort_order, $status, $date_added, $date_modified, $viewed)";

            $query = $this->db->query($sql);

            if ($query) {
                $language_id = 2;
                $name = $this->db->escape($desc);
                $name = "'$name'";
                $desc = "'A capinha com a sua cara!'";
                $meta_description = "''";
                $meta_keyword = "''";
                $tag = "''";

                $sql = "INSERT INTO " . DB_PREFIX . "product_description (product_id, language_id, name, description, meta_description, meta_keyword, tag) VALUES ($product_id, $language_id, $name, $desc, $meta_description, $meta_keyword, $tag)";

                $query = $this->db->query($sql);

                if ($query) {
                    $store_id = "'0'";
                    $layout_id = "'13'";

                    $sql = "INSERT INTO " . DB_PREFIX . "product_to_layout (product_id, store_id, layout_id) VALUES ($product_id, $store_id, $layout_id)";
                    $query = $this->db->query($sql);

                    if ($query) {
                        $sql = "INSERT INTO " . DB_PREFIX . "product_to_store (product_id, store_id) VALUES ($product_id, $store_id)";
                        $query = $this->db->query($sql);

                        $sql = "INSERT INTO " . DB_PREFIX . "product_image (product_id, image) VALUES ($product_id, $image)";
                        $query = $this->db->query($sql);

                        $filter = explode('_', $data['image']);
                        $filter = explode('.', $filter[1]);
                        $filter = explode('-', $filter[0]);
                        $filter = $filter[0];

                        $map = array(
                            'width' => $data['c_width'],
                            'height' => $data['c_height'],
                            'filter' => $filter,
                            'components' => array()
                        );

                        $i = 0;
                        foreach ($data['cm_top'] as $top) {
                            $component = array(
                                'container' => array(
                                    'top' => (int) $this->db->escape($data['cm_top'][$i]),
                                    'left' => (int) $this->db->escape($data['cm_left'][$i]),
                                    'width' => (int) $this->db->escape($data['cm_width'][$i]),
                                    'height' => (int) $this->db->escape($data['cm_height'][$i])
                                ),
                                'image' => array(
                                    'top' => (int) $this->db->escape($data['cmi_top'][$i]),
                                    'left' => (int) $this->db->escape($data['cmi_left'][$i]),
                                    'width' => (int) $this->db->escape($data['cmi_width'][$i]),
                                    'height' => (int) $this->db->escape($data['cmi_height'][$i]),
                                    'rotate' => (float) $this->db->escape($data['cmi_rotate'][$i]),
                                    'src' => $this->db->escape($data['cmi_src'][$i])
                                )
                            );

                            array_push($map['components'], $component);

                            $i++;
                        }

                        $b4y_layout_id = (int) $data['layout_id'];
                        $b4y_product_id = (int) $data['product_id'];
                        $oc_product_id = $product_id;
                        $map = json_encode($map);



                        $now = date('Y-m-d H:i:s', time());
                        $salt = '6d50724c486e6c643b5c512f3b30676566502065756778545b72432477';
                        $token = md5($now . $salt);
                        $sql = "INSERT INTO " . DB_PREFIX . "b4y_custom_products (b4y_layout_id, b4y_product_id, oc_product_id, map, created_at, updated_at) VALUES($b4y_layout_id, $b4y_product_id, $oc_product_id, '$map', '$now', '$now');";
                        $query = $this->db->query($sql);

                        $result = $product_id;
                    }
                }
            }
        }

        return $result;
    }
}
?>
