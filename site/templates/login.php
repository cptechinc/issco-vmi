<?php
	$rm = strtolower($input->requestMethod());
	$values = $input->$rm;
	$loginm = $modules->get('DplusUser');

	if ($values->action) {
		$loginm->process_input($input);
		$session->redirect($page->url, $http301 = false);
	}

	if ($user->isLoggedInDplus(session_id())) {
		$session->remove('loggingin');

		if ($session->returnurl) {
			$url = $session->returnurl;
			$session->remove('returnurl');
		} else {
			$url = $pages->get('/')->url;
		}
		$session->redirect($url, $http301 = false);
	}
	$page->body = $config->twig->render('login/page.twig', ['page' => $page]);
	include ('./basic-blank-page.php');
