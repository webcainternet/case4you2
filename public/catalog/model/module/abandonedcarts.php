<?php
class ModelModuleAbandonedcarts extends Model {

	public function getCartInfo($id) {
		$query =  $this->db->query("SELECT * FROM `" . DB_PREFIX . "abandonedcarts`
			WHERE `id`=".$id);

		return $query->row;
	}

	public function isUniqueCode($randomCode) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "coupon` WHERE code='".$this->db->escape($randomCode)."'");
				if($query->num_rows == 0) {
					return true;
							} else {
					return false;
				}
	}

	public function addCoupon($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "coupon SET name = '" . $this->db->escape($data['name']) . "', code = '" . $this->db->escape($data['code']) . "', discount = '" . (float)$data['discount'] . "', type = '" . $this->db->escape($data['type']) . "', total = '" . (float)$data['total'] . "', logged = '" . (int)$data['logged'] . "', shipping = '" . (int)$data['shipping'] . "', date_start = '" . $this->db->escape($data['date_start']) . "', date_end = '" . $this->db->escape($data['date_end']) . "', uses_total = '" . (int)$data['uses_total'] . "', uses_customer = '" . (int)$data['uses_customer'] . "', status = '" . (int)$data['status'] . "', date_added = NOW()");

		$coupon_id = $this->db->getLastId();

		if (isset($data['coupon_product'])) {
			foreach ($data['coupon_product'] as $product_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "coupon_product SET coupon_id = '" . (int)$coupon_id . "', product_id = '" . (int)$product_id . "'");
			}
		}

		if (isset($data['coupon_category'])) {
			foreach ($data['coupon_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "coupon_category SET coupon_id = '" . (int)$coupon_id . "', category_id = '" . (int)$category_id . "'");
			}
		}
	}

	public function sendMail($data = array()) {
		$log = new Log("abandonedcarts_log.txt");
		$mailToUser = new Mail();
		$mailToUser->protocol 	= $this->config->get('config_mail_protocol');
		$mailToUser->parameter   = $this->config->get('config_mail_parameter');
		$mailToUser->hostname 	= $this->config->get('config_smtp_host');
		$mailToUser->username 	= $this->config->get('config_smtp_username');
		$mailToUser->password 	= $this->config->get('config_smtp_password');
		$mailToUser->port 		= $this->config->get('config_smtp_port');
		$mailToUser->timeout 	 = $this->config->get('config_smtp_timeout');
		$mailToUser->setTo($data['email']);
		$mailToUser->setFrom($this->config->get('config_email'));
		$mailToUser->setSender($this->config->get('config_email'));
		$mailToUser->setSubject(html_entity_decode($data['subject'], ENT_QUOTES, 'UTF-8'));
		$mailToUser->setHtml($data['message']);
		$mailToUser->send();
		if ($mailToUser) {
			$log->write("MAIL SENT: " . $data['email']);
			return true;
		} else {
			$log->write("MAIL NOT SENT: " . $data['email']);
			return false;
		}
	}

	public function getCarts($dayLimit) {
		$query =  $this->db->query("SELECT * FROM `" . DB_PREFIX . "abandonedcarts`
			WHERE `date_modified` < '".date("Y-m-d 00:00:00",strtotime('-'.$dayLimit.' days'))."'");
		return $query->rows;
	}

	  public function getSetting($group, $store_id) {
		$data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE store_id = '" . (int)$store_id . "' AND `group` = '" . $this->db->escape($group) . "'");

		foreach ($query->rows as $result) {
		  if (!$result['serialized']) {
			$data[$result['key']] = $result['value'];
		  } else {
			$data[$result['key']] = unserialize($result['value']);
		  }
		}
		return $data;
	  }

}
?>
