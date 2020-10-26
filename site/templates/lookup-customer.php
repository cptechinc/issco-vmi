<?php
	$filter = $modules->get('FilterCustomers');
	$filter->init_query($user);

	$q = $input->get->text('q');

	if ($input->get->q) {
		$filter->search($q);
		$page->headline = "Searching for '$q'";
	}

	if ($input->get->func) {
		if ($input->get->text('func') == 'vmi') {
			$vmi = $modules->get('VendorManagedInventory');
			$filter->custid($vmi->cstk_custids());
		}
	}

	$filter->sortby($page);
	$query = $filter->get_query();
	$customers = $query->paginate($input->pageNum, 10);

	$page->body = $config->twig->render('api/lookup/customer/search.twig', ['page' => $page, 'customers' => $customers, 'datamatcher' => $modules->get('RegexMatcher'), 'q' => $q]);
	$page->body .= $config->twig->render('util/paginator.twig', ['page' => $page, 'resultscount'=> $customers->getNbResults()]);

	if ($config->ajax) {
		echo $page->body;
	} else {
		include __DIR__ . "/basic-page.php";
	}
