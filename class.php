<?php
require_once('init.php');

$view = new View("class");
$view->set('page_title', 'Class Information');
echo $view->render();
?>
