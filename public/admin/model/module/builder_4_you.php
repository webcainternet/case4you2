<?php
date_default_timezone_set('America/Sao_Paulo');

class Modelmodulebuilder4you extends Model {
    public function create_module_tables(){
        $categories = array(
            'name' => 'categories',
            'columns' => array(
                array(
                    'title' => 'name',
                    'type' => 'VARCHAR',
                    'length' => '192',
                    'unique' => true
                ),
                array(
                    'title' => 'icon',
                    'type' => 'VARCHAR',
                    'length' => '192'
                ),
                array(
                    'title' => 'proportion',
                    'type' => 'VARCHAR',
                    'length' => '32'
                ),
                array(
                    'title' => 'price',
                    'type' => 'FLOAT',
                    'length' => '11'
                ),
                array(
                    'title' => 'denomination',
                    'type' => 'VARCHAR',
                    'length' => '192'
                )
            )
        );
        $this->create_table($categories);

        $layouts = array(
            'name' => 'layouts',
            'columns' => array(
                array(
                    'title' => 'b4y_category_id',
                    'type' => 'INT',
                    'length' => '11'
                ),
                array(
                    'title' => 'name',
                    'type' => 'VARCHAR',
                    'length' => '192'
                ),
                array(
                    'title' => 'thumbnail',
                    'type' => 'VARCHAR',
                    'length' => '192'
                ),
                array(
                    'title' => 'map',
                    'type' => 'TEXT'
                )
            )
        );
        $this->create_table($layouts);

        $products = array(
            'name' => 'products',
            'columns' => array(
                array(
                    'title' => 'b4y_category_id',
                    'type' => 'INT',
                    'length' => '11'
                ),
                array(
                    'title' => 'name',
                    'type' => 'VARCHAR',
                    'length' => '192',
                    'unique' => true
                ),
                array(
                    'title' => 'background',
                    'type' => 'VARCHAR',
                    'length' => '192'
                ),
                array(
                    'title' => 'overlay',
                    'type' => 'VARCHAR',
                    'length' => '192'
                ),
                array(
                    'title' => 'mask',
                    'type' => 'VARCHAR',
                    'length' => '192'
                ),
                array(
                    'title' => 'width',
                    'type' => 'INT',
                    'length' => '11'
                ),
                array(
                    'title' => 'height',
                    'type' => 'INT',
                    'length' => '11'
                ),
                array(
                    'title' => 'real_width',
                    'type' => 'INT',
                    'length' => '11'
                ),
                array(
                    'title' => 'real_height',
                    'type' => 'INT',
                    'length' => '11'
                ),
                array(
                    'title' => 'order',
                    'type' => 'INT',
                    'length' => '11'
                )
            )
        );
        $this->create_table($products);

        $custom_products = array(
            'name' => 'custom_products',
            'columns' => array(
                array(
                    'title' => 'b4y_layout_id',
                    'type' => 'INT',
                    'length' => '11'
                ),
                array(
                    'title' => 'b4y_product_id',
                    'type' => 'INT',
                    'length' => '11'
                ),
                array(
                    'title' => 'oc_product_id',
                    'type' => 'INT',
                    'length' => '11'
                ),
                array(
                    'title' => 'map',
                    'type' => 'TEXT'
                )
            )
        );
        $this->create_table($custom_products);
    }

    private function create_table($data) {
        $unique_indexes = array();

        $sql = "CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "b4y_" . $data['name'] . " (";
        $sql .= "id INT(11) NOT NULL AUTO_INCREMENT,";

        foreach ($data['columns'] as $column) {
            $sql .= $column['title'] . " " . $column['type'];

            if (array_key_exists('length', $column)) {
                $sql .= "(" . $column['length'] . ")";
            }

            if (array_key_exists('unique', $column) && $column['unique'] == true) {
                array_push($unique_indexes, $column['title']);
            }

            $sql .= ",";
        }

        $sql .= "created_at DATETIME, updated_at DATETIME,";

        $sql .= "PRIMARY KEY (id)";

        foreach ($unique_indexes as $un) {
            $sql .= ",CONSTRAINT un_cns_" . $un . " UNIQUE (" . $un . ")";
        }

        $sql .= ") ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8";

        $this->db->query($sql);
    }

    public function get_newsletters() {
        $sql = "SELECT * FROM c4y_news;";
        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function get_custom_products() {
        $products = array();

        $sql = "SELECT cp.map as map,
                       p.background as background,
                       p.overlay as overlay,
                       p.mask as mask,
                       cp.created_at as created_at,
                       p.name as name,
                       c.name as category,
                       cp.oc_product_id as oc_product_id
                FROM " . DB_PREFIX . "b4y_custom_products cp
                JOIN " . DB_PREFIX . "b4y_products p ON p.id = cp.b4y_product_id
                JOIN " . DB_PREFIX . "b4y_categories c ON c.id = p.b4y_category_id";
        $query = $this->db->query($sql);

        $salt = '6d50724c486e6c643b5c512f3b30676566502065756778545b72432477';

        if (count($query->rows) > 0) {
            foreach ($query->rows as $product) {
                $token = md5($product['created_at'] . $salt);

                $map = json_decode($product['map'], true);

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
                                    o.telephone as phone,
                                    o.order_id as order_id,
                                    o.order_status_id as order_status_id
                              FROM " . DB_PREFIX . "order_product op
                              JOIN " . DB_PREFIX . "order o ON o.order_id = op.order_id
                              WHERE op.product_id = " . $product['oc_product_id'] . " AND o.order_status_id IN (26) LIMIT 1";
                $order_query = $this->db->query($order_sql);

                if (count($order_query->rows) > 0) {
                    $payer_info = $order_query->rows[0];
                } else {
                    $payer_info = false;
                }

                if ($payer_info) {
                    $map['category'] = $product['category'];
                    $map['name'] = $product['name'];
                    $map['product_id'] = $product['oc_product_id'];
                    $map['background'] = $this->model_tool_image->resize($product['background'], $map['width'], $map['height']);
                    $map['overlay'] = $this->model_tool_image->resize($product['overlay'], $map['width'], $map['height']);
                    $map['mask'] = $this->model_tool_image->resize($product['mask'], $map['width'], $map['height']);
                    $map['token'] = $token;

                    $map['payer'] = $payer_info;

                    array_push($products, $map);
                }
            }
        }

        return $products;
    }

    public function get_entries() {
        $this->load->model('tool/image');
        $entries = array();

        $sql = "SELECT * FROM " . DB_PREFIX . "b4y_categories;";
        $query = $this->db->query($sql);

        foreach ($query->rows as $result) {
            $category_id = $result['id'];

            $entries[$category_id] = array(
                'name' => $result['name'],
                'icon' => $result['icon'],
                'price' => str_replace('.', ',', $result['price']),
                'denomination' => $result['denomination'],
                'proportion' => $result['proportion'],
                'icon_preview' => $this->model_tool_image->resize($result['icon'], 100, 100),
                'products' => array(),
                'layouts' => array()
            );

            $sql = "SELECT * FROM " . DB_PREFIX . "b4y_layouts WHERE b4y_category_id = " . $this->db->escape($category_id);
            $layouts_query = $this->db->query($sql);
            foreach ($layouts_query->rows as $layout) {
                array_push($entries[$category_id]['layouts'], $layout);
            }

            $sql = "SELECT * FROM " . DB_PREFIX . "b4y_products WHERE b4y_category_id = " . $this->db->escape($category_id);
            $products_query = $this->db->query($sql);
            foreach ($products_query->rows as $product) {
                $product['custom_price'] = str_replace('.', ',', $product['custom_price']);
                array_push($entries[$category_id]['products'], $product);
            }
        }

        return $entries;
    }

    public function create_category($data) {
        $data['price'] = str_replace(',', '.', $data['price']);
        $data['price'] = (float) $data['price'];

        $now = date('Y-m-d H:i:s', time());
        $sql = "INSERT INTO " . DB_PREFIX . "b4y_categories (name, icon, proportion, price, denomination, created_at, updated_at) VALUES(
                '" . $this->db->escape($data['name']) . "',
                '" . $this->db->escape($data['icon']) . "',
                '" . $this->db->escape($data['proportion']) . "',
                " . $data['price'] . ",
                '" . $this->db->escape($data['denomination']) . "',
                '" . $now . "',
                '" . $now . "'
            )";

        $this->db->query($sql);
    }

    public function destroy_category($category_id) {
        $sql_prefix = "DELETE FROM " . DB_PREFIX . "b4y_";
        $sql_suffix = " WHERE b4y_category_id = " . $this->db->escape($category_id);

        $sql = $sql_prefix . "products" . $sql_suffix;
        $this->db->query($sql);

        $sql = $sql_prefix . "layouts" . $sql_suffix;
        $this->db->query($sql);

        $sql = $sql_prefix . "categories WHERE id = " . $this->db->escape($category_id);
        $this->db->query($sql);
    }

    public function update_category($category_id, $data) {
        $now = date('Y-m-d H:i:s', time());

        // Saving values for security
        $products_backup = array();
        $layouts_backup = array();
        $sql = "SELECT * FROM " . DB_PREFIX . "b4y_layouts WHERE b4y_category_id = " . $this->db->escape($category_id);
        $layouts_backup = $this->db->query($sql);
        $layouts_ids = array();
        foreach ($layouts_backup->row as $pbkp) {
            $layouts_ids[$pbkp['b4y_category_id'] . $pbkp['name']] = $pbkp['id'];
        }


        $sql = "SELECT * FROM " . DB_PREFIX . "b4y_products WHERE b4y_category_id = " . $this->db->escape($category_id);
        $products_backup = $this->db->query($sql);
        $products_ids = array();

        foreach ($products_backup->row as $pbkp) {
            $products_ids[$pbkp['b4y_category_id'] . $pbkp['name']] = $pbkp['id'];
        }

        // Destroy all entries
        $sql_prefix = "DELETE FROM " . DB_PREFIX . "b4y_";
        $sql_suffix = " WHERE b4y_category_id = " . $this->db->escape($category_id);
        $sql = $sql_prefix . "products" . $sql_suffix;
        $this->db->query($sql);
        $sql = $sql_prefix . "layouts" . $sql_suffix;
        $this->db->query($sql);

        $data['price'] = str_replace(',', '.', $data['price']);
        $data['price'] = (float) $data['price'];

        $this->db->query("ALTER TABLE " . DB_PREFIX . "b4y_products AUTO_INCREMENT = 1");
        $this->db->query("ALTER TABLE " . DB_PREFIX . "b4y_layouts AUTO_INCREMENT = 1");

        // Update category info
        $sql = "UPDATE " . DB_PREFIX . "b4y_categories
                SET name = '" . $this->db->escape($data['name']) . "',
                    icon = '" . $this->db->escape($data['icon']) . "',
                    proportion = '" . $this->db->escape($data['proportion']) . "',
                    price = " . $data['price'] . ",
                    denomination = '" . $this->db->escape($data['denomination']) . "',
                    updated_at = '" . $now . "'
                WHERE id = " . $this->db->escape($category_id);
        $this->db->query($sql);

        // Update product info
        $last_products = array();
        foreach ($data['products'] as $product) {
            $product['custom_price'] = str_replace(',', '.', $product['custom_price']);
            $product['custom_price'] = (float) $product['custom_price'];
            $order = (int) $this->db->escape($product['order']);

            if (array_key_exists($category_id . $product['name'], $products_ids)) {
                $sql = "INSERT INTO " . DB_PREFIX . "b4y_products (id, b4y_category_id, name, background, overlay, mask, width, height, real_width, real_height, `order`,  custom_price, created_at, updated_at) VALUES (" . $products_ids[$category_id . $product['name']] . ", '" . $this->db->escape($category_id) . "', '" . $this->db->escape($product['name']) . "', '" . $this->db->escape($product['background']) . "', '" . $this->db->escape($product['overlay']) . "', '" . $this->db->escape($product['mask']) . "', '" . $this->db->escape($product['width']) . "', '" . $this->db->escape($product['height']) . "', '" . $this->db->escape($product['real_width']) . "', '" . $this->db->escape($product['real_height']) . "', " . $order . ", '" . $this->db->escape($product['custom_price']) . "', '"  .  $now . "', '" . $now . "')";

                $this->db->query($sql);
            } else {
                array_push($last_products, $product);
            }
        }

        // Update product info
        foreach ($last_products as $product) {
            $product['custom_price'] = str_replace(',', '.', $product['custom_price']);
            $product['custom_price'] = (float) $product['custom_price'];

            $product['name'] = (string) $product['name'];
            $product['width'] = (integer) $product['width'];
            $product['height'] = (integer) $product['height'];
            $product['real_width'] = (integer) $product['real_width'];
            $product['real_height'] = (integer) $product['real_height'];
            $product['order'] = (integer) $product['order'];

            $sql = "INSERT INTO " . DB_PREFIX . "b4y_products (b4y_category_id, name, background, overlay, mask, width, height, real_width, real_height, `order`,  custom_price, created_at, updated_at) VALUES ('" . $this->db->escape($category_id) . "', '" . $this->db->escape($product['name']) . "', '" . $this->db->escape($product['background']) . "', '" . $this->db->escape($product['overlay']) . "', '" . $this->db->escape($product['mask']) . "', '" . $this->db->escape($product['width']) . "', '" . $this->db->escape($product['height']) . "', '" . $this->db->escape($product['real_width']) . "', '" . $this->db->escape($product['real_height']) . "', " . $this->db->escape($product['order']) . ", '" . $this->db->escape($product['custom_price']) . "', '"  .  $now . "', '" . $now . "')";

            $this->db->query($sql);
        }

        // Update layouts info
        $last_layouts = array();
        foreach ($data['layouts'] as $layout) {
            if (array_key_exists($category_id . $product['name'], $layouts_ids)) {
                $sql = "INSERT INTO " . DB_PREFIX . "b4y_layouts (id, b4y_category_id, name, thumbnail, map, created_at, updated_at) VALUES (" . $products_ids[$category_id . $layout['name']] . ", " . $this->db->escape($category_id) . ", '" . $this->db->escape($layout['name']) . "', '" . $this->db->escape($layout['thumbnail']) . "', '" . $this->db->escape($layout['map']) . "', '" . $now . "', '" . $now . "')";
                $this->db->query($sql);
            } else {
                array_push($last_layouts, $layout);
            }
        }

        foreach ($last_layouts as $layout) {
            $sql = "INSERT INTO " . DB_PREFIX . "b4y_layouts (b4y_category_id, name, thumbnail, map, created_at, updated_at) VALUES (" . $this->db->escape($category_id) . ", '" . $this->db->escape($layout['name']) . "', '" . $this->db->escape($layout['thumbnail']) . "', '" . $this->db->escape($layout['map']) . "', '" . $now . "', '" . $now . "')";
            $this->db->query($sql);
        }

        $sql = "SELECT id, name FROM " . DB_PREFIX . "b4y_products";
        $products = $this->db->query($sql);
        foreach ($products->rows as $product) {
            $sql = "SELECT product_id FROM oc_order_product WHERE name LIKE '%" . trim($product['name']) . "%' AND `order_id` > 700;";
            $oc_product = $this->db->query($sql);
            foreach ($oc_product->rows as $ocpr) {
                $sql = "UPDATE oc_b4y_custom_products SET b4y_product_id = " . $product['id'] . " WHERE oc_product_id = " . $ocpr['product_id'];
                $this->db->query($sql);
            }
        }

    }


}

?>
