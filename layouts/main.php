<!DOCTYPE html>
<html>
<head>
	<title><?= $this->fetch('page_title') ?> - <?= Configure::read('Company.name') ?></title>
</head>
<body>
	<h1><?= Configure::read('Company.name') ?></h1>
	<?php
	echo $this->fetch('content');
	?> 
</body>
</html>