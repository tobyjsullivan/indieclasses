<?php
require_once('lib/Configure.php');

class Database extends Mysqli {
	public function __construct() {
		parent::__construct(
			Configure::read('Mysql.hostname'), 
			Configure::read('Mysql.username'), 
			Configure::read('Mysql.password'), 
			Configure::read('Mysql.database')
			);
	}
}
?>