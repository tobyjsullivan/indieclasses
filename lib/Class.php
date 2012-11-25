<?php
require_once('lib/Database.php');

class _Class {
	private $id;
	private $token;
	private $title;
	private $teacher_id;
	private $space_id;
	private $price;
	private $min_attendees;
	private $max_attendees;
	private $deadline;
	private $start_date;
	private $duration;
	private $repetitions;
	private $description;

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

	public function getPrice() {
		$this->ensureDataFetched();

		return $this->price;
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
					min_attendees, 
					max_attendees, 
					deadline, 
					start_date, 
					duration, 
					repetitions, 
					description
				FROM classes
				WHERE id='{$class_id}'
				LIMIT 1";
		if(!($res = $db->query($sql))) {
			throw new Exception("Failed to fetch class: ".$db->error);
		}

		if($res->num_rows == 0) {
			throw new Exception("Lookup failed. _Class does not exist.");
		}

		$row = $res->fetch_assoc();
		$this->id = $row['id'];
		$this->token = $row['token'];
		$this->title = $row['title'];
		$this->teacher_id = $row['teacher_id'];
		$this->space_id = $row['space_id'];
		$this->price = $row['price'];
		$this->min_attendees = $row['min_attendees'];
		$this->max_attendees = $row['max_attendees'];
		$this->deadline = $row['deadline'];
		$this->start_date = $row['start_date'];
		$this->duration = $row['duration'];
		$this->repetitions = $row['repetitions'];
		$this->description = $row['description'];

		$this->data_fetched = true;
 	}
}
?>