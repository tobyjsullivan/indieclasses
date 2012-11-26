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
		<strong>Four Weeks of Hatha with Hailey</strong>.</p>
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
		</tr>
		<tr>
			<td><?= $name ?></td>
			<td><?= $reg->getEmail() ?></td>
			<td><?= $reg->getPhone() ?></td>
		</tr>
	</table>

	<p>Thank you for offering this class with IndieClasses.com.</p>
	<p>Namaste,</p>
	<p>The IndieClasses.com Team</p>
</body>
</html>
