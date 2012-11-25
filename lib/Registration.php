<?php
require_once('lib/Database.php');

class Registration {
	private $id;
	private $customer_id;

	public function __construct($id) {
		$this->id = $id;
	}

	public static function create($class_id, $fname, $lname, $email, $phone, $amount) {
		$db = new Database();

		$class_id = $db->escape_string($class_id);
		$fname = $db->escape_string($fname);
		$lname = $db->escape_string($lname);
		$email = $db->real_escape_string($email);
		$phone = $db->escape_string($phone);
		$amount = $db->escape_string($amount);

		$sql = "INSERT INTO registrations (class_id, first_name, last_name, email, phone, amount) 
			VALUES ('{$class_id}', '{$fname}', '{$lname}', '{$email}', '{$phone}', '{$amount}')";

		if(!$db->query($sql)) {
			throw new Exception("Registration failed: ".$db->error);
		}

		return new Registration($db->insert_id);
	}

	public function setStripeCustomerId($customer_id) {
		$db = new Database();

		$reg_id = $db->escape_string($this->id);
		$customer_id = $db->escape_string($customer_id);

		$sql = "UPDATE registrations SET stripe_customer_id='{$customer_id}' WHERE id='{$reg_id}' LIMIT 1";

		if(!$db->query($sql)) {
			throw new Exception('Failed to save transaction: '.$db->error);
		}

		$this->customer_id = $customer_id;
	}
}
?>