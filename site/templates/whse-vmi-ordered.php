<?php
	$filter = $modules->get('FilterItemsVmiOrdered');
	$filter->init_query($user);

	$q = $input->get->text('q');

	if ($input->get->custID && $input->get->cell) {
		$filter->cstkcell($input->get->text('custID'), $input->get->text('shiptoID'), $input->get->text('cell'));
	}


	if ($input->get->q) {
		$filter->search($q);
		$page->headline = "Searching for '$q'";
	}

	$filter->sortby($page);
	$query = $filter->get_query();
	$items = $query->paginate($input->pageNum, 10);

	$page->body .= $config->twig->render('whse/vmi/ordered/search.twig', ['page' => $page, 'items' => $items, 'datamatcher' => $modules->get('RegexMatcher'), 'q' => $q]);
	$page->body .= $config->twig->render('util/paginator.twig', ['page' => $page, 'resultscount'=> $items->getNbResults()]);


	if ($config->ajax) {
		echo $page->body;
	} else {
		include __DIR__ . "/basic-page.php";
	}
