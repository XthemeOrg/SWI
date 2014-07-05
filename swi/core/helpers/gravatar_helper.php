<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists("gravatar"))
{
	function gravatar($email, $size = 40)
	{
		// gravatar url
		$gURL = "http://www.gravatar.com/avatar/";
		
		// generate md5 hash of the users email.
		$hash = md5(strtolower(trim($email)));
		
		// echo the image url 
		print $gURL . $hash . "?s=" . $size;
	}
}
