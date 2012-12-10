<?php
require_once('init.php');

$name = $_POST['fname'].' '.$_POST['lname'];

$teach = Teacher::create($name, $_POST['email']);

$system_email = new View("emails/system_notify_teacher_signup");
$system_email->set('teacher', $teach);
$system_email_content = $system_email->render();
MailQueue::enqueue(Configure::read('Company.email'), $teach->getName().' has signed up as a teacher', $system_email_content);

$view = new View("teachers");
$view->set('signup-complete', true);
echo $view->render();

?>