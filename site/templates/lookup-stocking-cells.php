<?php
	$filter = $modules->get('FilterCstk');
	$filter->init_query($user);

	$q = $input->get->text('q');

	if ($input->get->q) {
		$filter->search($q);
		$page->headline = "Searching for '$q'";
	}

	if ($input->get->func) {
		if ($input->get->text('func') == 'vmi') {
			$vmi = $modules->get('VendorManagedInventory');
			$filter->cell($vmi->cstk_cells());
		}
	}

	$filter->sortby($page);
	$query = $filter->get_query();
	$cells = $query->paginate($input->pageNum, 10);

	$page->searchURL = $page->url;
	$page->body = $config->twig->render('api/lookup/stocking-cells/search.twig', ['page' => $page, 'cells' => $cells, 'datamatcher' => $modules->get('RegexMatcher'), 'q' => $q]);
	$page->body .= $config->twig->render('util/paginator.twig', ['page' => $page, 'resultscount'=> $cells->getNbResults()]);

	if ($config->ajax) {
		echo $page->body;
	} else {
		include __DIR__ . "/basic-page.php";
	}
