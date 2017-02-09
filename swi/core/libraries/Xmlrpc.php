<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('xml_parser_create'))
{
	show_error('Your PHP installation does not support XML');
}

class CI_Xmlrpc {

	var $debug			= FALSE;
	var $xmlrpcI4		= 'i4';
	var $xmlrpcInt		= 'int';
	var $xmlrpcBoolean	= 'boolean';
	var $xmlrpcDouble	= 'double';
	var $xmlrpcString	= 'string';
	var $xmlrpcDateTime	= 'dateTime.iso8601';
	var $xmlrpcBase64	= 'base64';
	var $xmlrpcArray	= 'array';
	var $xmlrpcStruct	= 'struct';

	var $xmlrpcTypes	= array();
	var $valid_parents	= array();
	var $xmlrpcerr		= array();
	var $xmlrpcstr		= array();

	var $xmlrpc_defencoding = 'UTF-8';
	var $xmlrpcName			= 'XML-RPC for CodeIgniter';
	var $xmlrpcVersion		= '1.1';
	var $xmlrpcerruser		= 800;
	var $xmlrpcerrxml		= 100;
	var $xmlrpc_backslash	= '';

	var $client;
	var $method;
	var $data;
	var $message			= '';
	var $error				= '';
	var $result;
	var $response			= array();

	var $xss_clean			= TRUE;

	public function __construct($config = array())
	{
		$this->xmlrpcName		= $this->xmlrpcName;
		$this->xmlrpc_backslash = chr(92).chr(92);

		$this->xmlrpcTypes = array(
			$this->xmlrpcI4	 		=> '1',
			$this->xmlrpcInt		=> '1',
			$this->xmlrpcBoolean	=> '1',
			$this->xmlrpcString		=> '1',
			$this->xmlrpcDouble		=> '1',
			$this->xmlrpcDateTime	=> '1',
			$this->xmlrpcBase64		=> '1',
			$this->xmlrpcArray		=> '2',
			$this->xmlrpcStruct		=> '3'
			);

		$this->valid_parents = array('BOOLEAN'			=> array('VALUE'),
									 'I4'				=> array('VALUE'),
									 'INT'				=> array('VALUE'),
									 'STRING'			=> array('VALUE'),
									 'DOUBLE'			=> array('VALUE'),
									 'DATETIME.ISO8601'	=> array('VALUE'),
									 'BASE64'			=> array('VALUE'),
									 'ARRAY'			=> array('VALUE'),
									 'STRUCT'			=> array('VALUE'),
									 'PARAM'			=> array('PARAMS'),
									 'METHODNAME'		=> array('METHODCALL'),
									 'PARAMS'			=> array('METHODCALL', 'METHODRESPONSE'),
									 'MEMBER'			=> array('STRUCT'),
									 'NAME'				=> array('MEMBER'),
									 'DATA'				=> array('ARRAY'),
									 'FAULT'			=> array('METHODRESPONSE'),
									 'VALUE'			=> array('MEMBER', 'DATA', 'PARAM', 'FAULT')
									 );


		$this->xmlrpcerr['unknown_method'] = '1';
		$this->xmlrpcstr['unknown_method'] = 'This is not a known method for this XML-RPC Server';
		$this->xmlrpcerr['invalid_return'] = '2';
		$this->xmlrpcstr['invalid_return'] = 'The XML data received was either invalid or not in the correct form for XML-RPC.  Turn on debugging to examine the XML data further.';
		$this->xmlrpcerr['incorrect_params'] = '3';
		$this->xmlrpcstr['incorrect_params'] = 'Incorrect parameters were passed to method';
		$this->xmlrpcerr['introspect_unknown'] = '4';
		$this->xmlrpcstr['introspect_unknown'] = "Cannot inspect signature for request: method unknown";
		$this->xmlrpcerr['http_error'] = '5';
		$this->xmlrpcstr['http_error'] = "Did not receive a '200 OK' response from remote server.";
		$this->xmlrpcerr['no_data'] = '6';
		$this->xmlrpcstr['no_data'] ='No data received from server.';

		$this->initialize($config);

		log_message('debug', "XML-RPC Class Initialized");
	}
	
	function initialize($config = array())
	{
		if (count($config) > 0)
		{
			foreach ($config as $key => $val)
			{
				if (isset($this->$key))
				{
					$this->$key = $val;
				}
			}
		}
	}

	function server($url, $port=80)
	{
		if (substr($url, 0, 4) != "http")
		{
			$url = "http://".$url;
		}

		$parts = parse_url($url);

		$path = ( ! isset($parts['path'])) ? '/' : $parts['path'];

		if (isset($parts['query']) && $parts['query'] != '')
		{
			$path .= '?'.$parts['query'];
		}

		$this->client = new XML_RPC_Client($path, $parts['host'], $port);
	}

	function timeout($seconds=5)
	{
		if ( ! is_null($this->client) && is_int($seconds))
		{
			$this->client->timeout = $seconds;
		}
	}

	function method($function)
	{
		$this->method = $function;
	}

	function request($incoming)
	{
		if ( ! is_array($incoming))
		{
			
		}

		$this->data = array();

		foreach ($incoming as $key => $value)
		{
			$this->data[$key] = $this->values_parsing($value);
		}
	}

	function set_debug($flag = TRUE)
	{
		$this->debug = ($flag == TRUE) ? TRUE : FALSE;
	}

	function values_parsing($value, $return = FALSE)
	{
		if (is_array($value) && array_key_exists(0, $value))
		{
			if ( ! isset($value['1']) OR ( ! isset($this->xmlrpcTypes[$value['1']])))
			{
				if (is_array($value[0]))
				{
					$temp = new XML_RPC_Values($value['0'], 'array');
				}
				else
				{
					$temp = new XML_RPC_Values($value['0'], 'string');
				}
			}
			elseif (is_array($value['0']) && ($value['1'] == 'struct' OR $value['1'] == 'array'))
			{
				while (list($k) = each($value['0']))
				{
					$value['0'][$k] = $this->values_parsing($value['0'][$k], TRUE);
				}

				$temp = new XML_RPC_Values($value['0'], $value['1']);
			}
			else
			{
				$temp = new XML_RPC_Values($value['0'], $value['1']);
			}
		}
		else
		{
			$temp = new XML_RPC_Values($value, 'string');
		}

		return $temp;
	}

	function send_request()
	{
		$this->message = new XML_RPC_Message($this->method,$this->data);
		$this->message->debug = $this->debug;

		if ( ! $this->result = $this->client->send($this->message))
		{
			$this->error = $this->result->errstr;
			return FALSE;
		}
		elseif ( ! is_object($this->result->val))
		{
			$this->error = $this->result->errstr;
			return FALSE;
		}

		$this->response = $this->result->decode();

		return TRUE;
	}

	function display_error()
	{
		return $this->error;
	}

	function display_response()
	{
		return $this->response;
	}

	function send_error_message($number, $message)
	{
		return new XML_RPC_Response('0',$number, $message);
	}

	function send_response($response)
	{
		$response = $this->values_parsing($response);

		return new XML_RPC_Response($response);
	}

}

class XML_RPC_Client extends CI_Xmlrpc
{
	var $path			= '';
	var $server			= '';
	var $port			= 80;
	var $errno			= '';
	var $errstring		= '';
	var $timeout		= 5;
	var $no_multicall	= FALSE;

	public function __construct($path, $server, $port=80)
	{
		parent::__construct();

		$this->port = $port;
		$this->server = $server;
		$this->path = $path;
	}

	function send($msg)
	{
		if (is_array($msg))
		{
			$r = new XML_RPC_Response(0, $this->xmlrpcerr['multicall_recursion'],$this->xmlrpcstr['multicall_recursion']);
			return $r;
		}

		return $this->sendPayload($msg);
	}

	function sendPayload($msg)
	{
		$fp = @fsockopen($this->server, $this->port,$this->errno, $this->errstr, $this->timeout);

		if ( ! is_resource($fp))
		{
			error_log($this->xmlrpcstr['http_error']);
			$r = new XML_RPC_Response(0, $this->xmlrpcerr['http_error'],$this->xmlrpcstr['http_error']);
			return $r;
		}

		if (empty($msg->payload))
		{
			$msg->createPayload();
		}

		$r = "\r\n";
		$op  = "POST {$this->path} HTTP/1.0$r";
		$op .= "Host: {$this->server}$r";
		$op .= "Content-Type: text/xml$r";
		$op .= "User-Agent: {$this->xmlrpcName}$r";
		$op .= "Content-Length: ".strlen($msg->payload). "$r$r";
		$op .= $msg->payload;


		if ( ! fputs($fp, $op, strlen($op)))
		{
			error_log($this->xmlrpcstr['http_error']);
			$r = new XML_RPC_Response(0, $this->xmlrpcerr['http_error'], $this->xmlrpcstr['http_error']);
			return $r;
		}
		$resp = $msg->parseResponse($fp);
		fclose($fp);
		return $resp;
	}

}

class XML_RPC_Response
{
	var $val = 0;
	var $errno = 0;
	var $errstr = '';
	var $headers = array();
	var $xss_clean = TRUE;

	public function __construct($val, $code = 0, $fstr = '')
	{
		if ($code != 0)
		{
			$this->errno = $code;
			$this->errstr = htmlentities($fstr);
		}
		else if ( ! is_object($val))
		{
			error_log("Invalid type '" . gettype($val) . "' (value: $val) passed to XML_RPC_Response.  Defaulting to empty value.");
			$this->val = new XML_RPC_Values();
		}
		else
		{
			$this->val = $val;
		}
	}

	function faultCode()
	{
		return $this->errno;
	}

	function faultString()
	{
		return $this->errstr;
	}

	function value()
	{
		return $this->val;
	}

	function prepare_response()
	{
		$result = "<methodResponse>\n";
		if ($this->errno)
		{
			$result .= '<fault>
	<value>
		<struct>
			<member>
				<name>faultCode</name>
				<value><int>' . $this->errno . '</int></value>
			</member>
			<member>
				<name>faultString</name>
				<value><string>' . $this->errstr . '</string></value>
			</member>
		</struct>
	</value>
</fault>';
		}
		else
		{
			$result .= "<params>\n<param>\n" .
					$this->val->serialize_class() .
					"</param>\n</params>";
		}
		$result .= "\n</methodResponse>";
		return $result;
	}

	function decode($array=FALSE)
	{
		$CI =& get_instance();
		
		if ($array !== FALSE && is_array($array))
		{
			while (list($key) = each($array))
			{
				if (is_array($array[$key]))
				{
					$array[$key] = $this->decode($array[$key]);
				}
				else
				{
					$array[$key] = ($this->xss_clean) ? $CI->security->xss_clean($array[$key]) : $array[$key];
				}
			}

			$result = $array;
		}
		else
		{
			$result = $this->xmlrpc_decoder($this->val);

			if (is_array($result))
			{
				$result = $this->decode($result);
			}
			else
			{
				$result = ($this->xss_clean) ? $CI->security->xss_clean($result) : $result;
			}
		}

		return $result;
	}
	
	function xmlrpc_decoder($xmlrpc_val)
	{
		$kind = $xmlrpc_val->kindOf();

		if ($kind == 'scalar')
		{
			return $xmlrpc_val->scalarval();
		}
		elseif ($kind == 'array')
		{
			reset($xmlrpc_val->me);
			list($a,$b) = each($xmlrpc_val->me);
			$size = count($b);

			$arr = array();

			for ($i = 0; $i < $size; $i++)
			{
				$arr[] = $this->xmlrpc_decoder($xmlrpc_val->me['array'][$i]);
			}
			return $arr;
		}
		elseif ($kind == 'struct')
		{
			reset($xmlrpc_val->me['struct']);
			$arr = array();

			while (list($key,$value) = each($xmlrpc_val->me['struct']))
			{
				$arr[$key] = $this->xmlrpc_decoder($value);
			}
			return $arr;
		}
	}

	function iso8601_decode($time, $utc=0)
	{
		$t = 0;
		if (preg_match('/([0-9]{4})([0-9]{2})([0-9]{2})T([0-9]{2}):([0-9]{2}):([0-9]{2})/', $time, $regs))
		{
			$fnc = ($utc == 1) ? 'gmmktime' : 'mktime';
			$t = $fnc($regs[4], $regs[5], $regs[6], $regs[2], $regs[3], $regs[1]);
		}
		return $t;
	}

}

class XML_RPC_Message extends CI_Xmlrpc
{
	var $payload;
	var $method_name;
	var $params			= array();
	var $xh				= array();

	public function __construct($method, $pars=0)
	{
		parent::__construct();

		$this->method_name = $method;
		if (is_array($pars) && count($pars) > 0)
		{
			for ($i=0; $i<count($pars); $i++)
			{
				$this->params[] = $pars[$i];
			}
		}
	}

	function createPayload()
	{
		$this->payload = "<?xml version=\"1.0\"?".">\r\n<methodCall>\r\n";
		$this->payload .= '<methodName>' . $this->method_name . "</methodName>\r\n";
		$this->payload .= "<params>\r\n";

		for ($i=0; $i<count($this->params); $i++)
		{
			$p = $this->params[$i];
			$this->payload .= "<param>\r\n".$p->serialize_class()."</param>\r\n";
		}

		$this->payload .= "</params>\r\n</methodCall>\r\n";
	}
	
	function parseResponse($fp)
	{
		$data = '';

		while ($datum = fread($fp, 4096))
		{
			$data .= $datum;
		}

		if ($this->debug === TRUE)
		{
			echo "<pre>";
			echo "---DATA---\n" . htmlspecialchars($data) . "\n---END DATA---\n\n";
			echo "</pre>";
		}

		if ($data == "")
		{
			error_log($this->xmlrpcstr['no_data']);
			$r = new XML_RPC_Response(0, $this->xmlrpcerr['no_data'], $this->xmlrpcstr['no_data']);
			return $r;
		}

		if (strncmp($data, 'HTTP', 4) == 0 && ! preg_match('/^HTTP\/[0-9\.]+ 200 /', $data))
		{
			$errstr= substr($data, 0, strpos($data, "\n")-1);
			$r = new XML_RPC_Response(0, $this->xmlrpcerr['http_error'], $this->xmlrpcstr['http_error']. ' (' . $errstr . ')');
			return $r;
		}

		(int)$parser = xml_parser_create($this->xmlrpc_defencoding);

		$this->xh[(int)(int)$parser]					= array();
		$this->xh[(int)(int)$parser]['isf']			= 0;
		$this->xh[(int)(int)$parser]['ac']			= '';
		$this->xh[(int)(int)$parser]['headers']		= array();
		$this->xh[(int)(int)$parser]['stack']			= array();
		$this->xh[(int)(int)$parser]['valuestack']	= array();
		$this->xh[(int)(int)$parser]['isf_reason']	= 0;

		xml_set_object($parser, $this);
		xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, true);
		xml_set_element_handler($parser, 'open_tag', 'closing_tag');
		xml_set_character_data_handler($parser, 'character_data');
		//xml_set_default_handler($parser, 'default_handler');

		$lines = explode("\r\n", $data);
		while (($line = array_shift($lines)))
		{
			if (strlen($line) < 1)
			{
				break;
			}
			$this->xh[(int)(int)$parser]['headers'][] = $line;
		}
		$data = implode("\r\n", $lines);

		if ( ! xml_parse($parser, $data, count($data)))
		{
			$errstr = sprintf('XML error: %s at line %d',
					xml_error_string(xml_get_error_code($parser)),
					xml_get_current_line_number($parser));
			//error_log($errstr);
			$r = new XML_RPC_Response(0, $this->xmlrpcerr['invalid_return'], $this->xmlrpcstr['invalid_return']);
			xml_parser_free($parser);
			return $r;
		}
		xml_parser_free($parser);

		if ($this->xh[(int)$parser]['isf'] > 1)
		{
			if ($this->debug === TRUE)
			{
				echo "---Invalid Return---\n";
				echo $this->xh[(int)$parser]['isf_reason'];
				echo "---Invalid Return---\n\n";
			}

			$r = new XML_RPC_Response(0, $this->xmlrpcerr['invalid_return'],$this->xmlrpcstr['invalid_return'].' '.$this->xh[(int)$parser]['isf_reason']);
			return $r;
		}
		elseif ( ! is_object($this->xh[(int)$parser]['value']))
		{
			$r = new XML_RPC_Response(0, $this->xmlrpcerr['invalid_return'],$this->xmlrpcstr['invalid_return'].' '.$this->xh[(int)$parser]['isf_reason']);
			return $r;
		}

		if ($this->debug === TRUE)
		{
			echo "<pre>";

			if (count($this->xh[(int)$parser]['headers'] > 0))
			{
				echo "---HEADERS---\n";
				foreach ($this->xh[(int)$parser]['headers'] as $header)
				{
					echo "$header\n";
				}
				echo "---END HEADERS---\n\n";
			}

			echo "---DATA---\n" . htmlspecialchars($data) . "\n---END DATA---\n\n";

			echo "---PARSED---\n" ;
			var_dump($this->xh[(int)$parser]['value']);
			echo "\n---END PARSED---</pre>";
		}

		$v = $this->xh[(int)$parser]['value'];

		if ($this->xh[(int)$parser]['isf'])
		{
			$errno_v = $v->me['struct']['faultCode'];
			$errstr_v = $v->me['struct']['faultString'];
			$errno = $errno_v->scalarval();

			if ($errno == 0)
			{
				$errno = -1;
			}

			$r = new XML_RPC_Response($v, $errno, $errstr_v->scalarval());
		}
		else
		{
			$r = new XML_RPC_Response($v);
		}

		$r->headers = $this->xh[(int)$parser]['headers'];
		return $r;
	}

	function open_tag($the_parser, $name, $attrs)
	{
		if ($this->xh[(int)(int)$the_parser]['isf'] > 1) return;

		if (count($this->xh[(int)(int)$the_parser]['stack']) == 0)
		{
			if ($name != 'METHODRESPONSE' && $name != 'METHODCALL')
			{
				$this->xh[(int)$the_parser]['isf'] = 2;
				$this->xh[(int)$the_parser]['isf_reason'] = 'Top level XML-RPC element is missing';
				return;
			}
		}
		else
		{
			if ( ! in_array($this->xh[(int)$the_parser]['stack'][0], $this->valid_parents[$name], TRUE))
			{
				$this->xh[(int)$the_parser]['isf'] = 2;
				$this->xh[(int)$the_parser]['isf_reason'] = "XML-RPC element $name cannot be child of ".$this->xh[(int)$the_parser]['stack'][0];
				return;
			}
		}

		switch($name)
		{
			case 'STRUCT':
			case 'ARRAY':

				$cur_val = array('value' => array(),
								 'type'	 => $name);

				array_unshift($this->xh[(int)$the_parser]['valuestack'], $cur_val);
			break;
			case 'METHODNAME':
			case 'NAME':
				$this->xh[(int)$the_parser]['ac'] = '';
			break;
			case 'FAULT':
				$this->xh[(int)$the_parser]['isf'] = 1;
			break;
			case 'PARAM':
				$this->xh[(int)$the_parser]['value'] = NULL;
			break;
			case 'VALUE':
				$this->xh[(int)$the_parser]['vt'] = 'value';
				$this->xh[(int)$the_parser]['ac'] = '';
				$this->xh[(int)$the_parser]['lv'] = 1;
			break;
			case 'I4':
			case 'INT':
			case 'STRING':
			case 'BOOLEAN':
			case 'DOUBLE':
			case 'DATETIME.ISO8601':
			case 'BASE64':
				if ($this->xh[(int)$the_parser]['vt'] != 'value')
				{
					$this->xh[(int)$the_parser]['isf'] = 2;
					$this->xh[(int)$the_parser]['isf_reason'] = "'Twas a $name element following a ".$this->xh[(int)$the_parser]['vt']." element inside a single value";
					return;
				}

				$this->xh[(int)$the_parser]['ac'] = '';
			break;
			case 'MEMBER':
				$this->xh[(int)$the_parser]['valuestack'][0]['name'] = '';

				$this->xh[(int)$the_parser]['value'] = NULL;
			break;
			case 'DATA':
			case 'METHODCALL':
			case 'METHODRESPONSE':
			case 'PARAMS':
				
			break;
			default:
				$this->xh[(int)$the_parser]['isf'] = 2;
				$this->xh[(int)$the_parser]['isf_reason'] = "Invalid XML-RPC element found: $name";
			break;
		}

		array_unshift($this->xh[(int)(int)$the_parser]['stack'], $name);

		if ($name != 'VALUE') $this->xh[(int)(int)$the_parser]['lv'] = 0;
	}
	
	function closing_tag($the_parser, $name)
	{
		if ($this->xh[(int)$the_parser]['isf'] > 1) return;

		$curr_elem = array_shift($this->xh[(int)$the_parser]['stack']);

		switch($name)
		{
			case 'STRUCT':
			case 'ARRAY':
				$cur_val = array_shift($this->xh[(int)$the_parser]['valuestack']);
				$this->xh[(int)$the_parser]['value'] = ( ! isset($cur_val['values'])) ? array() : $cur_val['values'];
				$this->xh[(int)$the_parser]['vt']	= strtolower($name);
			break;
			case 'NAME':
				$this->xh[(int)$the_parser]['valuestack'][0]['name'] = $this->xh[(int)$the_parser]['ac'];
			break;
			case 'BOOLEAN':
			case 'I4':
			case 'INT':
			case 'STRING':
			case 'DOUBLE':
			case 'DATETIME.ISO8601':
			case 'BASE64':
				$this->xh[(int)$the_parser]['vt'] = strtolower($name);

				if ($name == 'STRING')
				{
					$this->xh[(int)$the_parser]['value'] = $this->xh[(int)$the_parser]['ac'];
				}
				elseif ($name=='DATETIME.ISO8601')
				{
					$this->xh[(int)$the_parser]['vt']	= $this->xmlrpcDateTime;
					$this->xh[(int)$the_parser]['value'] = $this->xh[(int)$the_parser]['ac'];
				}
				elseif ($name=='BASE64')
				{
					$this->xh[(int)$the_parser]['value'] = base64_decode($this->xh[(int)$the_parser]['ac']);
				}
				elseif ($name=='BOOLEAN')
				{
					if ($this->xh[(int)$the_parser]['ac'] == '1')
					{
						$this->xh[(int)$the_parser]['value'] = TRUE;
					}
					else
					{
						$this->xh[(int)$the_parser]['value'] = FALSE;
					}
				}
				elseif ($name=='DOUBLE')
				{
					if ( ! preg_match('/^[+-]?[eE0-9\t \.]+$/', $this->xh[(int)$the_parser]['ac']))
					{
						$this->xh[(int)$the_parser]['value'] = 'ERROR_NON_NUMERIC_FOUND';
					}
					else
					{
						$this->xh[(int)$the_parser]['value'] = (double)$this->xh[(int)$the_parser]['ac'];
					}
				}
				else
				{
					if ( ! preg_match('/^[+-]?[0-9\t ]+$/', $this->xh[(int)$the_parser]['ac']))
					{
						$this->xh[(int)$the_parser]['value'] = 'ERROR_NON_NUMERIC_FOUND';
					}
					else
					{
						$this->xh[(int)$the_parser]['value'] = (int)$this->xh[(int)$the_parser]['ac'];
					}
				}
				$this->xh[(int)$the_parser]['ac'] = '';
				$this->xh[(int)$the_parser]['lv'] = 3;
			break;
			case 'VALUE':
				if ($this->xh[(int)$the_parser]['vt']=='value')
				{
					$this->xh[(int)$the_parser]['value']	= $this->xh[(int)$the_parser]['ac'];
					$this->xh[(int)$the_parser]['vt']	= $this->xmlrpcString;
				}

				$temp = new XML_RPC_Values($this->xh[(int)$the_parser]['value'], $this->xh[(int)$the_parser]['vt']);

				if (count($this->xh[(int)$the_parser]['valuestack']) && $this->xh[(int)$the_parser]['valuestack'][0]['type'] == 'ARRAY')
				{
					$this->xh[(int)$the_parser]['valuestack'][0]['values'][] = $temp;
				}
				else
				{
					$this->xh[(int)$the_parser]['value'] = $temp;
				}
			break;
			case 'MEMBER':
				$this->xh[(int)$the_parser]['ac']='';

				if ($this->xh[(int)$the_parser]['value'])
				{
					$this->xh[(int)$the_parser]['valuestack'][0]['values'][$this->xh[(int)$the_parser]['valuestack'][0]['name']] = $this->xh[(int)$the_parser]['value'];
				}
			break;
			case 'DATA':
				$this->xh[(int)$the_parser]['ac']='';
			break;
			case 'PARAM':
				if ($this->xh[(int)$the_parser]['value'])
				{
					$this->xh[(int)$the_parser]['params'][] = $this->xh[(int)$the_parser]['value'];
				}
			break;
			case 'METHODNAME':
				$this->xh[(int)$the_parser]['method'] = ltrim($this->xh[(int)$the_parser]['ac']);
			break;
			case 'PARAMS':
			case 'FAULT':
			case 'METHODCALL':
			case 'METHORESPONSE':
				
			break;
			default:
				
			break;
		}
	}

	function character_data($the_parser, $data)
	{
		if ($this->xh[(int)(int)$the_parser]['isf'] > 1) return;

		if ($this->xh[(int)(int)$the_parser]['lv'] != 3)
		{
			if ($this->xh[(int)(int)$the_parser]['lv'] == 1)
			{
				$this->xh[(int)(int)$the_parser]['lv'] = 2;
			}

			if ( ! @isset($this->xh[(int)(int)$the_parser]['ac']))
			{
				$this->xh[(int)(int)$the_parser]['ac'] = '';
			}

			$this->xh[(int)(int)$the_parser]['ac'] .= $data;
		}
	}


	function addParam($par) { $this->params[]=$par; }

	function output_parameters($array=FALSE)
	{
		$CI =& get_instance();
		
		if ($array !== FALSE && is_array($array))
		{
			while (list($key) = each($array))
			{
				if (is_array($array[$key]))
				{
					$array[$key] = $this->output_parameters($array[$key]);
				}
				else
				{
					$array[$key] = ($key == 'bits' OR $this->xss_clean == FALSE) ? $array[$key] : $CI->security->xss_clean($array[$key]);
				}
			}

			$parameters = $array;
		}
		else
		{
			$parameters = array();

			for ($i = 0; $i < count($this->params); $i++)
			{
				$a_param = $this->decode_message($this->params[$i]);

				if (is_array($a_param))
				{
					$parameters[] = $this->output_parameters($a_param);
				}
				else
				{
					$parameters[] = ($this->xss_clean) ? $CI->security->xss_clean($a_param) : $a_param;
				}
			}
		}

		return $parameters;
	}


	function decode_message($param)
	{
		$kind = $param->kindOf();

		if ($kind == 'scalar')
		{
			return $param->scalarval();
		}
		elseif ($kind == 'array')
		{
			reset($param->me);
			list($a,$b) = each($param->me);

			$arr = array();

			for($i = 0; $i < count($b); $i++)
			{
				$arr[] = $this->decode_message($param->me['array'][$i]);
			}

			return $arr;
		}
		elseif ($kind == 'struct')
		{
			reset($param->me['struct']);

			$arr = array();

			while (list($key,$value) = each($param->me['struct']))
			{
				$arr[$key] = $this->decode_message($value);
			}

			return $arr;
		}
	}

}

class XML_RPC_Values extends CI_Xmlrpc
{
	var $me		= array();
	var $mytype	= 0;

	public function __construct($val=-1, $type='')
	{
		parent::__construct();

		if ($val != -1 OR $type != '')
		{
			$type = $type == '' ? 'string' : $type;

			if ($this->xmlrpcTypes[$type] == 1)
			{
				$this->addScalar($val,$type);
			}
			elseif ($this->xmlrpcTypes[$type] == 2)
			{
				$this->addArray($val);
			}
			elseif ($this->xmlrpcTypes[$type] == 3)
			{
				$this->addStruct($val);
			}
		}
	}

	function addScalar($val, $type='string')
	{
		$typeof = $this->xmlrpcTypes[$type];

		if ($this->mytype==1)
		{
			echo '<strong>XML_RPC_Values</strong>: scalar can have only one value<br />';
			return 0;
		}

		if ($typeof != 1)
		{
			echo '<strong>XML_RPC_Values</strong>: not a scalar type (${typeof})<br />';
			return 0;
		}

		if ($type == $this->xmlrpcBoolean)
		{
			if (strcasecmp($val,'true')==0 OR $val==1 OR ($val==true && strcasecmp($val,'false')))
			{
				$val = 1;
			}
			else
			{
				$val=0;
			}
		}

		if ($this->mytype == 2)
		{
			$ar = $this->me['array'];
			$ar[] = new XML_RPC_Values($val, $type);
			$this->me['array'] = $ar;
		}
		else
		{
			$this->me[$type] = $val;
			$this->mytype = $typeof;
		}
		return 1;
	}

	function addArray($vals)
	{
		if ($this->mytype != 0)
		{
			echo '<strong>XML_RPC_Values</strong>: already initialized as a [' . $this->kindOf() . ']<br />';
			return 0;
		}

		$this->mytype = $this->xmlrpcTypes['array'];
		$this->me['array'] = $vals;
		return 1;
	}

	function addStruct($vals)
	{
		if ($this->mytype != 0)
		{
			echo '<strong>XML_RPC_Values</strong>: already initialized as a [' . $this->kindOf() . ']<br />';
			return 0;
		}
		$this->mytype = $this->xmlrpcTypes['struct'];
		$this->me['struct'] = $vals;
		return 1;
	}

	function kindOf()
	{
		switch($this->mytype)
		{
			case 3:
				return 'struct';
				break;
			case 2:
				return 'array';
				break;
			case 1:
				return 'scalar';
				break;
			default:
				return 'undef';
		}
	}

	function serializedata($typ, $val)
	{
		$rs = '';

		switch($this->xmlrpcTypes[$typ])
		{
			case 3:
				$rs .= "<struct>\n";
				reset($val);
				while (list($key2, $val2) = each($val))
				{
					$rs .= "<member>\n<name>{$key2}</name>\n";
					$rs .= $this->serializeval($val2);
					$rs .= "</member>\n";
				}
				$rs .= '</struct>';
			break;
			case 2:
				$rs .= "<array>\n<data>\n";
				for($i=0; $i < count($val); $i++)
				{
					$rs .= $this->serializeval($val[$i]);
				}
				$rs.="</data>\n</array>\n";
				break;
			case 1:
				switch ($typ)
				{
					case $this->xmlrpcBase64:
						$rs .= "<{$typ}>" . base64_encode((string)$val) . "</{$typ}>\n";
					break;
					case $this->xmlrpcBoolean:
						$rs .= "<{$typ}>" . ((bool)$val ? '1' : '0') . "</{$typ}>\n";
					break;
					case $this->xmlrpcString:
						$rs .= "<{$typ}>" . htmlspecialchars((string)$val). "</{$typ}>\n";
					break;
					default:
						$rs .= "<{$typ}>{$val}</{$typ}>\n";
					break;
				}
			default:
			break;
		}
		return $rs;
	}

	function serialize_class()
	{
		return $this->serializeval($this);
	}

	function serializeval($o)
	{
		$ar = $o->me;
		reset($ar);

		list($typ, $val) = each($ar);
		$rs = "<value>\n".$this->serializedata($typ, $val)."</value>\n";
		return $rs;
	}

	function scalarval()
	{
		reset($this->me);
		list($a,$b) = each($this->me);
		return $b;
	}


	function iso8601_encode($time, $utc=0)
	{
		if ($utc == 1)
		{
			$t = strftime("%Y%m%dT%H:%i:%s", $time);
		}
		else
		{
			if (function_exists('gmstrftime'))
				$t = gmstrftime("%Y%m%dT%H:%i:%s", $time);
			else
				$t = strftime("%Y%m%dT%H:%i:%s", $time - date('Z'));
		}
		return $t;
	}

}
