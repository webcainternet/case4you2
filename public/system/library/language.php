<?php
class Language {
	private $default = 'english';
	private $directory;
	private $filename;
	private $data = array();
	private $db;
 
	public function __construct($directory) {
		$this->directory = $directory;
		$this->check_db();
	}
	
  	public function get($key) {
  		if(isset($this->data[$key])) {
  			return $this->data[$key];
  		}
  		else {
  			trigger_error('Translation not found: '.$key.' in '.basename(DIR_APPLICATION).': ' . $this->directory.'/'.$this->filename);
  			return $key;
  		}
  	}

	public function load($filename) {
		$this->filename = $filename;
		$file = DIR_LANGUAGE . $this->directory . '/' . $filename . '.php';
		if(!file_exists($file)) $file = DIR_LANGUAGE . $this->default . '/' . $filename . '.php';
    	
		if (file_exists($file)) {
			$_ = array();
	  		
			require($file);
		
			$this->data = array_merge($this->data, $_);
			
		} else {
			trigger_error('Error: Could not load language ' . $filename . '!');
			//exit();
		}
		$this->translate();
		return $this->data;
  	}

  	private function translate() {
		if(empty($this->db)) return;
		$interface = basename(dirname(DIR_LANGUAGE));
		$data = array();
  		$translate = $this->db->query("SELECT * FROM ".DB_PREFIX."translate
									WHERE `interface`='".$this->db->escape($interface)."'
									AND `directory`='".$this->db->escape($this->directory)."'
									AND `filename`='".$this->db->escape($this->filename)."'");
		foreach($translate->rows as $row) {
			$data[$row['key']] = $row['value'];
		}
		$this->data = array_merge($this->data, $data);
  	}

  	private function check_db() {
		if(empty($GLOBALS['db']) || !$GLOBALS['db'] instanceof DB) return;
		$db = $GLOBALS['db'];
		$query = $db->query("SHOW TABLES LIKE '".DB_PREFIX."translate'");
		if($query->num_rows) {
			$query = $db->query("SELECT * FROM ".DB_PREFIX."extension
								WHERE `type` = 'module' AND `code` = 'translate'");
			if($query->num_rows) $this->db = $db;
		}
  	}
}
?>