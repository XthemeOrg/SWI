<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_Typography {

	var $block_elements = 'address|blockquote|div|dl|fieldset|form|h\d|hr|noscript|object|ol|p|pre|script|table|ul';

	var $skip_elements	= 'p|pre|ol|ul|dl|object|table|h\d';

	var $inline_elements = 'a|abbr|acronym|b|bdo|big|br|button|cite|code|del|dfn|em|i|img|ins|input|label|map|kbd|q|samp|select|small|span|strong|sub|sup|textarea|tt|var';

	var $inner_block_required = array('blockquote');

	var $last_block_element = '';

	var $protect_braced_quotes = FALSE;

	function auto_typography($str, $reduce_linebreaks = FALSE)
	{
		if ($str == '')
		{
			return '';
		}

		if (strpos($str, "\r") !== FALSE)
		{
			$str = str_replace(array("\r\n", "\r"), "\n", $str);
		}

		if ($reduce_linebreaks === TRUE)
		{
			$str = preg_replace("/\n\n+/", "\n\n", $str);
		}

		$html_comments = array();
		if (strpos($str, '<!--') !== FALSE)
		{
			if (preg_match_all("#(<!\-\-.*?\-\->)#s", $str, $matches))
			{
				for ($i = 0, $total = count($matches[0]); $i < $total; $i++)
				{
					$html_comments[] = $matches[0][$i];
					$str = str_replace($matches[0][$i], '{@HC'.$i.'}', $str);
				}
			}
		}

		if (strpos($str, '<pre') !== FALSE)
		{
			$str = preg_replace_callback("#<pre.*?>.*?</pre>#si", array($this, '_protect_characters'), $str);
		}

		$str = preg_replace_callback("#<.+?>#si", array($this, '_protect_characters'), $str);

		if ($this->protect_braced_quotes === TRUE)
		{
			$str = preg_replace_callback("#\{.+?\}#si", array($this, '_protect_characters'), $str);
		}

		$str = preg_replace("#<(/*)(".$this->inline_elements.")([ >])#i", "{@TAG}\\1\\2\\3", $str);

		$chunks = preg_split('/(<(?:[^<>]+(?:"[^"]*"|\'[^\']*\')?)+>)/', $str, -1, PREG_SPLIT_DELIM_CAPTURE|PREG_SPLIT_NO_EMPTY);

		$str = '';
		$process = TRUE;
		$paragraph = FALSE;
		$current_chunk = 0;
		$total_chunks = count($chunks);

		foreach ($chunks as $chunk)
		{
			$current_chunk++;

			if (preg_match("#<(/*)(".$this->block_elements.").*?>#", $chunk, $match))
			{
				if (preg_match("#".$this->skip_elements."#", $match[2]))
				{
					$process =  ($match[1] == '/') ? TRUE : FALSE;
				}

				if ($match[1] == '')
				{
					$this->last_block_element = $match[2];
				}

				$str .= $chunk;
				continue;
			}

			if ($process == FALSE)
			{
				$str .= $chunk;
				continue;
			}

			if ($current_chunk == $total_chunks)
			{
				$chunk .= "\n";
			}

			$str .= $this->_format_newlines($chunk);
		}

		if ( ! preg_match("/^\s*<(?:".$this->block_elements.")/i", $str))
		{
			$str = preg_replace("/^(.*?)<(".$this->block_elements.")/i", '<p>$1</p><$2', $str);
		}

		$str = $this->format_characters($str);

		for ($i = 0, $total = count($html_comments); $i < $total; $i++)
		{
			$str = preg_replace('#(?(?=<p>\{@HC'.$i.'\})<p>\{@HC'.$i.'\}(\s*</p>)|\{@HC'.$i.'\})#s', $html_comments[$i], $str);
		}

		$table = array(

						'/(<p[^>*?]>)<p>/'	=> '$1',
						
						'#(</p>)+#'			=> '</p>',
						'/(<p>\W*<p>)+/'	=> '<p>',

						'#<p></p><('.$this->block_elements.')#'	=> '<$1',

						'#(&nbsp;\s*)+<('.$this->block_elements.')#'	=> '  <$2',

						'/\{@TAG\}/'		=> '<',
						'/\{@DQ\}/'			=> '"',
						'/\{@SQ\}/'			=> "'",
						'/\{@DD\}/'			=> '--',
						'/\{@NBS\}/'		=> '  ',

						"/><p>\n/"			=> ">\n<p>",

						"#</p></#"			=> "</p>\n</"
						);

		if ($reduce_linebreaks === TRUE)
		{
			$table['#<p>\n*</p>#'] = '';
		}
		else
		{
			$table['#<p></p>#'] = '<p>&nbsp;</p>';
		}

		return preg_replace(array_keys($table), $table, $str);

	}

	function format_characters($str)
	{
		static $table;

		if ( ! isset($table))
		{
			$table = array(

							'/\'"(\s|$)/'					=> '&#8217;&#8221;$1',
							'/(^|\s|<p>)\'"/'				=> '$1&#8216;&#8220;',
							'/\'"(\W)/'						=> '&#8217;&#8221;$1',
							'/(\W)\'"/'						=> '$1&#8216;&#8220;',
							'/"\'(\s|$)/'					=> '&#8221;&#8217;$1',
							'/(^|\s|<p>)"\'/'				=> '$1&#8220;&#8216;',
							'/"\'(\W)/'						=> '&#8221;&#8217;$1',
							'/(\W)"\'/'						=> '$1&#8220;&#8216;',

							'/\'(\s|$)/'					=> '&#8217;$1',
							'/(^|\s|<p>)\'/'				=> '$1&#8216;',
							'/\'(\W)/'						=> '&#8217;$1',
							'/(\W)\'/'						=> '$1&#8216;',

							'/"(\s|$)/'						=> '&#8221;$1',
							'/(^|\s|<p>)"/'					=> '$1&#8220;',
							'/"(\W)/'						=> '&#8221;$1',
							'/(\W)"/'						=> '$1&#8220;',

							"/(\w)'(\w)/"					=> '$1&#8217;$2',

							'/\s?\-\-\s?/'					=> '&#8212;',
							'/(\w)\.{3}/'					=> '$1&#8230;',

							'/(\W)  /'						=> '$1&nbsp; ',

							'/&(?!#?[a-zA-Z0-9]{2,};)/'		=> '&amp;'
						);
		}

		return preg_replace(array_keys($table), $table, $str);
	}

	function _format_newlines($str)
	{
		if ($str == '')
		{
			return $str;
		}

		if (strpos($str, "\n") === FALSE  && ! in_array($this->last_block_element, $this->inner_block_required))
		{
			return $str;
		}

		$str = str_replace("\n\n", "</p>\n\n<p>", $str);

		$str = preg_replace("/([^\n])(\n)([^\n])/", "\\1<br />\\2\\3", $str);

		if ($str != "\n")
		{
			$str =  '<p>'.rtrim($str).'</p>';
		}

		$str = preg_replace("/<p><\/p>(.*)/", "\\1", $str, 1);

		return $str;
	}

	function _protect_characters($match)
	{
		return str_replace(array("'",'"','--','  '), array('{@SQ}', '{@DQ}', '{@DD}', '{@NBS}'), $match[0]);
	}

	function nl2br_except_pre($str)
	{
		$ex = explode("pre>",$str);
		$ct = count($ex);

		$newstr = "";
		for ($i = 0; $i < $ct; $i++)
		{
			if (($i % 2) == 0)
			{
				$newstr .= nl2br($ex[$i]);
			}
			else
			{
				$newstr .= $ex[$i];
			}

			if ($ct - 1 != $i)
				$newstr .= "pre>";
		}

		return $newstr;
	}

}
