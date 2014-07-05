<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_Cache extends CI_Driver_Library {
	
	protected $valid_drivers 	= array(
		'cache_apc', 'cache_file', 'cache_memcached', 'cache_dummy'
	);

	protected $_cache_path		= NULL;
	protected $_adapter			= 'dummy';
	protected $_backup_driver;

	public function __construct($config = array())
	{
		if ( ! empty($config))
		{
			$this->_initialize($config);
		}
	}

	public function get($id)
	{	
		return $this->{$this->_adapter}->get($id);
	}

	public function save($id, $data, $ttl = 60)
	{
		return $this->{$this->_adapter}->save($id, $data, $ttl);
	}

	public function delete($id)
	{
		return $this->{$this->_adapter}->delete($id);
	}

	public function clean()
	{
		return $this->{$this->_adapter}->clean();
	}

	public function cache_info($type = 'user')
	{
		return $this->{$this->_adapter}->cache_info($type);
	}

	public function get_metadata($id)
	{
		return $this->{$this->_adapter}->get_metadata($id);
	}
	
	private function _initialize($config)
	{        
		$default_config = array(
				'adapter',
				'memcached'
			);

		foreach ($default_config as $key)
		{
			if (isset($config[$key]))
			{
				$param = '_'.$key;

				$this->{$param} = $config[$key];
			}
		}

		if (isset($config['backup']))
		{
			if (in_array('cache_'.$config['backup'], $this->valid_drivers))
			{
				$this->_backup_driver = $config['backup'];
			}
		}
	}

	public function is_supported($driver)
	{
		static $support = array();

		if ( ! isset($support[$driver]))
		{
			$support[$driver] = $this->{$driver}->is_supported();
		}

		return $support[$driver];
	}

	public function __get($child)
	{
		$obj = parent::__get($child);

		if ( ! $this->is_supported($child))
		{
			$this->_adapter = $this->_backup_driver;
		}

		return $obj;
	}
	
}
