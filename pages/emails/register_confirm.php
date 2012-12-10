<?php
$this->layout = "email";

$reg = $this->fetch('registration');
$class = $reg->getClass();

$deadline_fmt = "F jS, Y";
$deadline = date($deadline_fmt, $class->getDeadline());

$start_fmt = "g:i A l, F jS, Y";
$start_date = date($start_fmt, $class->getStartDate());
?>
<html>
<head>
	<title>Thank you for registering!</title>
</head>
<body>
	<p>Hi <?= $reg->getFirstName() ?>,</p>
	<p>Thank you for registering for
		<strong><?= $class->getTitle() ?></strong>.</p>

	<p><i>Note: This email address is not monitored. Do not reply to this email. If you have
		questions, comments or concerns, please email contact@indieclasses.com or visit 
		<a href="http://indieclasses.com">indieclasses.com</a>.</i></p>
	<p>Your credit card has not been charged yet. Here's what will happen next:</p>
	<p>The deadline for registrations for this class is <?= $deadline ?>. If enough
		people register for the class by then, we will charge your card (along with everybody else's)
		and you'll be put on the attendee list for the class! If, however, not enough people are 
		registered by the deadline, we'll send you an email letting you know the class has been 
		cancelled and you will not be charged.</p>

	<table width="100%">
		<tr>
			<th style="text-align: left;">Class</th>
			<th style="text-align: center;">Date and Time</th>
			<th style="text-align: center;">Fee</th>
		</tr>
		<tr>
			<td style="text-align: left;"><?= $class->getTitle() ?></td>
			<td style="text-align: center;"><?= $start_date ?></td>
			<td style="text-align: center;"><?= '$'.$reg->getAmount().'.00' ?></td>
		</tr>
	</table>

	<p>Thank you for supporting independent yoga teachers with <?= Configure::read('Company.name') ?>.</p>
	<p>Namaste,</p>
	<p>The <?= Configure::read('Company.name') ?> Team</p>
</body>
</html>
