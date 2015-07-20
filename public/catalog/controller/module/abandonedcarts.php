<?php
class ControllerModuleAbandonedcarts extends Controller
{
    public function sendReminder()  {
		$log = new Log("abandonedcarts_log.txt");
		/* if (!defined('ABANDONEDCARTS_CLI')) {
		   exit;
       } */
        $log->write("LOG START");

        $this->request->post['store_id'] = 0;

		if(isset($this->request->post['store_id'])) {
            $store_id = $this->request->post['store_id'];
            $log->write("Send newsletter store_id=" . $store_id);
        } else {
            $log->write("The store_id is not defined and newsletter cannot be sent - sendNewsletter function");
            exit;
        }

        $log->write("LOG CONTINUE 1");

        $this->load->model('setting/setting');
        $this->load->model('tool/image');
        $this->load->model('module/abandonedcarts');
        $this->language->load('product/product');
		$this->data['text_price'] = $this->language->get('text_price');
		$this->data['text_qty'] = $this->language->get('text_qty');

		$setting = $this->model_module_abandonedcarts->getSetting('AbandonedCarts', $store_id);
        if (!empty($setting['AbandonedCarts']['Enabled']) && $setting['AbandonedCarts']['Enabled'] == 'yes' && !empty($setting['AbandonedCarts']['ScheduleEnabled']) && $setting['AbandonedCarts']['ScheduleEnabled'] == 'yes') {
			$dayLimit = $setting['AbandonedCarts']['Delay'];
			$results = $this->model_module_abandonedcarts->getCarts($dayLimit);
            $log->write('CARTS:' . count($results));
			$usedEmails = array();
			foreach ($results as $result) {
				$result['customer_info'] = json_decode($result['customer_info'], true);
				if (isset($result['customer_info']['email']) && isset($result['customer_info']['firstname']) && isset($result['customer_info']['lastname'])) {

					if (!in_array($result['customer_info']['email'], $usedEmails,true)) {

						// Subject and message language
						if (isset($result['customer_info']['language'])) {
							$Subject = $setting['AbandonedCarts']['Subject'][$result['customer_info']['language']];
							$Message = html_entity_decode($setting['AbandonedCarts']['Message'][$result['customer_info']['language']]);
						} else {
							$languages = $this->getLanguages();
							$firstLanguage = array_shift($languages);
							$firstLanguageCode = $firstLanguage['code'];
							$Subject = $setting['AbandonedCarts']['Subject'][$firstLanguageCode];
							$Message = html_entity_decode($setting['AbandonedCarts']['Message'][$firstLanguageCode]);
						}

						$result['cart']			 = json_decode($result['cart'], true);
						$catalog_link			   = "";
						$store_data				 = $this->getStore($store_id);
						$catalog_link			   = $store_data['url'];
						$width					  = (isset($setting['AbandonedCarts']['ProductWidth'])) ? $setting['AbandonedCarts']['ProductWidth'] : '60';
						$height					 = (isset($setting['AbandonedCarts']['ProductWidth'])) ? $setting['AbandonedCarts']['ProductHeight'] : '60';

						$CartProducts = '<table width="100%">';
						$CartProducts .= '<thead>
											<tr class="table-header">
											  <td class="left" width="70%"><strong>Product</strong></td>
											  <td class="left" width="15%"><strong>'.$this->data['text_qty'].'</strong></td>
											  <td class="left" width="15%"><strong>'.$this->data['text_price'].'</strong></td>
											</tr>
										 </thead>';
						foreach ($result['cart'] as $product) {
							if ($product['image']) {
								$image_thumb = $this->model_tool_image->resize($product['image'], $width, $height);
							} else {
								$image = false;
							}
							$CartProducts .='<tr>';
							$CartProducts .='<td class="name"><div id="picture" style="float:left;padding-right:3px;"><a href="'.$catalog_link.'index.php?route=product/product&product_id='. $product['product_id'].'" target="_blank"><img src="'.$image_thumb.'" /></a></div> <a href="'.$catalog_link.'index.php?route=product/product&product_id='. $product['product_id'].'" target="_blank">'.$product['name'].'</a><br />';
							foreach ($product['option'] as $option) {
								   $CartProducts .= '- <small>'.$option['name'].' '.$option['option_value'].'</small><br />';
							}
							$CartProducts .= '</td>
									  <td class="quantity">x&nbsp;'.$product['quantity'].'</td>
									  <td class="price">'.($this->currency->format($product['price'])).'</td>
									</tr>';
						}
						$CartProducts .='</table>';


						if ($setting['AbandonedCarts']['DiscountType']=='N') {
							// do nothing here
						} else {
							if ($setting['AbandonedCarts']['DiscountApply']=='all_products') {
								$DiscountCode			   = $this->generateuniquerandomcouponcode();
								$TimeEnd					=  time() + $setting['AbandonedCarts']['DiscountValidity'] * 24 * 60 * 60;
								$CouponData				 = array('name' => 'AbCart [' . $result['customer_info']['email'].']',
								'code'			=> $DiscountCode,
								'discount'		=> $setting['AbandonedCarts']['Discount'],
								'type'			=> $setting['AbandonedCarts']['DiscountType'],
								'total'		   => $setting['AbandonedCarts']['TotalAmount'],
								'logged'		  => '0',
								'shipping'		=> '0',
								'date_start'	  => date('Y-m-d', time()),
								'date_end'		=> date('Y-m-d', $TimeEnd),
								'uses_total'	  => '1',
								'uses_customer'   => '1',
								'status'		  => '1');
								$this->model_module_abandonedcarts->addCoupon($CouponData);
							} else if ($_POST['DiscountApply']=='cart_products') {
								$cart_products			  = array();
								foreach ($result['cart'] as $product) {
									$cart_products[] = $product['product_id'];
								}
								$DiscountCode	 = $this->generateuniquerandomcouponcode();
								$TimeEnd		  = time() + $setting['AbandonedCarts']['DiscountValidity'] * 24 * 60 * 60;
								$CouponData	   = array('name' => 'AbCart [' . $result['customer_info']['email'].']',
								'code'			=> $DiscountCode,
								'discount'		=> $setting['AbandonedCarts']['Discount'],
								'type'			=> $setting['AbandonedCarts']['DiscountType'],
								'total'		   => $setting['AbandonedCarts']['TotalAmount'],
								'logged'		  => '0',
								'shipping'		=> '0',
								'coupon_product'  => $cart_products,
								'date_start'	  => date('Y-m-d', time()),
								'date_end'		=> date('Y-m-d', $TimeEnd),
								'uses_total'	  => '1',
								'uses_customer'   => '1',
								'status'		  => '1');
								$this->model_module_abandonedcarts->addCoupon($CouponData);
							}
						}

						$patterns = array();
						$patterns[0] = '{firstname}';
						$patterns[1] = '{lastname}';
						$patterns[2] = '{cart_content}';
						if (!($setting['AbandonedCarts']['DiscountType']=='N')) {
							$patterns[3] = '{discount_code}';
							$patterns[4] = '{discount_value}';
							$patterns[5] = '{total_amount}';
							$patterns[6] = '{date_end}';
						}
						$replacements = array();
						$replacements[0] = $result['customer_info']['firstname'];
						$replacements[1] = $result['customer_info']['lastname'];
						$replacements[2] = $CartProducts;
						if (!($setting['AbandonedCarts']['DiscountType']=='N')) {
							$replacements[3] = $DiscountCode;
							$replacements[4] = $setting['AbandonedCarts']['Discount'];
							$replacements[5] = $setting['AbandonedCarts']['TotalAmount'];
							$replacements[6] = date('Y-m-d', $TimeEnd);
						}
						$HTMLMail = str_replace($patterns, $replacements, $Message);
						$MailData = array(
							'email' =>  $result['customer_info']['email'],
							'message' => $HTMLMail,
							'subject' => $Subject);

                        $log->write('MailData:' . implode(';;;;', $MailData));

						if (!in_array($result['customer_info']['email'], $usedEmails,true)) {
							$emailResult = $this->model_module_abandonedcarts->sendMail($MailData);
							$usedEmails[] = $result['customer_info']['email'];
						}

						if (isset($setting['AbandonedCarts']['RemoveAfterSend']))
							$run_query = $this->db->query("DELETE FROM `" . DB_PREFIX . "abandonedcarts` WHERE `id`=".(int)$result['id']);
					}
				}
			}
        } else {
			echo "There is something wrong with the configuration!";
		}
    }

	private function getStore($store_id) {
        if($store_id && $store_id != 0) {
            $store = $this->model_setting_store->getStore($store_id);
        } else {
            $store['store_id'] = 0;
            $store['name'] = $this->config->get('config_name');
            $store['url'] = $this->getCatalogURL();
        }
        return $store;
    }

	private function getCatalogURL(){
        if (isset($_SERVER['HTTPS']) && (($_SERVER['HTTPS'] == 'on') || ($_SERVER['HTTPS'] == '1'))) {
            $storeURL = HTTP_SERVER;
        } else {
            $storeURL = HTTPS_SERVER;
        }
        return $storeURL;
    }

	public function generateuniquerandomcouponcode() {
		$this->load->model('module/abandonedcarts');
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$couponCode = '';
		for ($i = 0; $i < 10; $i++) {
			$couponCode .= $characters[rand(0, strlen($characters) - 1)];
		}
		if($this->model_module_abandonedcarts->isUniqueCode($couponCode)) {
			return $couponCode;
		} else {
			return $this->generateuniquerandomcouponcode();
		}
	}

	private function getLanguages($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "language";

			$sort_data = array(
				'name',
				'code',
				'sort_order'
			);

			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY sort_order, name";
			}

			if (isset($data['order']) && ($data['order'] == 'DESC')) {
				$sql .= " DESC";
			} else {
				$sql .= " ASC";
			}

			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}

				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}

				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}

			$query = $this->db->query($sql);

			return $query->rows;
		} else {
			$language_data = $this->cache->get('language');

			if (!$language_data) {
				$language_data = array();

				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "language ORDER BY sort_order, name");

				foreach ($query->rows as $result) {
					$language_data[$result['code']] = array(
						'language_id' => $result['language_id'],
						'name'        => $result['name'],
						'code'        => $result['code'],
						'locale'      => $result['locale'],
						'image'       => $result['image'],
						'directory'   => $result['directory'],
						'filename'    => $result['filename'],
						'sort_order'  => $result['sort_order'],
						'status'      => $result['status']
					);
				}

				$this->cache->set('language', $language_data);
			}

			return $language_data;
		}
	}
}
?>
