<?php
require_once('init.php');

$class_id = $_GET['class'];

$view = new View("class");
$view->set('page_title', 'Class Information');
$view->set('class_id', $class_id);
echo $view->render();
?>
