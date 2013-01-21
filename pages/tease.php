<?php
$signed_up = false;
if(array_key_exists("email", $_POST)) {
	$signed_up = NewsletterRecipient::create($_POST['email'], $_POST['name']);
}

$this->start('css');
?>
<link rel="stylesheet" href="css/pages.tease.css">
<?php
$this->end();
?>
<div class="row">
		<div class="span10 offset1">
			<h1>Indie Classes is Coming</h1>
		</div>
	</div>
	<div class="row">
		<div class="span7 offset1">
			<p>Something big is coming in June 2013. 
				<em>We're going to change how you take yoga.</em></p>
				<p>Be ready for our announcement on June 1st, 2013.</p>
				<?php
				/*
				<p>Have friends who love yoga? Don't let them miss out!</p>
				<p>[ Share on Facebook ] [ Tweet About This ]</p>
				*/
				?>
			</div> <!-- /.span10 -->
			<div class="sign-up span3">
				<div class="sign-up-content">
					<?php
					if($signed_up) {
						?>
						<p><strong>Thank you for signing up! We'll keep in touch.</strong></p>
						<?php
					} else {
					?>
					<p><strong>Get our announcement directly to your inbox</strong></p>
					<form class="form-inline sign-up-form" action="" method="post">
						<p>
							<input class="" type="text" placeholder="Full Name" name="name">
						</p>
						<p>
							<input class="" type="email" placeholder="Email" name="email">
						</p>
						<p>
							<button type="submit" class="btn btn-success pull-right">Sign Up</button>
							<div class="clearfix"></div>
						</p>
					</form>
					<?php
					}
					?>
					<p><small>* We will only use your information to keep you updated on Indie Classes. We promise to never sell or share your contact information with any third-party.</small></p>
				</div> <!-- /.sign-up-content -->
			</div> <!-- /.sign-up -->
		</div> <!-- /.row -->