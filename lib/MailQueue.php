<?php
require_once('lib/Database.php');

class MailQueue {
	public static function enqueue($to, $subject, $body) {
		$db = new Database();

		$to = $db->escape_string($to);
		$subject = $db->escape_string($subject);
		$body = $db->escape_string($body);

		$sql = "INSERT INTO `emails` (`id`, `to`, `subject`, `body`) VALUES (NULL, '{$to}', '{$subject}', '{$body}')";

		if(!$db->query($sql)) {
			throw new Exception("Error queuing email: ".$db->error);
		}
	}
}
?>