<?php
	use Twig\TwigFilter;

	$filter = new TwigFilter('currency', function ($money) {
		return number_format($money, 2, '.', ",");
	});
	$config->twig->addFilter($filter);

	$filter = new TwigFilter('convertdate', function ($date, $format = 'm/d/Y') {
		$date = date($format, strtotime($date));
		return $date == '11/30/-0001' ? '' : $date;
	});
	$config->twig->addFilter($filter);

	$filter = new TwigFilter('yesorno', function ($trueorfalse) {
		return ($trueorfalse === true || strtoupper($trueorfalse) == 'Y') ? 'yes' : 'no';
	});
	$config->twig->addFilter($filter);

	$filter = new TwigFilter('bool', function ($tf) {
		return boolval($tf);
	});
	$config->twig->addFilter($filter);

	$filter = new TwigFilter('attrJS', function ($string, $jsprepend = true) {
		$string = preg_replace("/[^A-Za-z0-9 ]/", 'symbol', $string);
		return $jsprepend ? "js-$string" : $string;
	});
	$config->twig->addFilter($filter);

	$filter = new TwigFilter('array_key_exists', function ($array, $key) {
		return array_key_exists($key, $array);
	});
	$config->twig->addFilter($filter);

	$filter = new TwigFilter('array_values', function ($array) {
		return array_values($array);
	});
	$config->twig->addFilter($filter);

	$filter = new TwigFilter('php_string', function ($str, $func) {
		return $func($str);
	});
	$config->twig->addFilter($filter);

	$filter = new Twig_Filter('htmlattributes', function ($array) {
		$attr = '';
		foreach ($array as $key => $value) {
			$attr .= " $key=$value";
		}
		return $attr;
	});
	$config->twig->addFilter($filter);
