<?php
require_once('init.php');

$view = new View("home");
$view->set('page_title', 'Independent Yoga');
echo $view->render();
?>

