<?php

/**
 * Initialization file for template files
 *
 * This file is automatically included as a result of $config->prependTemplateFile
 * option specified in your /site/config.php.
 *
 * You can initialize anything you want to here. In the case of this beginner profile,
 * we are using it just to include another file with shared functions.
 *
 */

include_once("./_func.php"); // include our shared functions

$page->fullURL = new Purl\Url($page->httpUrl);
$page->fullURL->path = '';

if (!empty($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/') {
	$page->fullURL->join($_SERVER['REQUEST_URI']);
}

$db_modules = array(
	'dplusdata' => array(
		'module'   => 'DplusDatabase',
		'default'  => true
	),
	'dpluso' => array(
		'module'          => 'DplusOnlineDatabase',
		'default'  => false
	)
);

foreach ($db_modules as $key => $connection) {
	$module = $modules->get($connection['module']);
	$module->connectPropel();

	try {
		$propel_name  = $module->dbConnectionName();
		$$propel_name = $module->propelWriteConnection();
		$$propel_name->useDebug(true);
	} catch (Exception $e) {
		$module->logError($e->getMessage());
		$session->redirect($pages->get($config->errorpage_dplusdb)->url, $http301 = false);
	}
}


if (!$user->isLoggedInDplus(session_id()) && $page->template != 'login') {
	$session->redirect($pages->get('template=login')->url, $http301 = false);
}
$user->setup(session_id());


$config->twigloader = new Twig\Loader\FilesystemLoader($config->paths->templates.'twig/');
$config->twig = new Twig\Environment($config->twigloader, [
	'cache' => $config->paths->templates.'twig/cache/',
	'auto_reload' => true,
	'debug' => true
]);

$config->twig->addExtension(new Twig\Extension\DebugExtension());
include($config->paths->templates."/twig/util/functions.php");

$config->styles->append(hash_templatefile('vendor/bootstrap/css/bootstrap.min.css'));
$config->styles->append(hash_templatefile('vendor/font-awesome/css/font-awesome.min.css'));
$config->styles->append(hash_templatefile('styles/fontastic.css'));
$config->styles->append("https://fonts.googleapis.com/css?family=Roboto:300,400,500,700");
$config->styles->append(hash_templatefile('styles/grasp_mobile_progress_circle-1.0.0.min.css'));
$config->styles->append(hash_templatefile('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css'));
$config->styles->append(hash_templatefile('vendor/sweetalert/css/sweetalert.min.css'));
$config->styles->append(hash_templatefile('styles/style.blue.css'));
$config->styles->append(hash_templatefile('styles/custom.css'));

$config->scripts->append(hash_templatefile('vendor/jquery/jquery.min.js'));
$config->scripts->append(hash_templatefile('vendor/bootstrap/js/bootstrap.bundle.min.js'));
$config->scripts->append(hash_templatefile('scripts/grasp_mobile_progress_circle-1.0.0.min.js'));
$config->scripts->append(hash_templatefile('scripts/uri.js'));
$config->scripts->append(hash_templatefile('vendor/jquery.cookie/jquery.cookie.js'));
$config->scripts->append(hash_templatefile('vendor/chart.js/Chart.min.js'));
$config->scripts->append(hash_templatefile('vendor/jquery-validation/jquery.validate.min.js'));
$config->scripts->append(hash_templatefile('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js'));
$config->scripts->append(hash_templatefile('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js'));
$config->scripts->append(hash_templatefile('vendor/sweetalert/js/sweetalert.min.js'));
// $config->scripts->append(hash_templatefile('scripts/charts-home.js'));
$config->scripts->append(hash_templatefile('scripts/front.js'));
$config->scripts->append(hash_templatefile('scripts/custom.js'));
