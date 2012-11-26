<?php
require_once('lib/Database.php');

class Registration {
	private $id;
	private $class_id;
	private $fname;
	private $lname;
	private $email;
	private $phone;
	private $stripe_customer_id;
	private $amount;
	private $stripe_charge_id;

	private $data_fetched = false;

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

		$this->stripe_customer_id = $customer_id;
	}

	public function getClass() {
		$this->ensureDataFetched();

		return new _Class($this->class_id);
	}

	public function getFirstName() {
		$this->ensureDataFetched();

		return $this->fname;	
	}

	public function getLastName() {
		$this->ensureDataFetched();

		return $this->lname;	
	}

	public function getEmail() {
		$this->ensureDataFetched();

		return $this->email;	
	}

	public function getPhone() {
		$this->ensureDataFetched();

		return $this->phone;	
	}

	public function getStripeCustomerId() {
		$this->ensureDataFetched();

		return $this->stripe_customer_id;	
	}

	public function getAmount() {
		$this->ensureDataFetched();

		return $this->amount;	
	}

	public function getStripeChargeId() {
		$this->ensureDataFetched();

		return $this->stripe_charge_id;	
	}

	private function ensureDataFetched() {
		if($this->data_fetched) {
			return;
		}

		$db = new Database();

		$reg_id = $db->escape_string($this->id);

		$sql = "SELECT 
					id,
					class_id, 
					first_name, 
					last_name, 
					email, 
					phone, 
					stripe_customer_id, 
					amount, 
					stripe_charge_id
				FROM registrations
				WHERE id='{$reg_id}'
				LIMIT 1";
				
		if(!($res = $db->query($sql))) {
			throw new Exception("Failed to fetch registration data: " . $db->error);
		}

		if($res->num_rows == 0) {
			throw new Exception("Could not find registration with id {$reg_id}");
		}

		$row = $res->fetch_assoc();

		$this->id = $row['id'];
		$this->class_id = $row['class_id'];
		$this->fname = $row['first_name'];
		$this->lname = $row['last_name'];
		$this->email = $row['email'];
		$this->phone = $row['phone'];
		$this->stripe_customer_id = $row['stripe_customer_id'];
		$this->amount = $row['amount'];
		$this->stripe_charge_id = $row['stripe_charge_id'];
		
	}
}
?>