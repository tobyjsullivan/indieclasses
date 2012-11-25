<?php
class Configure {
	private static $values = array();

	public static function Write($key, $value) {
		$this->values[$key] = $value;
	}	

	public static function Read($key) {
		if(!array_key_exists($this->values, $key)) {
			return null;
		}

		return $this->values[$key];
	}
}
?>