<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('lang'))
{
	function lang($line, $id = '')
	{
		$CI =& get_instance();
		$line = $CI->lang->line($line);

		if ($id != '')
		{
			$line = '<label for="'.$id.'">'.$line."</label>";
		}

		return $line;
	}
}

if ( ! function_exists('_t'))
{
        function _t($line)
        {
                $CI =& get_instance();
                print $CI->lang->line($line);
        }
}
