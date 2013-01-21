<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<html lang="en">
<head>
	<meta charset="utf-8">
	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="css/bootstrap.css" media="screen" />
	<link rel="stylesheet" href="css/layouts.main.css">
	<link href='http://fonts.googleapis.com/css?family=Carme' rel='stylesheet' type='text/css'>
	<?php
	echo $this->fetch('css');
	?>

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/backstretch.js" type="text/javascript"></script>
	<?php
	echo $this->fetch('script');
	?>


	<script type="text/javascript">
	$(window).ready(function() {
		$.backstretch("/img/yoga_class_blur.jpg");
	});
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
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="./">Indie Classes</a>
				<div class="nav-collapse collapse">
					<ul class="nav">
						<li><a href="./">Home</a></li>
						<li><a href="./about">About</a></li>
						<li><a href="./contact">Contact</a></li>
					</ul>
					<!--
					<form class="navbar-form pull-right">
						<input class="span2" type="text" placeholder="Name">
						<input class="span2" type="email" placeholder="Email">
						<button type="submit" class="btn">Sign Up</button>
					</form>
					<p class="navbar-text pull-right">Get updated by email:&nbsp;</p>
					-->
				</div><!--/.nav-collapse -->
			</div> <!-- /.container -->
		</div> <!-- /.navbar-inner -->
	</div> <!-- /.navbar -->

	<div class="container main-container">
		<?php
		echo $this->fetch('content');
		?> 
		<div class="row">
			<footer class="span10 offset1">
				<p>&copy; Copyright 2013 <?= Configure::read('Company.name') ?></p>
			</footer>
		</div> <!-- /.row -->
	</div>
</body>
</html>
