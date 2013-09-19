<?php
class NewsletterRecipient {
	public static function create($email, $full_name) {
		$db = new Database();

		$email = $db->escape_string($email);
		$full_name = $db->escape_string($full_name);

		$sql = "INSERT INTO newsletter_recipients (email, full_name, created) 
			VALUES ('{$email}', '{$full_name}', NOW())";

		if(!$db->query($sql)) {
			throw new Exception("Signup failed: ".$db->error);
		}

		return true;
	}
}