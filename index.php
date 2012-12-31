<?php
require_once('init.php');

$view = new View("tease");
$view->set('page_title', 'Independent Yoga');
echo $view->render();

/*
$view = new View("home");
$view->set('page_title', 'Independent Yoga');
echo $view->render();
*/
?>

