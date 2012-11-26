<?php
require_once('init.php');

$class_token = $_GET['class'];

$class = _Class::lookupByToken($class_token);
if($class == null) {
	die('Error: Class could not be found');
}

$view = new View("class");
$view->set('class', $class);
echo $view->render();
?>
