<!DOCTYPE html>
<html>
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= $page->title; ?></title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="all,follow">
	<?php foreach($config->styles->unique() as $css) : ?>
		<link rel="stylesheet" type="text/css" href="<?= $css; ?>" />
	<?php endforeach; ?>
	<!-- Favicon and apple touch icons-->
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" href="img/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="57x57" href="img/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="img/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="img/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="img/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="img/apple-touch-icon-152x152.png">
	<!-- Tweaks for older IEs--><!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
	</head>
	<body>