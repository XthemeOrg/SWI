<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	define('CI_VERSION', '2.1.0');
	define('CI_CORE', FALSE);

	require(BASEPATH.'core/Common.php');

	if (defined('ENVIRONMENT') AND file_exists(APPPATH.'config/'.ENVIRONMENT.'/constants.php'))
	{
		require(APPPATH.'config/'.ENVIRONMENT.'/constants.php');
	}
	else
	{
		require(APPPATH.'config/constants.php');
	}

	set_error_handler('_exception_handler');

	if ( ! is_php('5.3'))
	{
		@set_magic_quotes_runtime(0);
	}

	if (isset($assign_to_config['subclass_prefix']) AND $assign_to_config['subclass_prefix'] != '')
	{
		get_config(array('subclass_prefix' => $assign_to_config['subclass_prefix']));
	}

	if (function_exists("set_time_limit") == TRUE AND @ini_get("safe_mode") == 0)
	{
		@set_time_limit(300);
	}

	$BM =& load_class('Benchmark', 'core');
	$BM->mark('total_execution_time_start');
	$BM->mark('loading_time:_base_classes_start');

	$EXT =& load_class('Hooks', 'core');
	$EXT->_call_hook('pre_system');

	$CFG =& load_class('Config', 'core');

	if (isset($assign_to_config))
	{
		$CFG->_assign_to_config($assign_to_config);
	}

	$UNI =& load_class('Utf8', 'core');

	$URI =& load_class('URI', 'core');

	$RTR =& load_class('Router', 'core');
	$RTR->_set_routing();

	if (isset($routing))
	{
		$RTR->_set_overrides($routing);
	}

	$OUT =& load_class('Output', 'core');

	if ($EXT->_call_hook('cache_override') === FALSE)
	{
		if ($OUT->_display_cache($CFG, $URI) == TRUE)
		{
			exit;
		}
	}
	
	$SEC =& load_class('Security', 'core');

	$IN	=& load_class('Input', 'core');

	$LANG =& load_class('Lang', 'core');

	require BASEPATH.'core/Controller.php';

	function &get_instance()
	{
		return CI_Controller::get_instance();
	}


	if (file_exists(APPPATH.'core/'.$CFG->config['subclass_prefix'].'Controller.php'))
	{
		require APPPATH.'core/'.$CFG->config['subclass_prefix'].'Controller.php';
	}

	if ( ! file_exists(APPPATH.'controllers/'.$RTR->fetch_directory().$RTR->fetch_class().'.php'))
	{
		show_error('Unable to load your default controller. Please make sure the controller specified in your Routes.php file is valid.');
	}

	include(APPPATH.'controllers/'.$RTR->fetch_directory().$RTR->fetch_class().'.php');

	$BM->mark('loading_time:_base_classes_end');

	$class  = $RTR->fetch_class();
	$method = $RTR->fetch_method();

	if ( ! class_exists($class)
		OR strncmp($method, '_', 1) == 0
		OR in_array(strtolower($method), array_map('strtolower', get_class_methods('CI_Controller')))
		)
	{
		if ( ! empty($RTR->routes['404_override']))
		{
			$x = explode('/', $RTR->routes['404_override']);
			$class = $x[0];
			$method = (isset($x[1]) ? $x[1] : 'index');
			if ( ! class_exists($class))
			{
				if ( ! file_exists(APPPATH.'controllers/'.$class.'.php'))
				{
					show_404("{$class}/{$method}");
				}

				include_once(APPPATH.'controllers/'.$class.'.php');
			}
		}
		else
		{
			show_404("{$class}/{$method}");
		}
	}

	$EXT->_call_hook('pre_controller');

	$BM->mark('controller_execution_time_( '.$class.' / '.$method.' )_start');

	$CI = new $class();

	$EXT->_call_hook('post_controller_constructor');

	if (method_exists($CI, '_remap'))
	{
		$CI->_remap($method, array_slice($URI->rsegments, 2));
	}
	else
	{
		if ( ! in_array(strtolower($method), array_map('strtolower', get_class_methods($CI))))
		{
			if ( ! empty($RTR->routes['404_override']))
			{
				$x = explode('/', $RTR->routes['404_override']);
				$class = $x[0];
				$method = (isset($x[1]) ? $x[1] : 'index');
				if ( ! class_exists($class))
				{
					if ( ! file_exists(APPPATH.'controllers/'.$class.'.php'))
					{
						show_404("{$class}/{$method}");
					}

					include_once(APPPATH.'controllers/'.$class.'.php');
					unset($CI);
					$CI = new $class();
				}
			}
			else
			{
				show_404("{$class}/{$method}");
			}
		}

		call_user_func_array(array(&$CI, $method), array_slice($URI->rsegments, 2));
	}

	$BM->mark('controller_execution_time_( '.$class.' / '.$method.' )_end');
	$EXT->_call_hook('post_controller');

	if ($EXT->_call_hook('display_override') === FALSE)
	{
		$OUT->_display();
	}

	$EXT->_call_hook('post_system');

	if (class_exists('CI_DB') AND isset($CI->db))
	{
		$CI->db->close();
	}
