<?php
$errors = array();

$class_id = $_POST['class_id'];
$class = new _Class($class_id);

$price = $class->getPrice();
$price_range = $class->getPriceRange(); 

/*
if($price_range != null) {
	if (!array_key_exists('fee', $_POST) || $_POST['fee'] == "") {
		$errors[] = "You must select a rate";
	} else {
		$fee = $_POST['fee'];

		if($fee < $price || $fee > ($price + $price_range)) {
			$errors[] = "Please select a valid rate";
		}
	}
} else
*/ {
	$fee = $price;
}

// Add HST
$fee *= 1.12;

$fname = $_POST['first-name'];
if($fname == "") {
	$errors[] = "Your first name is required.";
}
$lname = $_POST['last-name'];
if($lname == "") {
	$errors[] = "Your last name is required.";
}
$email = $_POST['email'];
if($email == "") {
	$errors[] = "Your email address is required.";
}

$phone = $_POST['phone'];
if($phone == "") {
	$errors[] = "Your phone number is required.";
}

require_once('stripe_init.php');


try {
	$stripe_token = $_POST['stripeToken'];
	$token = $stripe_token;
	$customer = Stripe_Customer::create(array(
		"description" => $fname." ".$lname." <".$email.">",
		"email" => $email,
		"card" => $token
		));
} catch (Stripe_CardError $ex) {
	$errors[] = $ex->getMessage();
}


if(count($errors) > 0) {
	$view = new View("purchase");
	$view->set('class', $class);
	$view->set('errors', $errors);
	echo $view->render();
	exit(0);
}


$reg = Registration::create($class->getId(), $fname, $lname, $email, $phone, $fee);


$reg->setStripeCustomerId($customer['id']);

// Email confirmation
$confirm_email_view = new View("emails/register_confirm");
$confirm_email_view->set('registration', $reg);
$confirm_email_content = $confirm_email_view->render();
MailQueue::enqueue($email, 'You are registered for '.$class->getTitle(), $confirm_email_content);
/*
$confirm_mailer = new Mailer();
$confirm_mailer->setTo($email);
$confirm_mailer->setSubject('You are registered for '.$class->getTitle());
$confirm_mailer->setBody($confirm_email_content);
$confirm_mailer->send();
*/

// Email teacher notification
$name = $fname.' '.$lname;
$notify_email_view = new View("emails/teacher_notify");
$notify_email_view->set('registration', $reg);
$notify_email_content = $notify_email_view->render();
MailQueue::enqueue($reg->getClass()->getTeacher()->getEmail(), $name.' has registered for your class', $notify_email_content);
/*
$notify_mailer = new Mailer();
$notify_mailer->setTo($reg->getClass()->getTeacher()->getEmail());
$notify_mailer->setSubject($name.' has registered for your class');
$notify_mailer->setBody($notify_email_content);
$notify_mailer->send();
*/

if(array_key_exists('subscribe', $_POST) && $_POST['subscribe'] == 'teacher') {
	Subscription::create($fname, $email, $class->getTeacher()->getId());
}
?>

<script type="text/javascript">
$(document).ready(function(){
	window.location="/thankyou";
});
</script>