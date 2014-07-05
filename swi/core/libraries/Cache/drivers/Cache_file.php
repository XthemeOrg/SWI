<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_Cache_file extends CI_Driver {

	protected $_cache_path;

	public function __construct()
	{
		$CI =& get_instance();
		$CI->load->helper('file');
		
		$path = $CI->config->item('cache_path');
	
		$this->_cache_path = ($path == '') ? APPPATH.'cache/' : $path;
	}

	public function get($id)
	{
		if ( ! file_exists($this->_cache_path.$id))
		{
			return FALSE;
		}
		
		$data = read_file($this->_cache_path.$id);
		$data = unserialize($data);
		
		if (time() >  $data['time'] + $data['ttl'])
		{
			unlink($this->_cache_path.$id);
			return FALSE;
		}
		
		return $data['data'];
	}

	public function save($id, $data, $ttl = 60)
	{		
		$contents = array(
				'time'		=> time(),
				'ttl'		=> $ttl,			
				'data'		=> $data
			);
		
		if (write_file($this->_cache_path.$id, serialize($contents)))
		{
			@chmod($this->_cache_path.$id, 0777);
			return TRUE;			
		}

		return FALSE;
	}

	public function delete($id)
	{
		return unlink($this->_cache_path.$id);
	}

	public function clean()
	{
		return delete_files($this->_cache_path);
	}

	public function cache_info($type = NULL)
	{
		return get_dir_file_info($this->_cache_path);
	}

	public function get_metadata($id)
	{
		if ( ! file_exists($this->_cache_path.$id))
		{
			return FALSE;
		}
		
		$data = read_file($this->_cache_path.$id);		
		$data = unserialize($data);
		
		if (is_array($data))
		{
			$data = $data['data'];
			$mtime = filemtime($this->_cache_path.$id);

			if ( ! isset($data['ttl']))
			{
				return FALSE;
			}

			return array(
				'expire' 	=> $mtime + $data['ttl'],
				'mtime'		=> $mtime
			);
		}
		
		return FALSE;
	}

	public function is_supported()
	{
		return is_really_writable($this->_cache_path);
	}

}
