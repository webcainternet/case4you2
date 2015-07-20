<?php
class ControllerModuleAbandonedcarts1Day extends Controller {
	private $error = array();

	public function index() {
		$this->language->load('module/abandonedcarts_1day');

		$this->load->model('setting/setting');
		$this->load->model('module/abandonedcarts_1day');
		$this->load->model('setting/store');
		$this->load->model('localisation/language');
		$this->load->model('design/layout');

		$this->document->setTitle($this->language->get('heading_title'));

		$catalogURL = $this->getCatalogURL();

		$this->document->addScript('view/javascript/ckeditor/ckeditor.js');
		$this->document->addScript('view/javascript/abandonedcarts/bootstrap/js/bootstrap.min.js');
		$this->document->addStyle('view/javascript/abandonedcarts/bootstrap/css/bootstrap.min.css');
		$this->document->addStyle('view/javascript/abandonedcarts/font-awesome/css/font-awesome.min.css');
		$this->document->addStyle('view/stylesheet/abandonedcarts.css');

		$this->document->addStyle($catalogURL.'catalog/view/javascript/jquery/colorbox/colorbox.css');
		$this->document->addScript($catalogURL.'catalog/view/javascript/jquery/colorbox/jquery.colorbox-min.js');
		$this->document->addScript('view/javascript/abandonedcarts/cron.js');
		$this->document->addScript('view/javascript/abandonedcarts/timepicker.js');

		if(!isset($this->request->get['store_id'])) {
           $this->request->get['store_id'] = 0;
        }

		$store = $this->getCurrentStore($this->request->get['store_id']);

		// check for the multi-store variable
		$check_update = $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "abandonedcarts_1day` LIKE 'store_id'");
		if (!$check_update->rows)
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "abandonedcarts_1day`
  						ADD `store_id` TINYINT NOT NULL DEFAULT 0");
		// check for the multi-store variable

		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			if (!$this->user->hasPermission('modify', 'module/abandonedcarts_1day')) {
				$this->validate();
				$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
			}
			if (!empty($_POST['OaXRyb1BhY2sgLSBDb21'])) {
				$this->request->post['AbandonedCarts']['LicensedOn'] = $_POST['OaXRyb1BhY2sgLSBDb21'];
			}
			if (!empty($_POST['cHRpbWl6YXRpb24ef4fe'])) {
				$this->request->post['AbandonedCarts']['License'] = json_decode(base64_decode($_POST['cHRpbWl6YXRpb24ef4fe']),true);
			}
			$store = $this->getCurrentStore($this->request->post['store_id']);

			$this->model_module_abandonedcarts_1day->editSetting('AbandonedCarts1Day', $this->request->post, $this->request->post['store_id']);
			$this->session->data['success'] = $this->language->get('text_success');

			if (!empty($_GET['activate'])) {
				$this->session->data['success'] = $this->language->get('text_success_activation');
			}

			if ($this->request->post['AbandonedCarts']["ScheduleEnabled"] == 'yes') {
                $this->editCron($this->request->post, $store['store_id']);
            }

			$selectedTab = (empty($this->request->post['selectedTab'])) ? 0 : $this->request->post['selectedTab'];
			$this->redirect($this->url->link('module/abandonedcarts_1day', 'token=' . $this->session->data['token'] . '&tab='.$selectedTab .'&store_id='.$store['store_id'], 'SSL'));
		}

		$languageVariables = array(
			'heading_title',
			'text_enabled',
			'text_disabled',
			'text_default',
			'entry_code',
			'button_save',
			'button_cancel',
			'button_add_module',
			'button_remove'
			);



		foreach ($languageVariables as $languageVariable) {
			$this->data[$languageVariable] = $this->language->get($languageVariable);
		}

		$this->data['currency'] = $this->config->get('config_currency');
		$this->data['stores'] = array_merge(array(0 => array('store_id' => '0', 'name' => $this->config->get('config_name') . ' (' . $this->data['text_default'].')', 'url' => HTTP_SERVER, 'ssl' => HTTPS_SERVER)), $this->model_setting_store->getStores());

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
			'href'      => $this->url->link('module/abandonedcarts_1day', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

		if (isset($this->error['code'])) {
			$this->data['error_code'] = $this->error['code'];
		} else {
			$this->data['error_code'] = '';
		}
		$this->data['error_warning'] = '';
		$languages = $this->model_localisation_language->getLanguages();;
		$this->data['languages'] = $languages;
		$firstLanguage = array_shift($languages);
		$this->data['firstLanguageCode'] = $firstLanguage['code'];
		$this->data['store']			   = $store;
		$this->data['action']			  = $this->url->link('module/abandonedcarts_1day', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel']			  = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['data']				= $this->model_module_abandonedcarts_1day->getSetting('AbandonedCarts1Day',$store['store_id']);
		$this->data['currenttemplate']	 = $this->config->get('config_template');

		$this->data['layouts']			 = $this->model_design_layout->getLayouts();
		$this->template					= 'module/abandonedcarts_1day.tpl';
		$this->children					= array('common/header', 'common/footer');

		$this->response->setOutput($this->render());
	}

	private function editCron($data=array(), $store_id) {
        $cronCommands   = array();
        $cronFolder     = dirname(DIR_APPLICATION) . '/vendors/abandonedcarts_1day/';
        $dateForSorting = array();
        if (isset($data['AbandonedCarts']["ScheduleType"]) && $data['AbandonedCarts']["ScheduleType"] == 'F') {
            if (isset($data['AbandonedCarts']["FixedDates"])) {
                foreach ($data['AbandonedCarts']["FixedDates"] as $date) {
                    $buffer           = explode('/', $date);
                    $bufferDate       = explode('.', $buffer[0]);
                    $bufferTime       = explode(':', $buffer[1]);
                    $cronCommands[]   = (int) $bufferTime[1] . ' ' . (int) $bufferTime[0] . ' ' . (int) $bufferDate[0] . ' ' . (int) $bufferDate[1] . ' * php ' . $cronFolder . 'sendReminder.php ' . $store_id;
                    $dateForSorting[] = $bufferDate[2] . '.' . $bufferDate[1] . '.' . $bufferDate[0] . '.' . $buffer[1];
                }
                asort($dateForSorting);
                $sortedDates = array();
                foreach ($dateForSorting as $date) {
                    $newDate       = explode('.', $date);
                    $sortedDates[] = $newDate[2] . '.' . $newDate[1] . '.' . $newDate[0] . '/' . $newDate[3];
                }
                $data = $sortedDates;
            }
        }
        if (isset($data['AbandonedCarts']["ScheduleType"]) && $data['AbandonedCarts']["ScheduleType"] == 'P') {
            $cronCommands[] = $data['AbandonedCarts']['PeriodicCronValue'] . ' php ' . $cronFolder . 'sendReminder.php ' . $store_id;
        }
        if (isset($cronCommands)) {
            $cronCommands      = implode(PHP_EOL, $cronCommands);
            $currentCronBackup = shell_exec('crontab -l');
            $currentCronBackup = explode(PHP_EOL, $currentCronBackup);
            foreach ($currentCronBackup as $key => $command) {
                if (strpos($command, 'php ' . $cronFolder . 'sendReminder.php ' . $store_id) || empty($command)) {
                    unset($currentCronBackup[$key]);
                }
            }
            $currentCronBackup = implode(PHP_EOL, $currentCronBackup);
            file_put_contents($cronFolder . 'cron.txt', $currentCronBackup . PHP_EOL . $cronCommands . PHP_EOL);
            exec('crontab -r');
            exec('crontab ' . $cronFolder . 'cron.txt');
        }
    }

	private function getCatalogURL(){
        if (isset($_SERVER['HTTPS']) && (($_SERVER['HTTPS'] == 'on') || ($_SERVER['HTTPS'] == '1'))) {
            $storeURL = HTTPS_CATALOG;
        } else {
            $storeURL = HTTP_CATALOG;
        }
        return $storeURL;
    }

	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/abandonedcarts_1day')) {
			$this->error = true;
		}
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	public function install() {
		$this->load->model('module/abandonedcarts_1day');
		$this->load->model('setting/store');
		$this->model_module_abandonedcarts_1day->install();
		/* new data */
		$stores = $this->model_setting_store->getStores();
			foreach ($stores as $store) {
				$data = $this->model_module_abandonedcarts_1day->getSetting('AbandonedCarts1Day', $store['store_id']);
				$data['AbandonedCarts']['Updated'] = 'yes';
				$this->model_module_abandonedcarts_1day->editSetting('AbandonedCarts1Day', $data, $store['store_id']);
			}
			$data = $this->model_module_abandonedcarts_1day->getSetting('AbandonedCarts1Day', '0');
			$data['AbandonedCarts']['Updated'] = 'yes';
			$this->model_module_abandonedcarts_1day->editSetting('AbandonedCarts1Day', $data, '0');
		/* new data */
	}

	public function upgrade() {
		$this->load->model('setting/setting');
		$this->load->model('setting/store');
		$this->load->model('module/abandonedcarts_1day');
		$upgrade = $this->model_module_abandonedcarts_1day->upgrade();
		if ($upgrade) {
			$stores = $this->model_setting_store->getStores();
			foreach ($stores as $store) {
				$data = $this->model_module_abandonedcarts_1day->getSetting('AbandonedCarts1Day', $store['store_id']);
				$data['AbandonedCarts']['Updated'] = 'yes';
				$this->model_module_abandonedcarts_1day->editSetting('AbandonedCarts1Day', $data, $store['store_id']);
			}
			$data = $this->model_module_abandonedcarts_1day->getSetting('AbandonedCarts1Day', '0');
			$data['AbandonedCarts']['Updated'] = 'yes';
			$this->model_module_abandonedcarts_1day->editSetting('AbandonedCarts1Day', $data, '0');
			$json = true;
		} else {
			$json = false;
		}

		$this->response->setOutput(json_encode($json));
	}

	public function uninstall() {
		$this->load->model('setting/setting');

		$this->load->model('setting/store');
		$this->model_setting_setting->deleteSetting('AbandonedCarts1Day',0);
		$stores = $this->model_setting_store->getStores();
		foreach ($stores as $store) {
			$this->model_setting_setting->deleteSetting('AbandonedCarts1Day', $store['store_id']);
		}

        $this->load->model('module/abandonedcarts_1day');
        $this->model_module_abandonedcarts_1day->uninstall();
	}

	public function getabandonedcarts() {
        if (!empty($this->request->get['page'])) {
            $page = (int) $this->request->get['page'];
        }

		if(!isset($this->request->get['store_id'])) {
           $this->request->get['store_id'] = 0;
        }

        $this->load->model('module/abandonedcarts_1day');
        $pagination               = new Pagination();
        $pagination->num_links    = 2;
        $pagination->total        = $this->model_module_abandonedcarts_1day->getTotalAbandonedCarts($this->request->get['store_id']);
        $pagination->page         = $page;
        $pagination->limit        = 8;
        $pagination->text         = $this->language->get('text_pagination');
        $pagination->url          = $this->url->link('module/abandonedcarts_1day/getabandonedcarts','token=' . $this->session->data['token'].'&page={page}&store_id='.$this->request->get['store_id'], 'SSL');
        $this->data['sources']    = $this->model_module_abandonedcarts_1day->viewAbandonedCarts($page, $pagination->limit, $this->request->get['store_id']);
        $this->data['limit']      = $pagination->limit;
        $this->template           = 'module/abandonedcarts_1day/view_abandonedcarts.tpl';
        $this->data['pagination'] = $pagination->render();
        $this->response->setOutput($this->render());
    }

	public function removeabandonedcart() {

		if (isset($_POST['cart_id'])) {
				$run_query = $this->db->query("DELETE FROM `" . DB_PREFIX . "abandonedcarts_1day` WHERE `id`=".(int)$_POST['cart_id']);
			
				if ($run_query) echo "Success!";
		}
	}

	public function sendreminder() {
		$this->document->addScript('view/javascript/ckeditor/ckeditor.js');
		$this->load->model('module/abandonedcarts_1day');
		$this->load->model('design/layout');
		$this->load->model('localisation/language');

		$languages						 = $this->model_localisation_language->getLanguages();
		$this->data['languages']		   = $languages;
		$firstLanguage					 = array_shift($languages);
		$this->data['firstLanguageCode']   = $firstLanguage['code'];
		$this->data['data']				= $this->model_module_abandonedcarts_1day->getSetting('AbandonedCarts1Day', $this->request->get['store_id']);
		$this->data['id']				  = $_GET['id'];
		$this->data['currency']			= $this->config->get('config_currency');
		$this->data['result']			  = $this->model_module_abandonedcarts_1day->getCartInfo($this->data['id']);
		$this->data['currenttemplate']	 = $this->config->get('config_template');
		$this->data['layouts']			 = $this->model_design_layout->getLayouts();
        $this->template					= 'module/abandonedcarts_1day/send_reminder.tpl';

		$this->response->setOutput($this->render());
	}

	public function generateuniquerandomcouponcode() {
		$this->load->model('module/abandonedcarts_1day');
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$couponCode = '';
		for ($i = 0; $i < 10; $i++) {
			$couponCode .= $characters[rand(0, strlen($characters) - 1)];
		}
		if($this->model_module_abandonedcarts_1day->isUniqueCode($couponCode)) {
			return $couponCode;
		} else {
			return $this->generateuniquerandomcouponcode();
		}
	}

	public function sendcustomemail() {
		if (isset($_POST) && isset($_POST['ABcart_id'])) {
			$this->load->model('module/abandonedcarts_1day');
			$this->load->model('sale/coupon');
			$this->load->model('tool/image');
			$this->load->model('module/abandonedcarts_1day');
			$this->load->model('setting/store');
			$this->language->load('module/abandonedcarts_1day');

			$result					 = $this->model_module_abandonedcarts_1day->getCartInfo($_POST['ABcart_id']);
			$this->request->get['store_id'] = $result['store_id'];
			$setting					= $this->model_module_abandonedcarts_1day->getSetting('AbandonedCarts1Day', $this->request->get['store_id']);
			$result['customer_info']	= json_decode($result['customer_info'], true);
			$Message					= html_entity_decode($_POST['CustomMessage']);
			$width					  = $_POST['ProductWidth'];
			$height					 = $_POST['ProductHeight'];
			$result['cart']			 = json_decode($result['cart'], true);
			$catalog_link			   = "";
			$store_data				 = $this->getCurrentStore($this->request->get['store_id']);
			$catalog_link			   = $store_data['url'];

			$CartProducts = '<table style="width:100%">';
			$CartProducts .= '<tr>
								  <td class="left" width="70%"><strong>'.$this->language->get('text_product').'</strong></td>
								  <td class="left" width="15%"><strong>'.$this->language->get('text_qty').'</strong></td>
								  <td class="left" width="15%"><strong>'.$this->language->get('text_price').'</strong></td>
								</tr>';
			foreach ($result['cart'] as $product) {
				if ($product['image']) {
					$image_thumb = $this->model_tool_image->resize($product['image'], $width, $height);
				} else {
					$image = false;
				}
				$CartProducts .='<tr>';
				$CartProducts .='<td><div style="float:left;padding-right:3px;"><a href="'.$catalog_link.'index.php?route=product/product&product_id='. $product['product_id'].'" target="_blank"><img src="'.$image_thumb.'" /></a></div> <a href="'.$catalog_link.'index.php?route=product/product&product_id='. $product['product_id'].'" target="_blank">'.$product['name'].'</a><br />';
				foreach ($product['option'] as $option) {
                       $CartProducts .= '- <small>'.$option['name'].' '.$option['option_value'].'</small><br />';
                }
                $CartProducts .= '</td>
                          <td>x&nbsp;'.$product['quantity'].'</td>
						  <td>'.($this->currency->format($product['price'])).'</td>
                        </tr>';
			}
			$CartProducts .='</table>';

			if ($_POST['DiscountType']=='N') {
				// do nothing here
			} else {
				if ($_POST['DiscountApply']=='all_products') {
					$DiscountCode			   = $this->generateuniquerandomcouponcode();
					$TimeEnd					=  time() + $_POST['DiscountValidity'] * 24 * 60 * 60;
					$CouponData				 = array('name' => 'AbCart [' . $result['customer_info']['email'].']',
					'code'			=> $DiscountCode,
					'discount'		=> $_POST['Discount'],
					'type'			=> $_POST['DiscountType'],
					'total'		   => $_POST['TotalAmount'],
					'logged'		  => '0',
					'shipping'		=> '0',
					'date_start'	  => date('Y-m-d', time()),
					'date_end'		=> date('Y-m-d', $TimeEnd),
					'uses_total'	  => '1',
					'uses_customer'   => '1',
					'status'		  => '1');
					$this->model_sale_coupon->addCoupon($CouponData);
				} else if ($_POST['DiscountApply']=='cart_products') {
					$cart_products			  = array();
					foreach ($result['cart'] as $product) {
						$cart_products[] = $product['product_id'];
					}
					$DiscountCode	 = $this->generateuniquerandomcouponcode();
					$TimeEnd		  =  time() + $_POST['DiscountValidity'] * 24 * 60 * 60;
					$CouponData	   = array('name' => 'AbCart [' . $result['customer_info']['email'].']',
					'code'			=> $DiscountCode,
					'discount'		=> $_POST['Discount'],
					'type'			=> $_POST['DiscountType'],
					'total'		   => $_POST['TotalAmount'],
					'logged'		  => '0',
					'shipping'		=> '0',
					'coupon_product'  => $cart_products,
					'date_start'	  => date('Y-m-d', time()),
					'date_end'		=> date('Y-m-d', $TimeEnd),
					'uses_total'	  => '1',
					'uses_customer'   => '1',
					'status'		  => '1');
					$this->model_sale_coupon->addCoupon($CouponData);
				}
			}

			$patterns = array();
			$patterns[0] = '{firstname}';
			$patterns[1] = '{lastname}';
			$patterns[2] = '{cart_content}';
			if (!($_POST['DiscountType']=='N')) {
				$patterns[3] = '{discount_code}';
				$patterns[4] = '{discount_value}';
				$patterns[5] = '{total_amount}';
				$patterns[6] = '{date_end}';
			}
			$replacements = array();
			$replacements[0] = $result['customer_info']['firstname'];
			$replacements[1] = $result['customer_info']['lastname'];
			$replacements[2] = $CartProducts;
			if (!($_POST['DiscountType']=='N')) {
				$replacements[3] = $DiscountCode;
				$replacements[4] = $_POST['Discount'];
				$replacements[5] = $_POST['TotalAmount'];
				$replacements[6] = date('Y-m-d', $TimeEnd);
			}
			$HTMLMail = str_replace($patterns, $replacements, $Message);
			$MailData = array(
				'email' =>  $result['customer_info']['email'],
				'message' => $HTMLMail,
				'subject' => $_POST['Subject']);
			$emailResult = $this->model_module_abandonedcarts_1day->sendMail($MailData);
 			if ($emailResult) {
				echo "The email is sent successfully.";
				if (isset($_POST['RemoveAfterSend']))
					$run_query = $this->db->query("DELETE FROM `" . DB_PREFIX . "abandonedcarts_1day` WHERE `id`=".(int)$_POST['ABcart_id']);
			} else {
				echo "There is an error with the provided data in the form below.";
			}
		} else {
			echo "There is an error with the provided data in the form below.";
		}
	}

	public function testcron()
    {
        if (function_exists('shell_exec') && trim(shell_exec('echo EXEC')) == 'EXEC') {
            $this->data['shell_exec_status'] = 'Enabled';
        } else {
            $this->data['shell_exec_status'] = 'Disabled';
        }
        if ($this->data['shell_exec_status'] == 'Enabled') {
		   $cronFolder = dirname(DIR_APPLICATION) . '/vendors/abandonedcarts_1day/';
            if (shell_exec('crontab -l')) {
                $this->data['cronjob_status']    = 'Enabled';
                $curentCronjobs                  = shell_exec('crontab -l');
                $this->data['current_cron_jobs'] = explode(PHP_EOL, $curentCronjobs);
                file_put_contents($cronFolder . 'cron.txt', '* * * * * echo "test" ' . PHP_EOL);
            } else {
				file_put_contents($cronFolder . 'cron.txt', '* * * * * echo "test" ' . PHP_EOL);
                if (file_exists($cronFolder . 'cron.txt')) {
                    exec('crontab ' . $cronFolder . 'cron.txt');
                    if (shell_exec('crontab -l')) {
                        $this->data['cronjob_status'] = 'Enabled';
                        shell_exec('crontab -r');
                    } else {
                        $this->data['cronjob_status'] = 'Disabled';
                    }
                }
            }
            if (file_exists($cronFolder . 'cron.txt')) {
                $this->data['folder_permission'] = "Writable";
                unlink($cronFolder . 'cron.txt');
            } else {
                $this->data['folder_permission'] = "Unwritable";
            }
        }
        $this->data['cron_folder'] = $cronFolder;
        $this->template            = 'module/abandonedcarts_1day/test_cron.php';
        $this->response->setOutput($this->render());
    }

	public function removeallrecords() {
		if (isset($_POST['remove']) && ($_POST['remove']==true) && isset($_POST['store']) ) {
				$run_query = $this->db->query("DELETE FROM `" . DB_PREFIX . "abandonedcarts_1day` WHERE `store_id`='".$_POST['store']."'");
				if ($run_query) echo "Success!";
		}
	}

	public function removeallemptyrecords() {
		if (isset($_POST['remove']) && ($_POST['remove']==true) && isset($_POST['store']) ) {
				$run_query = $this->db->query("DELETE FROM `" . DB_PREFIX . "abandonedcarts_1day` WHERE `store_id`='".$_POST['store']."' AND `customer_info`=''");
				if ($run_query) echo "Success!";
		}
	}

	private function getCurrentStore($store_id) {
        if($store_id && $store_id != 0) {
            $store = $this->model_setting_store->getStore($store_id);
        } else {
            $store['store_id'] = 0;
            $store['name'] = $this->config->get('config_name');
            $store['url'] = $this->getCatalogURL();
        }
        return $store;
    }

	public function givenCoupons() {
		$this->load->model('module/abandonedcarts_1day');
		$action='givenCoupons';
		$this->listCoupons($action);
	}

	public function usedCoupons() {
		$this->load->model('module/abandonedcarts_1day');
		$action='usedCoupons';
		$this->listCoupons($action);
	}

	private function listCoupons($action) {
		$this->load->language('module/abandonedcarts_1day');

		if (isset($this->request->get['sort'])) {
				$sort = $this->request->get['sort'];
		} else {
				$sort = 'name';
		}
		if (isset($this->request->get['order'])) {
				$order = $this->request->get['order'];
		} else {
				$order = 'ASC';
		}
		if (isset($this->request->get['page'])) {
				$page = $this->request->get['page'];
		} else {
				$page = 1;
		}

		$url = '';
		if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
		}
		if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
		}
		if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
		}

		$this->data['givenCoupons']       = array();

		$data                        = array(
				'sort' => $sort,
				'order' => $order,
				'start' => ($page - 1) * $this->config->get('config_admin_limit'),
				'limit' => $this->config->get('config_admin_limit')
		);
		if($action == 'usedCoupons') {
			$coupon_total = $this->model_module_abandonedcarts_1day->getTotalUsedCoupons();
			$coupons  = $this->model_module_abandonedcarts_1day->getUsedCoupons($data);

		} else {
			$coupon_total  = $this->model_module_abandonedcarts_1day->getTotalGivenCoupons();
			$coupons  =      $this->model_module_abandonedcarts_1day->getGivenCoupons($data);
		}
		if(!empty($coupons)) {
			foreach ($coupons as $coupon) {
				$this->data['coupons'][] = array(
					'coupon_id' => $coupon['coupon_id'],
					'name' => $coupon['name'],
					'code' => $coupon['code'],
					'discount' => $coupon['discount'],
					'date_start' => date($this->language->get('date_format_short'), strtotime($coupon['date_start'])),
					'date_end' => date($this->language->get('date_format_short'), strtotime($coupon['date_end'])),
					'status' => ($coupon['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
					'date_added' => $coupon['date_added']
				);
			}
		}

		$languageVariables = array(
			'heading_title',
			'text_no_results',
			'column_coupon_name',
			'column_code',
			'column_discount',
			'column_date_start',
			'column_date_end',
			'column_status',
			'button_insert',
			'button_delete',
			'column_email',
			'column_date_added'
			);
		foreach ($languageVariables as $languageVariable) {
			$this->data[$languageVariable] = $this->language->get($languageVariable);
		}

		if (isset($this->error['warning'])) {
				$this->data['error_warning'] = $this->error['warning'];
		} else {
				$this->data['error_warning'] = '';
		}
		if (isset($this->session->data['success'])) {
				$this->data['success'] = $this->session->data['success'];
				unset($this->session->data['success']);
		} else {
				$this->data['success'] = '';
		}

		$url = '';
		if ($order == 'ASC') {
				$url .= '&order=DESC';
		} else {
				$url .= '&order=ASC';
		}
		if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
		}

		$this->data['sort_name']       = 'index.php?route=module/abandonedcarts_1day/'.$action.'&token=' . $this->session->data['token'] . '&sort=name' . $url;
		$this->data['sort_code']       = 'index.php?route=module/abandonedcarts_1day/'.$action.'&token=' . $this->session->data['token'] . '&sort=code' . $url;
		$this->data['sort_discount']   = 'index.php?route=module/abandonedcarts_1day/'.$action.'&token=' . $this->session->data['token'] . '&sort=discount' . $url;
		$this->data['sort_date_start'] = 'index.php?route=module/abandonedcarts_1day/'.$action.'&token=' . $this->session->data['token'] . '&sort=date_start' . $url;
		$this->data['sort_date_end']   = 'index.php?route=module/abandonedcarts_1day/'.$action.'&token=' . $this->session->data['token'] . '&sort=date_end' . $url;
		$this->data['sort_status']     = 'index.php?route=module/abandonedcarts_1day/'.$action.'&token=' . $this->session->data['token'] . '&sort=status' . $url;
		$this->data['sort_email']      = 'index.php?route=module/abandonedcarts_1day/'.$action.'&token=' . $this->session->data['token'] . '&sort=email' . $url;
		$this->data['sort_discount_type'] = 'index.php?route=module/abandonedcarts_1day/'.$action.'&token=' . $this->session->data['token'] . '&sort=discount_type' . $url;
		$this->data['sort_date_added']   = 'index.php?route=module/abandonedcarts_1day/'.$action.'&token=' . $this->session->data['token'] . '&sort=date_added' . $url;
		$url = '';
		if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
		}
		if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
		}
		$pagination               = new Pagination();
		$pagination->total        = $coupon_total;
		$pagination->page         = $page;
		$pagination->limit        = $this->config->get('config_admin_limit');
		$pagination->text         = $this->language->get('text_pagination');
		$pagination->url          = 'index.php?route=module/abandonedcarts_1day/'.$action.'&token=' . $this->session->data['token'] . $url . '&page={page}';
		$this->data['pagination'] = $pagination->render();
		$this->data['sort']       = $sort;
		$this->data['order']      = $order;
		$this->template           = 'module/abandonedcarts_1day/coupon.tpl';
		$this->response->setOutput($this->render());
	}

}

?>
