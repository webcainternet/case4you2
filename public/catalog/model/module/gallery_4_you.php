<?php
date_default_timezone_set('America/Sao_Paulo');

class Modelmodulegallery4you extends Model {
    public function get_entries() {
        if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
            $base_url = $this->config->get('config_ssl');
        } else {
            $base_url = $this->config->get('config_url');
        }

        $this->load->model('tool/image');
        $entries = array();

        $sql = "SELECT * FROM " . DB_PREFIX . "g4y_galleries;";
        $query = $this->db->query($sql);

        foreach ($query->rows as $result) {
            $gallery_id = $result['id'];

            $entries[$gallery_id] = array(
                'title' => $result['name'],
                'icon' => $base_url . 'image/' . $result['icon'],
                'thumbnail' => $this->model_tool_image->resize($result['icon'], 100, 100),
                'pictures' => array()
            );

            $sql = "SELECT * FROM " . DB_PREFIX . "g4y_gallery_items WHERE g4y_gallery_id = " . $this->db->escape($gallery_id);
            $items_query = $this->db->query($sql);
            foreach ($items_query->rows as $item) {
                $item['thumbnail'] = $this->model_tool_image->resize($item['picture'], 100, 100);
                $item['original'] = $base_url . 'image/' . $item['picture'];
                array_push($entries[$gallery_id]['pictures'], $item);
            }
        }

        return $entries;
    }
}

?>
