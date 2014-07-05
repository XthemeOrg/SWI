<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_Cache_memcached extends CI_Driver {

	private $_memcached;

	protected $_memcache_conf 	= array(
					'default' => array(
						'default_host'		=> '127.0.0.1',
						'default_port'		=> 11211,
						'default_weight'	=> 1
					)
				);

	public function get($id)
	{	
		$data = $this->_memcached->get($id);
		
		return (is_array($data)) ? $data[0] : FALSE;
	}

	public function save($id, $data, $ttl = 60)
	{
		if (get_class($this->_memcached) == 'Memcached')
		{
			return $this->_memcached->set($id, array($data, time(), $ttl), $ttl);
		}
		else if (get_class($this->_memcached) == 'Memcache')
		{
			return $this->_memcached->set($id, array($data, time(), $ttl), 0, $ttl);
		}
		
		return FALSE;
	}

	public function delete($id)
	{
		return $this->_memcached->delete($id);
	}

	public function clean()
	{
		return $this->_memcached->flush();
	}

	public function cache_info($type = NULL)
	{
		return $this->_memcached->getStats();
	}

	public function get_metadata($id)
	{
		$stored = $this->_memcached->get($id);

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

	private function _setup_memcached()
	{
		$CI =& get_instance();
		if ($CI->config->load('memcached', TRUE, TRUE))
		{
			if (is_array($CI->config->config['memcached']))
			{
				$this->_memcache_conf = NULL;

				foreach ($CI->config->config['memcached'] as $name => $conf)
				{
					$this->_memcache_conf[$name] = $conf;
				}				
			}			
		}
		
		$this->_memcached = new Memcached();

		foreach ($this->_memcache_conf as $name => $cache_server)
		{
			if ( ! array_key_exists('hostname', $cache_server))
			{
				$cache_server['hostname'] = $this->_default_options['default_host'];
			}
	
			if ( ! array_key_exists('port', $cache_server))
			{
				$cache_server['port'] = $this->_default_options['default_port'];
			}
	
			if ( ! array_key_exists('weight', $cache_server))
			{
				$cache_server['weight'] = $this->_default_options['default_weight'];
			}
	
			$this->_memcached->addServer(
					$cache_server['hostname'], $cache_server['port'], $cache_server['weight']
			);
		}
	}

	public function is_supported()
	{
		if ( ! extension_loaded('memcached'))
		{
			log_message('error', 'The Memcached Extension must be loaded to use Memcached Cache.');
			
			return FALSE;
		}
		
		$this->_setup_memcached();
		return TRUE;
	}

}
