<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_Trackback {

	var $time_format	= 'local';
	var $charset		= 'UTF-8';
	var $data			= array('url' => '', 'title' => '', 'excerpt' => '', 'blog_name' => '', 'charset' => '');
	var $convert_ascii	= TRUE;
	var $response		= '';
	var $error_msg		= array();

	public function __construct()
	{
		log_message('debug', "Trackback Class Initialized");
	}

	function send($tb_data)
	{
		if ( ! is_array($tb_data))
		{
			$this->set_error('The send() method must be passed an array');
			return FALSE;
		}

		foreach (array('url', 'title', 'excerpt', 'blog_name', 'ping_url') as $item)
		{
			if ( ! isset($tb_data[$item]))
			{
				$this->set_error('Required item missing: '.$item);
				return FALSE;
			}

			switch ($item)
			{
				case 'ping_url'	: $$item = $this->extract_urls($tb_data[$item]);
					break;
				case 'excerpt'	: $$item = $this->limit_characters($this->convert_xml(strip_tags(stripslashes($tb_data[$item]))));
					break;
				case 'url'		: $$item = str_replace('&#45;', '-', $this->convert_xml(strip_tags(stripslashes($tb_data[$item]))));
					break;
				default			: $$item = $this->convert_xml(strip_tags(stripslashes($tb_data[$item])));
					break;
			}

			if ($this->convert_ascii == TRUE)
			{
				if ($item == 'excerpt')
				{
					$$item = $this->convert_ascii($$item);
				}
				elseif ($item == 'title')
				{
					$$item = $this->convert_ascii($$item);
				}
				elseif ($item == 'blog_name')
				{
					$$item = $this->convert_ascii($$item);
				}
			}
		}

		$charset = ( ! isset($tb_data['charset'])) ? $this->charset : $tb_data['charset'];

		$data = "url=".rawurlencode($url)."&title=".rawurlencode($title)."&blog_name=".rawurlencode($blog_name)."&excerpt=".rawurlencode($excerpt)."&charset=".rawurlencode($charset);

		$return = TRUE;
		if (count($ping_url) > 0)
		{
			foreach ($ping_url as $url)
			{
				if ($this->process($url, $data) == FALSE)
				{
					$return = FALSE;
				}
			}
		}

		return $return;
	}

	function receive()
	{
		foreach (array('url', 'title', 'blog_name', 'excerpt') as $val)
		{
			if ( ! isset($_POST[$val]) OR $_POST[$val] == '')
			{
				$this->set_error('The following required POST variable is missing: '.$val);
				return FALSE;
			}

			$this->data['charset'] = ( ! isset($_POST['charset'])) ? 'auto' : strtoupper(trim($_POST['charset']));

			if ($val != 'url' && function_exists('mb_convert_encoding'))
			{
				$_POST[$val] = mb_convert_encoding($_POST[$val], $this->charset, $this->data['charset']);
			}

			$_POST[$val] = ($val != 'url') ? $this->convert_xml(strip_tags($_POST[$val])) : strip_tags($_POST[$val]);

			if ($val == 'excerpt')
			{
				$_POST['excerpt'] = $this->limit_characters($_POST['excerpt']);
			}

			$this->data[$val] = $_POST[$val];
		}

		return TRUE;
	}

	function send_error($message = 'Incomplete Information')
	{
		echo "<?xml version=\"1.0\" encoding=\"utf-8\"?".">\n<response>\n<error>1</error>\n<message>".$message."</message>\n</response>";
		exit;
	}

	function send_success()
	{
		echo "<?xml version=\"1.0\" encoding=\"utf-8\"?".">\n<response>\n<error>0</error>\n</response>";
		exit;
	}

	function data($item)
	{
		return ( ! isset($this->data[$item])) ? '' : $this->data[$item];
	}

	function process($url, $data)
	{
		$target = parse_url($url);

		if ( ! $fp = @fsockopen($target['host'], 80))
		{
			$this->set_error('Invalid Connection: '.$url);
			return FALSE;
		}

		$ppath = ( ! isset($target['path'])) ? $url : $target['path'];

		$path = (isset($target['query']) && $target['query'] != "") ? $ppath.'?'.$target['query'] : $ppath;

		if ($id = $this->get_id($url))
		{
			$data = "tb_id=".$id."&".$data;
		}

		fputs ($fp, "POST " . $path . " HTTP/1.0\r\n" );
		fputs ($fp, "Host: " . $target['host'] . "\r\n" );
		fputs ($fp, "Content-type: application/x-www-form-urlencoded\r\n" );
		fputs ($fp, "Content-length: " . strlen($data) . "\r\n" );
		fputs ($fp, "Connection: close\r\n\r\n" );
		fputs ($fp, $data);

		$this->response = "";

		while ( ! feof($fp))
		{
			$this->response .= fgets($fp, 128);
		}
		@fclose($fp);


		if (stristr($this->response, '<error>0</error>') === FALSE)
		{
			$message = 'An unknown error was encountered';

			if (preg_match("/<message>(.*?)<\/message>/is", $this->response, $match))
			{
				$message = trim($match['1']);
			}

			$this->set_error($message);
			return FALSE;
		}

		return TRUE;
	}

	function extract_urls($urls)
	{
		$urls = preg_replace("/\s*(\S+)\s*/", "\\1,", $urls);

		$urls = str_replace(",,", ",", $urls);

		if (substr($urls, -1) == ",")
		{
			$urls = substr($urls, 0, -1);
		}

		$urls = preg_split('/[,]/', $urls);

		$urls = array_unique($urls);

		array_walk($urls, array($this, 'validate_url'));

		return $urls;
	}

	function validate_url($url)
	{
		$url = trim($url);

		if (substr($url, 0, 4) != "http")
		{
			$url = "http://".$url;
		}
	}

	function get_id($url)
	{
		$tb_id = "";

		if (strpos($url, '?') !== FALSE)
		{
			$tb_array = explode('/', $url);
			$tb_end   = $tb_array[count($tb_array)-1];

			if ( ! is_numeric($tb_end))
			{
				$tb_end  = $tb_array[count($tb_array)-2];
			}

			$tb_array = explode('=', $tb_end);
			$tb_id	= $tb_array[count($tb_array)-1];
		}
		else
		{
			$url = rtrim($url, '/');

			$tb_array = explode('/', $url);
			$tb_id	= $tb_array[count($tb_array)-1];

			if ( ! is_numeric($tb_id))
			{
				$tb_id  = $tb_array[count($tb_array)-2];
			}
		}

		if ( ! preg_match ("/^([0-9]+)$/", $tb_id))
		{
			return FALSE;
		}
		else
		{
			return $tb_id;
		}
	}

	function convert_xml($str)
	{
		$temp = '__TEMP_AMPERSANDS__';

		$str = preg_replace("/&#(\d+);/", "$temp\\1;", $str);
		$str = preg_replace("/&(\w+);/",  "$temp\\1;", $str);

		$str = str_replace(array("&","<",">","\"", "'", "-"),
							array("&amp;", "&lt;", "&gt;", "&quot;", "&#39;", "&#45;"),
							$str);

		$str = preg_replace("/$temp(\d+);/","&#\\1;",$str);
		$str = preg_replace("/$temp(\w+);/","&\\1;", $str);

		return $str;
	}

	function limit_characters($str, $n = 500, $end_char = '&#8230;')
	{
		if (strlen($str) < $n)
		{
			return $str;
		}

		$str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));

		if (strlen($str) <= $n)
		{
			return $str;
		}

		$out = "";
		foreach (explode(' ', trim($str)) as $val)
		{
			$out .= $val.' ';
			if (strlen($out) >= $n)
			{
				return trim($out).$end_char;
			}
		}
	}

	function convert_ascii($str)
	{
		$count	= 1;
		$out	= '';
		$temp	= array();

		for ($i = 0, $s = strlen($str); $i < $s; $i++)
		{
			$ordinal = ord($str[$i]);

			if ($ordinal < 128)
			{
				$out .= $str[$i];
			}
			else
			{
				if (count($temp) == 0)
				{
					$count = ($ordinal < 224) ? 2 : 3;
				}

				$temp[] = $ordinal;

				if (count($temp) == $count)
				{
					$number = ($count == 3) ? (($temp['0'] % 16) * 4096) + (($temp['1'] % 64) * 64) + ($temp['2'] % 64) : (($temp['0'] % 32) * 64) + ($temp['1'] % 64);

					$out .= '&#'.$number.';';
					$count = 1;
					$temp = array();
				}
			}
		}

		return $out;
	}

	function set_error($msg)
	{
		log_message('error', $msg);
		$this->error_msg[] = $msg;
	}

	function display_errors($open = '<p>', $close = '</p>')
	{
		$str = '';
		foreach ($this->error_msg as $val)
		{
			$str .= $open.$val.$close;
		}

		return $str;
	}

}
