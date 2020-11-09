<?php
	$filter = $modules->get('FilterCstk');
	$filter->init_query($user);
	$q = $input->get->text('q');

	if ($input->get->q) {
		$filter->search($q);
		$page->headline = "Searching for '$q'";
	}

	$filter->sortby($page);
	$query = $filter->get_query();
	$cstks = $query->paginate($input->pageNum, 10);

	$page->body .= $config->twig->render('api/lookup/cstk/search.twig', ['page' => $page, 'cstks' => $cstks, 'datamatcher' => $modules->get('RegexMatcher'), 'q' => $q]);
	$page->body .= $config->twig->render('util/paginator.twig', ['page' => $page, 'resultscount'=> $cstks->getNbResults()]);

	if ($config->ajax) {
		echo $page->body;
	} else {
		include __DIR__ . "/basic-page.php";
	}
