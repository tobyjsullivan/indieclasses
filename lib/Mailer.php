<?php
require_once('Mail.php');
require_once('Mail/mime.php');

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
		$this->from = '"'.Configure::read('Company.name').'" <'.Configure::read('Company.no-reply').'>'; // IndieClasses.com <no-reply@indieclasses.com> // Configure::read('Company.no-reply'); 
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

		$mail_config = array(
						'host' => $this->host,
						'port' => $this->port,
						'auth' => $this->auth,
						'username' => $this->username,
						'password' => $this->password
					);

		$smtp = Mail::factory('Smtp', $mail_config);
		
		$crlf = "\n";
		$mime = new Mail_mime($crlf);
		$mime->setHTMLBody($this->body);

		$mail = $smtp->send($this->to, $mime->headers($headers), $mime->get());

		if(PEAR::isError($mail)) {
			throw new MailerException('Error sending mail: '.$mail->getMessage());
		}

		return true;
	}
}

class MailerException extends Exception {
	public function __construct($message, $code = 0, Exception $prev = null) {
		parent::__construct($message, $code, $prev);
	}
}
?>