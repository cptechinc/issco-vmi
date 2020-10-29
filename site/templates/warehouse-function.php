<?php
	// if ($user->isLoggedInDplusW(session_id())) {
		// $wm = $modules->get('WarehouseManagement');
		// $whsesession = $wm->whsesession(session_id());
		//
		// if ($wm->warehouse_exists($whsesession->whseid)) {
			include('./dplus-function.php');
		// } else {
		// 	$page->body = $config->twig->render('util/alert.twig', ['type' => 'danger', 'title' => "Warehouse not Found", 'iconclass' => 'fa fa-warning fa-2x', 'message' => "Warehouse '$whsesession->whseid' not available "]);
		// 	include('./basic-page.php');
		// }
	// } else {
	// 	$loginm = $modules->get('DplusUser');
	// 	$loginm->request_login_whse($user->loginid);
	// 	$session->redirect($page->url, $http301 = false);
	// }
