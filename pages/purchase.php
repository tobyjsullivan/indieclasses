<div class="sixteen columns">
	<h3>Register for Four Weeks of Hatha with Hailey</h3>
</div>
<form action="/process.php" method="post">
	<div class="eight columns">
		<label for="first-name">First Name</label>
		<input type="text" id="first-name" name="first-name" />
		<label for="last-name">Last Name</label>
		<input type="text" id="last-name" name="last-name" />
	</div>
	<div class="eight columns">
		<label for="email">Email Address</label>
		<input type="email" id="email" name="email" />
		<label for="phone">Phone Number</label>
		<input type="text" id="phone" name="phone" />
		<script src="https://button.stripe.com/v1/button.js" class="stripe-button" 
			data-key="<?= Configure::read('Stripe.pkey') ?>"
			data-amount="2500"></script>
	</div>
</form>