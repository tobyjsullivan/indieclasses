<?php
$this->layout = "email";

$reg = $this->fetch('registration');
$class = $reg->getClass();

$start_fmt = "g:i A l, F jS, Y";
$start_date = date($start_fmt, $class->getStartDate());
?>
<html>
<head>
	<title><?= $class->getTitle() ?> is happening!</title>
</head>
<body>
	<p>Hi <?= $reg->getFirstName() ?>,</p>
	<p>You recently registered for
		<strong><?= $class->getTitle() ?></strong>. Good news! The class is happening. The 
		details are below.</p>

	<p><i>Note: This email address is not monitored. Do not reply to this email. If you have
		questions, comments or concerns, please email contact@indieclasses.com or visit 
		<a href="http://indieclasses.com">indieclasses.com</a>.</i></p>

	<p>Your credit card has been charged and you are on the attendee list.</p>

	<table width="100%">
		<tr>
			<th style="text-align: left;">Class</th>
			<th style="text-align: center;">Date and Time</th>
			<th style="text-align: center;">Teacher</th>
			<th style="text-align: center;">Fee</th>
		</tr>
		<tr>
			<td style="text-align: left;"><?= $class->getTitle() ?></td>
			<td style="text-align: center;"><?= $start_date ?></td>
			<td style="text-align: center;"><?= $class->getTeacher()->getName() ?></td>
			<td style="text-align: center;"><?= '$'.$reg->getAmount().'.00' ?></td>
		</tr>
	</table>

	<p>Thank you for supporting independent yoga teachers with <?= Configure::read('Company.name') ?>.</p>
	<p>Namaste,</p>
	<p>The <?= Configure::read('Company.name') ?> Team</p>
</body>
</html>
