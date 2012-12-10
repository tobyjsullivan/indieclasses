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
	<link href='http://fonts.googleapis.com/css?family=Carme' rel='stylesheet' type='text/css'>
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
	
	<script type="text/javascript">
	document.write('<scr' + 'ipt src="' + document.location.protocol + '//fby.s3.amazonaws.com/fby.js?100"></scr' + 'ipt>');
	</script>
	<script type="text/javascript">
	FBY.showTab({id: '3494', position: 'right', color: '#2E88D1'});
	</script>

	<title><?= $this->fetch('page_title') ?> - <?= Configure::read('Company.name') ?></title>

	<?php
	if(Configure::read('Instance.debug') == 0) {
		?>
		<script type="text/javascript">

		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-36928143-1']);
		_gaq.push(['_setDomainName', 'indieclasses.com']);
		_gaq.push(['_trackPageview']);

		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();

		</script>
		<?php
	}
	?>
</head>
<body>
	<div class="container">
		<div class="sixteen columns banner">
			<h1 class="title remove-bottom"><a href="/"><?= strtolower(Configure::read('Company.name')) ?></a></h1>
			<p class="tagline"><strong>Independent Yoga - Empowering Teachers</strong></p>
		</div>
		<?php
		echo $this->fetch('content');
		?> 
		<div class="sixteen columns">
			<hr />
			<p><small>&copy; Copyright 2012 <?= Configure::read('Company.name') ?></small></p>
		</div>
	</div>
</body>
</html>