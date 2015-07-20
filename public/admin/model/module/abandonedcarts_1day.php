<?php
class ModelModuleAbandonedcarts1Day extends Model {
	/* upgrade start (from older versions than 1.4)	*/
	public function upgrade() {
		$query =  $this->db->query("SELECT * FROM `" . DB_PREFIX . "abandonedcarts_1day` ORDER BY `id` DESC");
		if (sizeof($query->rows)>0) {
			foreach ($query->rows as $item) {
				$flag = false;
				if (!$this->is_json($item['cart'])) {
				$item['cart'] = unserialize($item['cart']);
				$item['cart'] = json_encode($item['cart']);
				$flag = true;
				}
				if (!$this->is_json($item['customer_info'])) {
				$item['customer_info'] = unserialize($item['customer_info']);
				$item['customer_info'] = json_encode($item['customer_info']);
				$flag = true;
				}
				if ($flag) {
					$update_data = ($this->updateCart($item['id'],$item['customer_info'],$item['cart']));
					if ($update_data)
							return false;
				}
			}
		}
		return true;
	}

	public function updateCart($id, $customer, $cart) {
		$this->db->query("UPDATE `" . DB_PREFIX . "abandonedcarts_1day` SET `cart`='".$this->db->escape($cart)."', `customer_info`='".$this->db->escape($customer)."'
		WHERE `id`=".$id);
	}

	function is_json($str)
	{
    	return is_array(json_decode($str,true));
	}
	/* upgrade end (from older versions than 1.4) */

	public function install() {
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "abandonedcarts_1day` (
			`id` INT(11) NOT NULL AUTO_INCREMENT,
			`date_created` DATETIME NULL DEFAULT NULL,
			`date_modified` DATETIME NULL DEFAULT NULL,
			`cart` TEXT NULL DEFAULT NULL,
			`customer_info` TEXT NULL DEFAULT NULL,
			`last_page` VARCHAR(255) NULL DEFAULT NULL,
			`restore_id` VARCHAR(255) NULL DEFAULT NULL,
			`ip` VARCHAR(100) NULL DEFAULT NULL,
			`store_id` TINYINT NOT NULL DEFAULT 0,
			 PRIMARY KEY (`id`))");
	}

	public function uninstall() {
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "abandonedcarts_1day`");
	}

	public function viewAbandonedCarts($page=1, $limit=8, $store=0,$sort="id", $order="DESC") {
		if ($page) {
				$start = ($page - 1) * $limit;
			}
			$query =  $this->db->query("SELECT * FROM `" . DB_PREFIX . "abandonedcarts_1day`
			WHERE `store_id`='".$store."'
			ORDER BY `id` DESC
			LIMIT ".$start.", ".$limit);

		return $query->rows;
	}

	public function getTotalAbandonedCarts($store=0){
		$query = $this->db->query("SELECT COUNT(*) as `count`  FROM `" . DB_PREFIX . "abandonedcarts_1day` WHERE `store_id`=".$store);

		return $query->row['count'];
	}

	public function getCartInfo($id) {
		$query =  $this->db->query("SELECT * FROM `" . DB_PREFIX . "abandonedcarts_1day`
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

	public function sendMail($data = array()) {
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
		if ($mailToUser)
		return true;
			else
		return false;
	}

	public function getSetting($group, $store_id = 0) {
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

	public function editSetting($group, $data, $store_id = 0) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE store_id = '" . (int)$store_id . "' AND `group` = '" . $this->db->escape($group) . "'");

		foreach ($data as $key => $value) {
		  if (!is_array($value)) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "setting SET store_id = '" . (int)$store_id . "', `group` = '" . $this->db->escape($group) . "', `key` = '" . $this->db->escape($key) . "', `value` = '" . $this->db->escape($value) . "'");
		  } else {
			$this->db->query("INSERT INTO " . DB_PREFIX . "setting SET store_id = '" . (int)$store_id . "', `group` = '" . $this->db->escape($group) . "', `key` = '" . $this->db->escape($key) . "', `value` = '" . $this->db->escape(serialize($value)) . "', serialized = '1'");
		  }
		}
  	}

	public function getGivenCoupons($data=array()) {
		$givenCoupons = $this->db->query("	SELECT *
											FROM " . DB_PREFIX . "coupon
											WHERE name LIKE  '%AbCart [%'
											ORDER BY " . $data['sort'] . " ". $data['order'] . "
											LIMIT " . $data['start'].", " . $data['limit'] );
		return $givenCoupons->rows;
	}

	public function getTotalGivenCoupons() {
		$givenCoupons = $this->db->query("SELECT COUNT(*) as count FROM " . DB_PREFIX . "coupon WHERE name LIKE '%AbCart [%'");
		return $givenCoupons->row['count'];
	}

	public function getUsedCoupons($data=array()) {
		$usedCoupons = $this->db->query("SELECT *
		 								  FROM `" . DB_PREFIX . "coupon` AS c
										  JOIN `" . DB_PREFIX . "coupon_history` AS ch ON c.coupon_id=ch.coupon_id
										  WHERE name LIKE  '%AbCart [%'
										  ORDER BY " . $data['sort'] . " ". $data['order'] . "
										  LIMIT " . $data['start'].", " . $data['limit'] );
		return $usedCoupons->rows;
	}

	public function getTotalUsedCoupons() {
		$givenCoupons = $this->db->query("SELECT COUNT(*) as count FROM `" . DB_PREFIX . "coupon` as c
											JOIN `" . DB_PREFIX . "coupon_history` AS ch ON c.coupon_id=ch.coupon_id
											WHERE name LIKE  '%AbCart [%'");
		return $givenCoupons->row['count'];
	}
}
?>
