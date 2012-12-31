<?php
require_once('init.php');

$view = new View("about");
$view->set('page_title', 'About Indie Classes');
echo $view->render();
?>

