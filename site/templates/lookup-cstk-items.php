<?php
	if ($input->get->custID && $input->get->cell) {
		$filter = $modules->get('FilterItemsCstk');
		$filter->init_query($user);

		$q = $input->get->text('q');
		$cell = new ProcessWire\WireData();

		$filter->cstkcell($input->get->text('custID'), $input->get->text('shiptoID'), $input->get->text('cell'));

		if ($input->get->q) {
			$filter->search($q);
			$page->headline = "Searching for '$q'";
		}

		$cell->custid   = $input->get->custID ? $input->get->text('custID') : '';
		$cell->shiptoid = $input->get->shiptoID ? $input->get->text('shiptoID') : '';
		$cell->cell     = $input->get->cell ? $input->get->text('cell') : '';

		$filter->sortby($page);
		$query = $filter->get_query();
		$items = $query->paginate($input->pageNum, 10);

		$page->body .= $config->twig->render('api/lookup/cstk-items/search.twig', ['page' => $page, 'items' => $items, 'datamatcher' => $modules->get('RegexMatcher'), 'q' => $q]);
		$page->body .= $config->twig->render('util/paginator.twig', ['page' => $page, 'resultscount'=> $items->getNbResults()]);
	} else {
		$page->title = "Customer ID or Cell Location is not provided";
		$page->body = $config->twig->render('util/alert.twig', ['type' => 'danger', 'title' => $page->title, 'iconclass' => 'fa fa-warning fa-2x', 'message' => "Invalid Customer ID or Cell Location"]);
	}

	if ($config->ajax) {
		echo $page->body;
	} else {
		include __DIR__ . "/basic-page.php";
	}
