<?php
require_once('init.php');

if(array_key_exists('page', $_GET)) {
	$view = new View($_GET['page']);
	$view->set('page_title', 'Independent Yoga');
	try {
		echo $view->render();
	} catch(ViewException $ex) {
		$view = new View("404");
		echo $view->render();
	}
} else {
	$view = new View("tease");
	$view->set('page_title', 'Independent Yoga');
	echo $view->render();
}

/*
$view = new View("home");
$view->set('page_title', 'Independent Yoga');
echo $view->render();
*/
?>

