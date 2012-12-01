<?php
require_once('lib/Database.php');

class Space {
	private $id;
	private $name;
	private $address;
	private $unit;
	private $city;

	private $data_fetched = false;

	public function __construct($id) {
		$this->id = $id;
	}

	public function getName() {
		$this->ensureDataFetched();

		return $this->name;
	}

	public function getAddress() {
		$this->ensureDataFetched();

		return $this->address;
	}

	public function getUnit() {
		$this->ensureDataFetched();

		return $this->unit;
	}

	public function getCity() {
		$this->ensureDataFetched();

		return $this->city;
	}

	private function ensureDataFetched() {
		if($this->data_fetched) {
			return;
		}

		$db = new Database();
		$space_id = $db->escape_string($this->id);

		$sql = "SELECT id, name, address, unit, city FROM spaces WHERE id='{$space_id}' LIMIT 1";

		if(!($res = $db->query($sql))) {
			throw new Exception("Failed to fetch space: ".$db->error);
		}

		if($res->num_rows == 0) {
			throw new Exception("Lookup failed. Space does not exist.");
		}

		$row = $res->fetch_assoc();
		$this->name = $row['name'];
		$this->address = $row['address'];
		$this->unit = $row['unit'];
		$this->city = $row['city'];

		$this->data_fetched = true;
	}
}
?>