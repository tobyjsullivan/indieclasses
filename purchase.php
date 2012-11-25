<?php
require_once('init.php');

$class_id = $_GET['class'];

$view = new View("purchase");
$view->set('page_title', 'Register for Class');
$view->set('class_id', $class_id);
echo $view->render();
?>