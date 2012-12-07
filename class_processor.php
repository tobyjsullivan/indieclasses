<?php
require_once('init.php');

echo 'Searching for classes that meet criteria...<br />'.PHP_EOL;

$sql = "SELECT id FROM classes WHERE cancelled IS NULL AND succeeded IS NULL AND deadline<NOW()";

$db = new Database();

if(!($res = $db->query($sql))) {
	throw new Exception("Class lookup failed: ".$db->error);
}

echo 'Found '.$res->num_rows.' classes.<br />'.PHP_EOL;

require_once('stripe_init.php');

// Iterate over all classes that are neither cancelled nor succeeded 
// but for which the deadline has passed
while($row = $res->fetch_assoc())
{
	echo 'Processing class...<br />'.PHP_EOL;
	
	$class = new _Class($row['id']);
	// Check if class has just succeeded
	if($class->thresholdSatisfied()) {
		echo 'Class successful!<br />'.PHP_EOL;

		// Mark class successful
		$class->setSucceeded();

		$regs = $class->getRegistrations();

		foreach ($regs as $cur_reg) {
			// Charge all students
			$cust_id = $cur_reg->getStripeCustomerId();
			$amount = $cur_reg->getAmount();

			echo 'Charging customer $'.$amount.'...<br />'.PHP_EOL;

			$charge = Stripe_Charge::create(array(
				"amount" => $amount * 100,
				"currency" => "cad",
				"customer" => $cust_id
				));

			echo 'Successful Charge ID: '.$charge['id'].'.<br />'.PHP_EOL;


			$cur_reg->setStripeChargeId($charge['id']);

			echo 'Emailing customer...<br />'.PHP_EOL;

			// Email all students
			$notify_email_view = new View("emails/register_notify_success");
			$notify_email_view->set('registration', $cur_reg);
			$notify_email_content = $notify_email_view->render();
			$notify_mailer = new Mailer();
			$notify_mailer->setTo($cur_reg->getEmail());
			$notify_mailer->setSubject('You are registered for '.$class->getTitle());
			$notify_mailer->setBody($notify_email_content);
			$notify_mailer->send();

			echo 'Finished registering customer!<br />'.PHP_EOL;			
		}

		// Email attendee list to teacher
		// TODO

	// else class was unsuccessful
	} else {
		// Mark class as cancelled
		$class->setCancelled();

		$regs = $class->getRegistrations();
		foreach ($regs as $cur_reg) {
			// Email all students
			# code...
		}
	}
}
?>