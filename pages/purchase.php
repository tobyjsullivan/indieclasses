<?php
if(array_key_exists('class', $_GET)) {
	$class_token = $_GET['class'];
	$class = _Class::lookupByToken($class_token);
} else if(($class = $this->fetch('class')) == null) {
	throw new Exception("No class specified");
}

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
<div class="row">
	<div class="span12">
		<h3>Register for <?= $class->getTitle() ?></h3>
		<p>All fields are required</p>
		<?php
		$errors = $this->fetch('errors');
		if($errors != null && count($errors) > 0) {
			?>
			<p class="errors">Required fields are empty:
				<ul>
				<?php
				foreach ($errors as $error) {
					echo '<li class="errors">'.$error."</li>\n";
				}
				?>
				</ul>
			</p>
			<?php
		}
		?>
	</div>
</div>
<form action="/process" method="post" class="form-horizontal">
	<input type="hidden" name="class_id" value="<?= $class->getId() ?>" />
	<div class="row">
		<div class="span6">
			<div class="control-group">
				<label for="first-name" class="control-label">First Name</label>
				<?php
				$def_fname = array_key_exists('first-name', $_POST) ? $_POST['first-name'] : "";
				$def_lname = array_key_exists('last-name', $_POST) ? $_POST['last-name'] : "";
				$def_email = array_key_exists('email', $_POST) ? $_POST['email'] : "";
				$def_phone = array_key_exists('phone', $_POST) ? $_POST['phone'] : "";
				?>
				<div class="controls">
					<input type="text" id="first-name" name="first-name" value="<?= $def_fname ?>" />
				</div>
			</div>
			<div class="control-group">
				<label for="last-name" class="control-label">Last Name</label>
				<div class="controls">
					<input type="text" id="last-name" name="last-name" value="<?= $def_lname ?>" />
				</div>
			</div>
			<div class="control-group">
				<label for="email" class="control-label">Email Address</label>
				<div class="controls">
					<input type="email" id="email" name="email"  value="<?= $def_email ?>" />
				</div>
			</div>
			<div class="control-group">
				<label for="phone" class="control-label">Phone Number</label>
				<div class="controls">
					<input type="text" id="phone" name="phone" value="<?= $def_phone ?>" />
				</div>
			</div>
		</div>
		<div class="span6">
			<label for="subscribe">
				<input type="checkbox" name="subscribe" value="teacher" checked="checked" />
				Email me about future classes by <?= $class->getTeacher()->getName() ?>
			</label>
			<?php
			$price = $class->getPrice();
			?>
			<table class="invoice">
				<tr>
					<td class="item">Registration Fee</td>
					<td class="amount"><?= number_format($price, 2) ?></td>
				</tr>
				<tr>
					<td class="item">HST</td>
					<td class="amount"><?= number_format($price * 0.12, 2) ?></td>
				</tr>
				<tr class="total">
					<td class="item">Total</td>
					<td class="amount"><?= '$'.number_format($price * 1.12, 2) ?></td>
			</table>
				<?php
				/*
				?>
			<label for="fee-select">
				Registration Fee: 
				<?php
				$price_range = $class->getPriceRange();
				if($price_range == null) {
					echo '$'.$class->getPrice().' + HST';
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
			<?php
				*/
			?>
			<div id="input-complete">
				<script src="https://button.stripe.com/v1/button.js" class="stripe-button" 
					data-key="<?= Configure::read('Stripe.pkey') ?>"></script>
			</div>
		</div>
	</div>
</form>