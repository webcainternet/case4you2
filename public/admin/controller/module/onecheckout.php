<?php

class ControllerModuleOneCheckOut extends Controller {

	private $error = array(); 

	public function index() {  

		$this->load->language('module/onecheckout');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('onecheckout', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');

		$this->data['entry_style'] = $this->language->get('entry_style');
		$this->data['text_one_column'] = $this->language->get('text_one_column');
		$this->data['text_two_column'] = $this->language->get('text_two_column');
		$this->data['text_three_column'] = $this->language->get('text_three_column');
		$this->data['entry_check_newsletter'] = $this->language->get('entry_check_newsletter');
		$this->data['entry_check_deliveryaddress'] = $this->language->get('entry_check_deliveryaddress');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['entry_check_register'] = $this->language->get('entry_check_register');
		$this->data['entry_refresh_city'] = $this->language->get('entry_refresh_city');
		$this->data['entry_refresh_postcode'] = $this->language->get('entry_refresh_postcode');
		$this->data['entry_refresh_payment'] = $this->language->get('entry_refresh_payment');
		
		$this->data['button_save'] = $this->language->get('button_save');

		$this->data['button_cancel'] = $this->language->get('button_cancel');
		
		$this->data['token'] = $this->session->data['token'];
		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

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
			'href'      => $this->url->link('module/onecheckout', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		
		if (isset($this->request->post['onecheckout_status'])) {
			$this->data['onecheckout_status'] = $this->request->post['onecheckout_status'];
		} else {
			$this->data['onecheckout_status'] = $this->config->get('onecheckout_status');
		}
		
		if (isset($this->request->post['onecheckout_check_newsletter'])) {
			$this->data['onecheckout_check_newsletter'] = $this->request->post['onecheckout_check_newsletter'];
		} else {
			$this->data['onecheckout_check_newsletter'] = $this->config->get('onecheckout_check_newsletter');
		}
		if (isset($this->request->post['onecheckout_check_deliveryaddress'])) {
			$this->data['onecheckout_check_deliveryaddress'] = $this->request->post['onecheckout_check_deliveryaddress'];
		} else {
			$this->data['onecheckout_check_deliveryaddress'] = $this->config->get('onecheckout_check_deliveryaddress');
		}
		if (isset($this->request->post['onecheckout_style'])) {
			$this->data['onecheckout_style'] = $this->request->post['onecheckout_style'];
		} else {
			$this->data['onecheckout_style'] = $this->config->get('onecheckout_style');
		}
		
		if (isset($this->request->post['onecheckout_check_register'])) {
			$this->data['onecheckout_check_register'] = $this->request->post['onecheckout_check_register'];
		} else {
			$this->data['onecheckout_check_register'] = $this->config->get('onecheckout_check_register');
		}
		
		if (isset($this->request->post['onecheckout_refresh_city'])) {
			$this->data['onecheckout_refresh_city'] = $this->request->post['onecheckout_refresh_city'];
		} else {
			$this->data['onecheckout_refresh_city'] = $this->config->get('onecheckout_refresh_city');
		}
		
		if (isset($this->request->post['onecheckout_refresh_postcode'])) {
			$this->data['onecheckout_refresh_postcode'] = $this->request->post['onecheckout_refresh_postcode'];
		} else {
			$this->data['onecheckout_refresh_postcode'] = $this->config->get('onecheckout_refresh_postcode');
		}
		if (isset($this->request->post['onecheckout_refresh_payment'])) {
			$this->data['onecheckout_refresh_payment'] = $this->request->post['onecheckout_refresh_payment'];
		} else {
			$this->data['onecheckout_refresh_payment'] = $this->config->get('onecheckout_refresh_payment');
		}

		$this->data['action'] = $this->url->link('module/onecheckout', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$this->template = 'module/onecheckout.tpl';

		$this->children = array(
			'common/header',
			'common/footer',
		);	
		$this->response->setOutput($this->render());

	}
	
	private function validate() {

		if (!$this->user->hasPermission('modify', 'module/onecheckout')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
	
	private function writefile($filename, $pattern, $replace, $repeat) {
		
		$real_filename = realpath($filename);		
		$content = $original_content = file_get_contents($real_filename);

		if($content === FALSE) {
			$this->error['warning'] = sprintf($this->language->get('error_notopen'),$filename);
			return;
		}
		
		if($repeat){
			$content = str_replace('// OneCheckOut' , '', $content);//preg_replace
		
			if($content !== $original_content){
				return;
			}
		}
			
		$content = str_replace($pattern, $replace, $content);//preg_replace
				
		if($content === NULL) {
			$this->error['warning'] = sprintf($this->language->get('error_regex'),$pattern);
			return;
		}
				
		if($content !== $original_content) {
				
			if(!is_writeable($real_filename)) {
				$this->error['warning'] = sprintf($this->language->get('error_notwrite'),$filename);
				return;
			} else {					
				$result = file_put_contents($real_filename, $content);
				if($result) {
					return;
				} else {
					$this->error['warning'] = sprintf($this->language->get('error_writefail'),$filename);
					return;
				}
			}
		}
	}
	
	public function getlayoutid(){
		$this->load->model('design/layout');
		$layouts = $this->model_design_layout->getLayouts();
		foreach($layouts as $layout){
			if($layout['name']=='OneCheckOut'){
				return $layout['layout_id'];
			}
		}
		
		return false;
	}
	
	public function install(){
		$layoutid = $this->getlayoutid();
		if(!$layoutid){
			$layoutdata = array();
			$layoutdata['name'] = 'OneCheckOut';
			$layoutdata['layout_route'][1] = array(
				'store_id'	=> '0',
				'route'		=> 'onecheckout/'
			);
			$this->load->model('design/layout');
			$this->model_design_layout->addLayout($layoutdata);
		}
		
		$this->writefile('../index.php', '// SEO URL\'s', '// OneCheckOut
$controller->addPreAction(new Action(\'onecheckout/checkout/ini\'));

// SEO URL\'s', 1);
		$this->writefile('../catalog/controller/account/logout.php', 'unset($this->session->data[\'coupon\']);', 'unset($this->session->data[\'coupon\']);
			// OneCheckOut fix tax.php bug
			unset($this->session->data[\'guest\']);', 1);
	}
	
	public function uninstall(){		
		$layoutid = $this->getlayoutid();
		if($layoutid){
			$this->load->model('design/layout');
			$this->model_design_layout->deleteLayout($layoutid);
		}
		
		$this->writefile('../index.php', '// OneCheckOut
$controller->addPreAction(new Action(\'onecheckout/checkout/ini\'));

// SEO URL\'s', '// SEO URL\'s', 0);
	}

}

?>