<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('xss_clean'))
{
	function xss_clean($str, $is_image = FALSE)
	{
		$CI =& get_instance();
		return $CI->security->xss_clean($str, $is_image);
	}
}

if ( ! function_exists('sanitize_filename'))
{
	function sanitize_filename($filename)
	{
		$CI =& get_instance();
		return $CI->security->sanitize_filename($filename);
	}
}

if ( ! function_exists('do_hash'))
{
	function do_hash($str, $type = 'sha1')
	{
		if ($type == 'sha1')
		{
			return sha1($str);
		}
		else
		{
			return md5($str);
		}
	}
}

if ( ! function_exists('strip_image_tags'))
{
	function strip_image_tags($str)
	{
		$str = preg_replace("#<img\s+.*?src\s*=\s*[\"'](.+?)[\"'].*?\>#", "\\1", $str);
		$str = preg_replace("#<img\s+.*?src\s*=\s*(.+?).*?\>#", "\\1", $str);

		return $str;
	}
}

if ( ! function_exists('encode_php_tags'))
{
	function encode_php_tags($str)
	{
		return str_replace(array('<?php', '<?PHP', '<?', '?>'),  array('&lt;?php', '&lt;?PHP', '&lt;?', '?&gt;'), $str);
	}
}
