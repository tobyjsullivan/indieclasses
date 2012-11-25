<?php
require_once('Mail.php');

class Mailer {
	private $from;
	private $to;
	private $subject;
	private $body;

	private $host;
	private $port;
	private $auth;
	private $username;
	private $password;

	public function __construct() {
		$this->from = Configure::read('Company.name').' <'.Configure::read('Company.no-reply').'>'; // IndieClasses.com <no-reply@indieclasses.com>
		$this->to = null;
		$this->subject = null;
		$this->body = null;

		$this->host = Configure::read('Mail.host');
		$this->port = Configure::read('Mail.port');
		$this->auth = Configure::read('Mail.authenticate');
		$this->username = Configure::read('Mail.username');
		$this->password = Configure::read('Mail.password');
	}

	public function setTo($to) {
		$this->to = $to;
	}

	public function setSubject($subject) {
		$this->subject = $subject;
	}

	public function setBody($body) {
		$this->body = $body;
	}

	public function send() {
		$headers = array(
				'From' => $this->from,
				'To' => $this->to,
				'Subject' => $this->subject
			);
		$smtp = Mail::factory('smtp',
				array(
						'host' => $this->host,
						'port' => $this->port,
						'auth' => $this->auth,
						'username' => $this->username,
						'password' => $this->password
					)
			);

		$mail = $smtp->send($this->to, $headers, $this->body);

		if(PEAR::isError($mail)) {
			throw new MailerException('Error sending mail: '.$mail->getMessage());
		}

		return true;
	}

	class MailerException extends Exception {
		public function __construct($message, $code = 0, Exception $prev = null) {
			parent::__construct($message, $code, $prev);
		}
	}
}
?>