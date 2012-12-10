<?php
$this->layout = "email";

$teacher = $this->fetch('teacher');
?>
<html>
<head>
</head>
<body>
	<p>A new teacher, <?= $teacher->getName() ?>, has signed up.</p>
	<p>This teacher's email address is <?= $teacher->getEmail() ?>.</p>
	<p>Namaste,</p>
	<p>The <?= Configure::read('Company.name') ?> Team.</p>
</body>
</html>