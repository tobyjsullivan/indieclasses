<?php
class Configure {
	private static $values = array();

	public static function write($key, $value) {
		self::$values[$key] = $value;
	}	

	public static function read($key) {
		if(!array_key_exists($key, self::$values)) {
			return null;
		}

		return self::$values[$key];
	}
}
?>