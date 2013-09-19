<?php
require_once('lib/Database.php');
require_once('lib/Teacher.php');
require_once('lib/Space.php');

class _Class {
	private $id;
	private $token;
	private $title;
	private $teacher_id;
	private $space_id;
	private $price;
	private $price_range;
	private $threshold;
	private $threshold_type;
	private $max_attendees;
	private $deadline;
	private $start_date;
	private $duration;
	private $repetitions;
	private $description;
	private $cancelled;

	private $data_fetched = false;

	public function __construct($id) {
		$this->id = $id;
	}

	public static function lookupByToken($token) {
		$db = new Database();

		$token = $db->escape_string($token);

		$res = $db->query("SELECT id FROM classes WHERE token='{$token}' LIMIT 1");

		$cls = null;
		if($row = $res->fetch_assoc()) {
			$cls = new _Class($row['id']);
		}

		$db->close();
		return $cls;
	}

	public function getId() {
		return $this->id;
	}

	public function getToken(){ 
		$this->ensureDataFetched();

		return $this->token;
	}	

	public function getTitle(){ 
		$this->ensureDataFetched();

		return $this->title;
	}	

	public function getTeacher() {
		$this->ensureDataFetched();

		return new Teacher($this->teacher_id);
	}

	public function getSpace() {
		$this->ensureDataFetched();

		return new Space($this->space_id);
	}

	public function getPrice(){ 
		$this->ensureDataFetched();

		return $this->price;
	}

	public function getPriceRange(){ 
		$this->ensureDataFetched();

		return $this->price_range;
	}

	public function getThreshold(){ 
		$this->ensureDataFetched();

		return $this->threshold;
	}

	public function getThresholdType(){ 
		$this->ensureDataFetched();

		return $this->threshold_type;
	}

	public function getMaxAttendees(){ 
		$this->ensureDataFetched();

		return $this->max_attendees;
	}

	private $num_registered = null;
	public function getNumRegistered() {
		if($this->num_registered == null) {
			$db = new Database();

			$class_id = $db->escape_string($this->id);
			$sql = "SELECT COUNT(id) AS num FROM registrations WHERE class_id='{$class_id}'";

			if(!($res = $db->query($sql))) {
				throw new Exception('Error fetching registration count: '.$db->error);
			}

			$row = $res->fetch_assoc();

			$this->num_registered = $row['num'];

			$db->close();
		}

		return $this->num_registered;
	}

	private $amount_paid = null;
	public function getAmountPaid() {
		if($this->amount_paid == null) {
			$db = new Database();

			$class_id = $db->escape_string($this->id);
			$sql = "SELECT SUM(amount) AS paid FROM registrations WHERE class_id='{$class_id}'";

			if(!($res = $db->query($sql))) {
				throw new Exception('Error fetching registration count: '.$db->error);
			}

			$row = $res->fetch_assoc();

			$this->amount_paid = $row['paid'];			

			$db->close();
		}

		return $this->amount_paid;
	}

	public function getDeadline() {
		$this->ensureDataFetched();

		return $this->deadline;
	}

	public function getStartDate() {
		$this->ensureDataFetched();

		return $this->start_date;
	}

	public function getDuration() {
		$this->ensureDataFetched();

		return $this->duration;
	}

	public function getRepetitions() {
		$this->ensureDataFetched();

		return $this->repetitions;
	}

	public function getDescription() {
		$this->ensureDataFetched();

		return $this->description;
	}

	public function isCancelled() {
		$this->ensureDataFetched();

		return $this->cancelled != null;
	}

	public function thresholdSatisfied() {
		$this->ensureDataFetched();

		if($this->threshold_type == 'students') {
			return $this->getNumRegistered() >= $this->threshold;
		} else if ($this->threshold_type == 'fees') {
			return $this->getAmountPaid() >= $this->threshold;
		} else {
			throw new  Exception("Unrecognized threshold type");
			
		}
	}

	private function ensureDataFetched() {
		if($this->data_fetched) {
			return;
		}

		$db = new Database();
		$class_id = $db->escape_string($this->id);

		$sql = "SELECT 
					id, 
					token, 
					title, 
					teacher_id, 
					space_id, 
					price, 
					price_range,
					threshold,
					threshold_type,
					max_attendees, 
					deadline, 
					start_date, 
					duration, 
					repetitions, 
					description,
					cancelled
				FROM classes
				WHERE id='{$class_id}'
				LIMIT 1";
		if(!($res = $db->query($sql))) {
			throw new Exception("Failed to fetch class: ".$db->error);
		}

		if($res->num_rows == 0) {
			throw new Exception("Lookup failed. Class does not exist.");
		}

		$row = $res->fetch_assoc();
		$this->id = $row['id'];
		$this->token = $row['token'];
		$this->title = $row['title'];
		$this->teacher_id = $row['teacher_id'];
		$this->space_id = $row['space_id'];
		$this->price = $row['price'];
		$this->price_range = $row['price_range'];
		$this->threshold = $row['threshold'];
		$this->threshold_type = $row['threshold_type'];
		$this->max_attendees = $row['max_attendees'];
		$this->deadline = strtotime($row['deadline']);
		$this->start_date = strtotime($row['start_date']);
		$this->duration = $row['duration'];
		$this->repetitions = $row['repetitions'];
		$this->description = $row['description'];
		$this->cancelled = $row['cancelled'];

		$db->close();

		$this->data_fetched = true;
 	}

 	public function setCancelled() {
 		$db = new Database();

 		$class_id = $db->escape_string($this->id);

 		$sql = "UPDATE classes SET cancelled=NOW() WHERE id='{$class_id}' AND cancelled IS NULL";

 		if(!$db->query($sql)) {
 			throw new Exception("Failed to set class as cancelled: ".$db->error);
 		}
 	}

 	public function setSucceeded() {
 		$db = new Database();

 		$class_id = $db->escape_string($this->id);

 		$sql = "UPDATE classes SET succeeded=NOW() WHERE id='{$class_id}' AND succeeded IS NULL";

 		if(!$db->query($sql)) {
 			throw new Exception("Failed to set class as successful: ".$db->error);
 		}
 	}

 	public function getRegistrations() {
 		$db = new Database();

 		$class_id = $db->escape_string($this->id);

 		$sql = "SELECT id FROM registrations WHERE class_id='{$class_id}'";

 		if(!($res = $db->query($sql))) {
 			throw new Exception("Failed to fetch registrations: ".$db->error);
 		}

 		$registrations = array();
 		while($row = $res->fetch_assoc()) {
 			$registrations[] = new Registration($row['id']);
 		}

 		return $registrations;
 	}
}
?>