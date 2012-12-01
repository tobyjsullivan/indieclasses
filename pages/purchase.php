<?php
$class = $this->fetch('class');

$this->start('page_title');
echo "Register for Class";
$this->end();

$this->start('css');
?>
<link rel="stylesheet" href="css/pages.purchase.css">
<?php
$this->end();

$this->start('script');
?>
<script type="text/javascript" charset="utf-8">
function validateInputs() {
	var valid = true;
	resetInvalid($('#first-name'));
	resetInvalid($('#last-name'));
	resetInvalid($('#email'));
	resetInvalid($('#phone'));

	if($('#phone').val() == "") {
		notifyInvalid($('#phone'));
		valid = false;
	}

	if($('#email').val() == "") {
		notifyInvalid($('#email'));
		valid = false;
	}

	if($('#last-name').val() == "") {
		notifyInvalid($('#last-name'));
		valid = false;
	}

	if($('#first-name').val() == "") {
		notifyInvalid($('#first-name'));
		valid = false;
	}

	return valid;
}

function notifyInvalid(element) {
	element.addClass('invalid');
	element.focus();
}

function resetInvalid(element) {
	element.removeClass('invalid');
}

function updateButton() {
	if(validateInputs()) {
		// $('#input-pending').hide();
		$('#input-complete').show();
	} else {
		$('#input-complete').hide();
		// $('#input-pending').show();
	}
}

$(document).ready(function() {
		// $('#input-complete').hide();
});
</script>
<?php
$this->end();
?>
<div class="sixteen columns">
	<h3>Register for <?= $class->getTitle() ?></h3>
	<p>All fields are required</p>
	<?php
	$errors = $this->fetch('errors');
	if($errors != null && count($errors) > 0) {
		?>
		<p class="errors">Required fields are empty:
			<?php
			foreach ($errors as $error) {
				echo $error.' ';
			}
			?>
		</p>
		<?php
	}
	?>
</div>
<form action="/process.php" method="post">
	<input type="hidden" name="class_id" value="<?= $class->getId() ?>" />
<div class="row">
	<div class="eight columns">
		
		<label for="first-name">First Name</label>
		<?php
		$def_fname = array_key_exists('first-name', $_POST) ? $_POST['first-name'] : "";
		$def_lname = array_key_exists('last-name', $_POST) ? $_POST['last-name'] : "";
		$def_email = array_key_exists('email', $_POST) ? $_POST['email'] : "";
		$def_phone = array_key_exists('phone', $_POST) ? $_POST['phone'] : "";
		?>
		<input type="text" id="first-name" name="first-name" value="<?= $def_fname ?>" />
		<label for="last-name">Last Name</label>
		<input type="text" id="last-name" name="last-name" value="<?= $def_lname ?>" />
	</div>
	<div class="eight columns">
		<label for="email">Email Address</label>
		<input type="email" id="email" name="email"  value="<?= $def_email ?>" />
		<label for="phone">Phone Number</label>
		<input type="text" id="phone" name="phone" value="<?= $def_phone ?>" />
	</div>
</div>
	<div class="eight columns">
		<label for="subscribe">
			<input type="checkbox" name="subscribe" value="teacher" checked="checked" />
			Notify me by email of future classes by <?= $class->getTeacher()->getName() ?>
		</label>
	</div>
	<div class="eight columns">
		<label for="fee-select">
			Registration Fee: 
			<?php
			$price_range = $class->getPriceRange();
			if($price_range == null) {
				echo '$'.$class->getPrice();
			} else {
				?>
				<select name="fee" id="fee-select">
				<?php
				$min_price = $class->getPrice();
				for($i = $price_range; $i >= 0; $i--) {
					$price_option = $min_price + $i;
					$option_id = 'fee-'.$price_option;
					?>
					<option value="<?= $price_option ?>"><?= '$'.$price_option ?></option>
					<?php
				}
				?>
				</select>
				<?php
			}
			?>
		</label>
		<div id="input-complete">
			<script src="https://button.stripe.com/v1/button.js" class="stripe-button" 
				data-key="<?= Configure::read('Stripe.pkey') ?>"></script>
		</div>
	</div>
</form>