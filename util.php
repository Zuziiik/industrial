<?php

function sanitizeString($var) {
	$var = strip_tags($var);
	$var = htmlentities($var);
	$var = stripslashes($var);
	return mysql_real_escape_string($var);
}

function removeHTML($html) {
	include_once 'htmlpurifier-4.6.0/library/HTMLPurifier.auto.php';
	$config = HTMLPurifier_Config::createDefault();
	$config->set('Core.Encoding', 'UTF-8');
	$config->set('HTML', 'Allowed', 'p, strong, br, a, href, img, iframe, sup, sup, span, h3, h4, h5, h6, pre, ul, ol,
	 li, abr, blockquote, cite, dl, dt, dd'); // Allowed tags
	$config->set('HTML', 'AllowedAttributes', 'a.href, img.src, img.alt, img.height, img.width, iframe.src, iframe.height,
	iframe.width, p.style, span.style, ul.style, ol.style, blockquote.cite'); // Allowed attributes
	$config->set('HTML.Trusted', true);
	$config->set('Filter.YouTube', true);
	$purifier = new HTMLPurifier($config);
	return $purifier->purify($html);
}

function sanitizeTextArea($var) {
	$var = removeHTML($var);
	$var = stripslashes($var);
	return mysql_real_escape_string($var);
}

date_default_timezone_set('Europe/Prague');