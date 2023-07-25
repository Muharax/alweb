<?php
	
	$pageName = 'alweb';
	
	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$domainName = $_SERVER['HTTP_HOST'];
	
	defined('URL') or define('URL', $protocol.$domainName."/".$pageName."/");