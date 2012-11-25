<?php
require_once('init.php');

$class_token = $_GET['class'];

$class = _Class::lookupByToken($class_token);

$view = new View("purchase");
$view->set('class_id', $class->getId());
echo $view->render();
?>