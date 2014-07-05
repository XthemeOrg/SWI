<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_Cache_apc extends CI_Driver {

	public function get($id)
	{
		$data = apc_fetch($id);

		return (is_array($data)) ? $data[0] : FALSE;
	}

	public function save($id, $data, $ttl = 60)
	{
		return apc_store($id, array($data, time(), $ttl), $ttl);
	}

	public function delete($id)
	{
		return apc_delete($id);
	}

	public function clean()
	{
		return apc_clear_cache('user');
	}

	 public function cache_info($type = NULL)
	 {
		 return apc_cache_info($type);
	 }

	public function get_metadata($id)
	{
		$stored = apc_fetch($id);

		if (count($stored) !== 3)
		{
			return FALSE;
		}

		list($data, $time, $ttl) = $stored;

		return array(
			'expire'	=> $time + $ttl,
			'mtime'		=> $time,
			'data'		=> $data
		);
	}

	public function is_supported()
	{
		if ( ! extension_loaded('apc') OR ini_get('apc.enabled') != "1")
		{
			log_message('error', 'The APC PHP extension must be loaded to use APC Cache.');
			return FALSE;
		}
		
		return TRUE;
	}
	
}
