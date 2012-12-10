<?php
$this->layout = "email";

$reg = $this->fetch('registration');
$name = $reg->getFirstName().' '.$reg->getLastName();
$class = $reg->getClass();
$class_title = $class->getTitle();
$class_url = Configure::read('Company.url').'/'.$class->getToken();
?>
<html>
<head>
	<title><?= $name ?> has registered for your class</title>
</head>
<body>
	<p><?= $name ?> has registered for
		<strong><?= $class_title ?></strong>.</p>
	<p>Class details: <a href="<?= $class_url ?>"><?= $class_url ?></a></p>

	<p><i>Note: This email address is not monitored. Do not reply to this email. If you have
		questions, comments or concerns, please email contact@indieclasses.com or visit 
		<a href="http://indieclasses.com">indieclasses.com</a>.</i></p>

	<p>You have a new attendee for your class. Their contact information is below.</p>
	<table>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Phone</th>
			<th>Fee</th>
		</tr>
		<tr>
			<td><?= $name ?></td>
			<td><?= $reg->getEmail() ?></td>
			<td><?= $reg->getPhone() ?></td>
			<td><?= '$'.$reg->getAmount().'.00' ?></td>
		</tr>
	</table>

	<p>Thank you for offering this class with <?= Configure::read('Company.name') ?>.</p>
	<p>Namaste,</p>
	<p>The <?= Configure::read('Company.name') ?> Team</p>
</body>
</html>
