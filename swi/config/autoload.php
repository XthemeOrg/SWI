<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

$autoload['packages'] 	= array();
$autoload['libraries'] 	= array('session', 'xmlrpc', 'form_validation', 'atheme', 'fout', 'recaptcha');
$autoload['helper'] 	= array('url', 'file', 'form', 'language', 'gravatar');
$autoload['config'] 	= array();
$autoload['language'] 	= array('english');
$autoload['model'] 		= array('memoserv_model', 'nickserv_model', 'chanserv_model', 'botserv_model', 'groupserv_model', 'hostserv_model', 'operserv_model');
