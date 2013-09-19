<?php
require_once('lib/Database.php');

class Subscription {
	public static function create($first_name, $email, $teacher_id) {
		$db = new Database();

		$first_name = $db->escape_string($first_name);
		$email = $db->escape_string($email);
		$teacher_id = $db->escape_string($teacher_id);

		$sql = "INSERT INTO subscriptions (id, first_name, email, teacher_id, subscribed)
					VALUES (NULL, '{$first_name}', '{$email}', '{$teacher_id}', NOW())";

		if(!$db->query($sql)) {
			throw new Exception("Error subscribing: ".$db->error);
		}
	}
}
?>
