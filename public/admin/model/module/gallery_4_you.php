<?php
date_default_timezone_set('America/Sao_Paulo');

class Modelmodulegallery4you extends Model {
    public function create_module_tables(){
        $categories = array(
            'name' => 'galleries',
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
                )
            )
        );
        $this->create_table($categories);

        $item = array(
            'name' => 'gallery_items',
            'columns' => array(
                array(
                    'title' => 'g4y_gallery_id',
                    'type' => 'INT',
                    'length' => '11'
                ),
                array(
                    'title' => 'picture',
                    'type' => 'VARCHAR',
                    'length' => '192'
                )
            )
        );
        $this->create_table($item);
    }

    private function create_table($data) {
        $unique_indexes = array();

        $sql = "CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "g4y_" . $data['name'] . " (";
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

        $sql .= ") ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8";

        $this->db->query($sql);
    }

    public function get_entries() {
        $this->load->model('tool/image');
        $entries = array();

        $sql = "SELECT * FROM " . DB_PREFIX . "g4y_galleries;";
        $query = $this->db->query($sql);

        foreach ($query->rows as $result) {
            $gallery_id = $result['id'];

            $entries[$gallery_id] = array(
                'name' => $result['name'],
                'icon' => $result['icon'],
                'icon_preview' => $this->model_tool_image->resize($result['icon'], 100, 100),
                'items' => array()
            );

            $sql = "SELECT * FROM " . DB_PREFIX . "g4y_gallery_items WHERE g4y_gallery_id = " . $this->db->escape($gallery_id);
            $items_query = $this->db->query($sql);
            foreach ($items_query->rows as $item) {
                $item['picture_preview'] = $this->model_tool_image->resize($item['picture'], 100, 100);
                array_push($entries[$gallery_id]['items'], $item);
            }
        }

        return $entries;
    }

    public function create_gallery($data) {
        $now = date('Y-m-d H:i:s', time());
        $sql = "INSERT INTO " . DB_PREFIX . "g4y_galleries (name, icon,created_at, updated_at) VALUES(
                '" . $this->db->escape($data['name']) . "',
                '" . $this->db->escape($data['icon']) . "',
                '" . $now . "',
                '" . $now . "'
            )";

        $this->db->query($sql);
    }

    public function destroy_gallery($gallery_id) {
        $sql_prefix = "DELETE FROM " . DB_PREFIX . "g4y_";
        $sql_suffix = " WHERE g4y_gallery_id = " . $this->db->escape($gallery_id);

        $sql = $sql_prefix . "gallery_items" . $sql_suffix;
        $this->db->query($sql);

        $sql = $sql_prefix . "galleries WHERE id = " . $this->db->escape($gallery_id);
        $this->db->query($sql);
    }

    public function update_gallery($gallery_id, $data) {
        $now = date('Y-m-d H:i:s', time());

        // Saving values for security
        $layouts_backup = array();
        $sql = "SELECT * FROM " . DB_PREFIX . "g4y_gallery_items WHERE g4y_gallery_id = " . $this->db->escape($gallery_id);
        $layouts_backup = $this->db->query($sql);

        // Destroy all entries
        $sql_prefix = "DELETE FROM " . DB_PREFIX . "g4y_";
        $sql_suffix = " WHERE g4y_gallery_id = " . $this->db->escape($gallery_id);
        $sql = $sql_prefix . "gallery_items" . $sql_suffix;
        $this->db->query($sql);

        // Update category info
        $sql = "UPDATE " . DB_PREFIX . "g4y_galleries
                SET name = '" . $this->db->escape($data['name']) . "',
                    icon = '" . $this->db->escape($data['icon']) . "',
                    updated_at = '" . $now . "'
                WHERE id = " . $this->db->escape($gallery_id);
        $this->db->query($sql);

        // Update product info
        foreach ($data['items'] as $item) {
            $sql = "INSERT INTO " . DB_PREFIX . "g4y_gallery_items (g4y_gallery_id, picture, created_at, updated_at) VALUES (
                    " . $this->db->escape($gallery_id) . ",
                    '" . $this->db->escape($item['picture']) . "',
                    '" . $now . "',
                    '" . $now . "')";
            $this->db->query($sql);
        }
    }
}

?>
