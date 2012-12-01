<?php
require_once('init.php');

$errors = array();

$class_id = $_POST['class_id'];
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

require_once('lib/Stripe.php');
Stripe::setApiKey(Configure::read('Stripe.skey'));



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

$class = new _Class($class_id);

if(count($errors) > 0) {
	$view = new View("purchase");
	$view->set('class', $class);
	$view->set('errors', $errors);
	echo $view->render();
	exit(0);
}


$reg = Registration::create($class->getId(), $fname, $lname, $email, $phone, $class->getPrice());


$reg->setStripeCustomerId($customer['id']);

// Email confirmation
$confirm_email_view = new View("emails/register_confirm");
$confirm_email_content = $confirm_email_view->render();
$confirm_mailer = new Mailer();
$confirm_mailer->setTo($email);
$confirm_mailer->setSubject('You are registered for Four Weeks of Hatha with Hailey');
$confirm_mailer->setBody($confirm_email_content);
$confirm_mailer->send();

// Email teacher notification
$name = $fname.' '.$lname;
$notify_email_view = new View("emails/teacher_notify");
$notify_email_view->set('registration', $reg);
$notify_email_content = $notify_email_view->render();
$notify_mailer = new Mailer();
$notify_mailer->setTo($reg->getClass()->getTeacher()->getEmail());
$notify_mailer->setSubject($name.' has registered for your class');
$notify_mailer->setBody($notify_email_content);
$notify_mailer->send();

$view = new View('process');
echo $view->render();
?>