<?php
require_once('lib/Database.php');

class Teacher {
	private $id;
	private $name;
	private $website;
	private $email;

	private $data_fetched = false;

	public function __construct($id) {
		$this->id = $id;
	}

	public static function create($name, $email) {
		$db = new Database();

		$name = $db->escape_string($name);
		$email = $db->escape_string($email);

		$sql = "INSERT INTO `teachers` (`id`, `name`, `email`) VALUES (NULL, '{$name}', '{$email}')";

		if(!$db->query($sql)) {
			throw new Exception('Error adding teaching: '.$db->error);
		}

		return new Teacher($db->insert_id);
	}

	public function getId() {
		return $this->id;
	}

	public function getName() {
		$this->ensureDataFetched();

		return $this->name;
	}

	public function getWebsite() {
		$this->ensureDataFetched();

		return $this->website;
	}

	public function getEmail() {
		$this->ensureDataFetched();

		return $this->email;
	}

	private function ensureDataFetched() {
		if($this->data_fetched) {
			return;
		}

		$db = new Database();

		$teacher_id = $db->escape_string($this->id);

		$sql = "SELECT id, name, website, email FROM teachers WHERE id='{$teacher_id}' LIMIT 1";

		if(!($res = $db->query($sql))) {
			throw new Exception('Failed to fetch teacher data: '.$db->error);
		}

		if($res->num_rows == 0) {
			throw new Exception('Could not find teacher with ID: '.$teacher_id);
		}

		$row = $res->fetch_assoc();

		$this->id = $row['id'];
		$this->name = $row['name'];
		$this->website = $row['website'];
		$this->email = $row['email'];

		$this->data_fetched = true;
	}
}