<?php

class Controllermodulebuilder4you extends Controller {
    private $error = array();

    public function install() {
        $this->load->model('module/builder_4_you');
        $this->model_module_builder_4_you->create_module_tables();
    }

    public function index() {
        // Instances
        $this->load->language('module/builder_4_you');
        $this->load->model('module/builder_4_you');
        $this->load->model('setting/setting');
        $this->load->model('tool/image');

        // Strings
        $strings = array();
        $text_strings = array(
                'heading_title',
                'text_enabled',
                'text_disabled',
                'text_content_top',
                'text_content_bottom',
                'text_column_left',
                'text_column_right',
                'entry_layout',
                'entry_limit',
                'entry_image',
                'entry_position',
                'entry_status',
                'entry_sort_order',
                'button_save',
                'button_cancel',
                'button_add_module',
                'button_remove',
                'text_image_manager',
                'text_browse',
                'text_clear'
        );

        foreach ($text_strings as $text) {
            $strings[$text] = $this->language->get($text);
            $this->data[$text] = $strings[$text];
        }

        // Save/update info
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            // First update settings
            $submit_type = $this->request->post['submit_type'];

            switch ($submit_type) {
                case 'create_category':
                    $this->model_module_builder_4_you->create_category($this->request->post);
                    break;

                case 'update_category':
                    $post_data = $this->request->post;
                    $post_data['products'] = array();
                    $post_data['layouts'] = array();

                    for ($i = 0; $i < count($post_data['products_name']); $i++) {
                        $product = array(
                            'name' => $post_data['products_name'][$i],
                            'width' => $post_data['products_width'][$i],
                            'height' => $post_data['products_height'][$i],
                            'real_width' => $post_data['products_real_width'][$i],
                            'real_height' => $post_data['products_real_height'][$i],
                            'order' => $post_data['products_order'][$i],
                            'background' => $post_data['products_background'][$i],
                            'overlay' => $post_data['products_overlay'][$i],
                            'mask' => $post_data['products_mask'][$i],
                            'custom_price' => $post_data['custom_price'][$i],
                        );

                        array_push($post_data['products'], $product);
                    }

                    for ($i = 0; $i < count($post_data['layouts_name']); $i++) {
                        $layout = array(
                            'name' => $post_data['layouts_name'][$i],
                            'thumbnail' => $post_data['layouts_thumbnail'][$i],
                            'map' => $post_data['layouts_map'][$i]
                        );
                        array_push($post_data['layouts'], $layout);
                    }

                    $this->model_module_builder_4_you->update_category($this->request->post['category_id'], $post_data);
                    break;

                case 'destroy_category':
                    $this->model_module_builder_4_you->destroy_category($this->request->post['category_id']);
                    break;

                default:
                    break;
            }

            $this->redirect($this->url->link('module/builder_4_you', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $this->data['entries'] = $this->model_module_builder_4_you->get_entries();
        $this->data['action'] = $this->url->link('module/welcome', 'token=' . $this->session->data['token'], 'SSL');
        $this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
        $this->data['token'] = $this->session->data['token'];
        $this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
        $this->data['created_items'] = $this->model_module_builder_4_you->get_custom_products();
        $this->data['newsletters'] = $this->model_module_builder_4_you->get_newsletters();


        // Set page title
        $this->document->setTitle($strings['heading_title']);

        $this->set_breadcrumbs();

        //Choose which template file will be used to display this request.
        $this->template = 'module/builder_4_you.tpl';
        $this->children = array(
            'common/header',
            'common/footer',
        );

        //Send the output.
        $this->response->setOutput($this->render());
    }

    private function set_breadcrumbs() {
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_module'),
            'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('module/builder_4_you', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['action'] = $this->url->link('module/builder_4_you', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
    }

    /*
     *
     * This function is called to ensure that the settings chosen by the admin user are allowed/valid.
     * You can add checks in here of your own.
     *
     */
    private function validate() {
        if (!$this->user->hasPermission('modify', 'module/builder_4_you')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->error) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

?>
