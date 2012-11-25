<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<html>
<head>
	<meta charset="utf-8">
	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="css/base.css">
	<link rel="stylesheet" href="css/skeleton.css">
	<link rel="stylesheet" href="css/layout.css">
	<link rel="stylesheet" href="css/layouts.main.css">
	<?php
	echo $this->fetch('css');
	?>

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="js/jquery.js" type="text/javascript"></script>
	<?php
	echo $this->fetch('script');
	?>

	<title><?= $this->fetch('page_title') ?> - <?= Configure::read('Company.name') ?></title>
</head>
<body>
	<div class="container">
		<div class="sixteen columns">
			<h1 class="title remove-bottom"><?= Configure::read('Company.name') ?></h1>
			<p><em>Independent Yoga</em></p>
		</div>
		<?php
		echo $this->fetch('content');
		?> 
		<div class="sixteen columns">
			<hr />
			<p><small>&copy; Copyright 2012 IndieClasses.com</small></p>
		</div>
	</div>
</body>
</html>