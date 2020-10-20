<?php
	$page->body = $config->twig->render('home/page.twig', ['page' => $page]);
	include ('./basic-page.php');
?>
