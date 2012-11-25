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

if(count($errors) > 0) {
	$view = new View("purchase");
	$view->set('class_id', $class_id);
	$view->set('errors', $errors);
	echo $view->render();
	exit(0);
}

$stripe_token = $_POST['stripeToken'];

$class = new _Class($class_id);

$reg = Registration::create($class->getId(), $fname, $lname, $email, $phone, $class->getPrice());

require_once('lib/Stripe.php');

Stripe::setApiKey(Configure::read('Stripe.skey'));
$token = $_POST['stripeToken'];
$customer = Stripe_Customer::create(array(
	"description" => $fname." ".$lname." <".$email.">",
	"card" => $token
	));

$reg->setStripeCustomerId($customer['id']);

$view = new View('process');
echo $view->render();
?>