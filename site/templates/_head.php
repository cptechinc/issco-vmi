<?php $page->sidebar = $config->twig->render('shared/side-navbar.twig'); ?>
<?php $page->breadcrumbs = $config->twig->render('shared/bread-crumbs.twig', ['page' => $page]); ?>
<?php include ('./_head-blank.php'); ?>
	<?= $page->sidebar; ?>
	<div class="page">
		<?= $config->twig->render('shared/navbar.twig', ['pages' => $pages, 'page' => $page]); ?>
		<?= $page->breadcrumbs; ?>
