<?php
	$rm = strtolower($input->requestMethod());
	$values = $input->$rm;
	$vmi = $modules->get('VendorManagedInventory');
	$order = $vmi->create_order_from_input($input);

	if ($values->action) {
		$vmi->process_input($input);
		$session->redirect($page->fullURL->getUrl(), $http301 = false);
	}

	if ($session->response_vmi) {
		$page->alert = $config->twig->render('whse/vmi/alert.twig', ['response' => $session->response_vmi]);
	}

	if ($input->get->text('form') == 'order' && $vmi->validate_cstkcell($order)) {
		$page->body .= $config->twig->render('whse/vmi/order/page.twig', ['page' => $page, 'vmi' => $vmi, 'order' => $order]);
		$page->js   .= $config->twig->render('whse/vmi/order/js.twig', ['page' => $page, 'vmi' => $vmi]);
	} else {
		if (($values->custid && $values->cell) &&!$vmi->validate_cstkcell($order)) {
			$page->alert .= $config->twig->render('whse/vmi/alert.twig', ['response' => $vmi->get_validate_response($order)]);
		}
		$page->body .= $config->twig->render('whse/vmi/cstkcell/page.twig', ['page' => $page, 'vmi' => $vmi, 'order' => $order]);
		$page->js   .= $config->twig->render('whse/vmi/cstkcell/js.twig', ['page' => $page, 'vmi' => $vmi]);
	}

	if ($session->response_vmi) {
		$session->remove('response_vmi');
	}


	if ($config->ajax) {
		echo $page->body;
	} else {
		include __DIR__ . "/basic-page.php";
	}
