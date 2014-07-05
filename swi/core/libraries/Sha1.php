<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_SHA1 {

	public function __construct()
	{
		log_message('debug', "SHA1 Class Initialized");
	}

	function generate($str)
	{
		$n = ((strlen($str) + 8) >> 6) + 1;

		for ($i = 0; $i < $n * 16; $i++)
		{
			$x[$i] = 0;
		}

		for ($i = 0; $i < strlen($str); $i++)
		{
			$x[$i >> 2] |= ord(substr($str, $i, 1)) << (24 - ($i % 4) * 8);
		}

		$x[$i >> 2] |= 0x80 << (24 - ($i % 4) * 8);

		$x[$n * 16 - 1] = strlen($str) * 8;

		$a =  1732584193;
		$b = -271733879;
		$c = -1732584194;
		$d =  271733878;
		$e = -1009589776;

		for ($i = 0; $i < count($x); $i += 16)
		{
			$olda = $a;
			$oldb = $b;
			$oldc = $c;
			$oldd = $d;
			$olde = $e;

			for ($j = 0; $j < 80; $j++)
			{
				if ($j < 16)
				{
					$w[$j] = $x[$i + $j];
				}
				else
				{
					$w[$j] = $this->_rol($w[$j - 3] ^ $w[$j - 8] ^ $w[$j - 14] ^ $w[$j - 16], 1);
				}

				$t = $this->_safe_add($this->_safe_add($this->_rol($a, 5), $this->_ft($j, $b, $c, $d)), $this->_safe_add($this->_safe_add($e, $w[$j]), $this->_kt($j)));

				$e = $d;
				$d = $c;
				$c = $this->_rol($b, 30);
				$b = $a;
				$a = $t;
			}

			$a = $this->_safe_add($a, $olda);
			$b = $this->_safe_add($b, $oldb);
			$c = $this->_safe_add($c, $oldc);
			$d = $this->_safe_add($d, $oldd);
			$e = $this->_safe_add($e, $olde);
		}

		return $this->_hex($a).$this->_hex($b).$this->_hex($c).$this->_hex($d).$this->_hex($e);
	}

	function _hex($str)
	{
		$str = dechex($str);

		if (strlen($str) == 7)
		{
			$str = '0'.$str;
		}

		return $str;
	}

	function _ft($t, $b, $c, $d)
	{
		if ($t < 20)
			return ($b & $c) | ((~$b) & $d);
		if ($t < 40)
			return $b ^ $c ^ $d;
		if ($t < 60)
			return ($b & $c) | ($b & $d) | ($c & $d);

		return $b ^ $c ^ $d;
	}

	function _kt($t)
	{
		if ($t < 20)
		{
			return 1518500249;
		}
		else if ($t < 40)
		{
			return 1859775393;
		}
		else if ($t < 60)
		{
			return -1894007588;
		}
		else
		{
			return -899497514;
		}
	}

	function _safe_add($x, $y)
	{
		$lsw = ($x & 0xFFFF) + ($y & 0xFFFF);
		$msw = ($x >> 16) + ($y >> 16) + ($lsw >> 16);

		return ($msw << 16) | ($lsw & 0xFFFF);
	}

	function _rol($num, $cnt)
	{
		return ($num << $cnt) | $this->_zero_fill($num, 32 - $cnt);
	}

	function _zero_fill($a, $b)
	{
		$bin = decbin($a);

		if (strlen($bin) < $b)
		{
			$bin = 0;
		}
		else
		{
			$bin = substr($bin, 0, strlen($bin) - $b);
		}

		for ($i=0; $i < $b; $i++)
		{
			$bin = "0".$bin;
		}

		return bindec($bin);
	}
}
