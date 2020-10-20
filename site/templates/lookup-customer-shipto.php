<?php
	$rm = strtolower($input->requestMethod());
	$values = $input->$rm;
	$custID = $values->text('custID');
	$filter = $modules->get('FilterCustomerShipto');
	$filter->init_query($user);
	$filter->custid($custID);

	$q = $input->get->text('q');

	if ($input->get->q) {
		$filter->search($q);
		$page->headline = "Searching for '$q'";
	}

	$filter->sortby($page);
	$query = $filter->get_query();
	$shiptos = $query->paginate($input->pageNum, 10);

	$page->body = $config->twig->render('api/lookup/customer/shipto/search.twig', ['page' => $page, 'shiptos' => $shiptos, 'datamatcher' => $modules->get('RegexMatcher'), 'q' => $q, 'custID' => $custID]);
	$page->body .= $config->twig->render('util/paginator.twig', ['page' => $page, 'resultscount'=> $shiptos->getNbResults()]);

	if ($config->ajax) {
		echo $page->body;
	} else {
		include __DIR__ . "/basic-page.php";
	}
