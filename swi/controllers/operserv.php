<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/****************************************************************/
/* SWI3 Inferface by siniStar @ IRC4Fun                         */
/*                                                              */
/* author: 	Austin (siniStar)                                   */
/* web:		http://sinistar7boy.github.io/SWI/					*/
/* email: 	siniStar [at] IRC4Fun [dot] net                     */
/* irc: 	irc.IRC4Fun.net                                     */
/* version: 3.2.7                                               */
/****************************************************************/


/**
 * Operserv Controller
 * 
 */
class Operserv extends CI_Controller {

	
	//========================================================
	// PRIVATE VARS
	//========================================================
	
	
	//========================================================
	// PUBLIC VARS
	//========================================================
	
	
	//========================================================
	// PUBLIC FUNCTIONS
	//========================================================
	
	
	/**
	 * Construct
	 *
	 */
	public function __construct()
	{
		parent::__construct();
		
		if (!$this->session->userdata('is_authed'))
			redirect('main');
	}
	// --------------------------------------------------------
	
	
	/**
	 * Index Page
	 * Page displays some basic user info on the given nickname
	 */
	public function index()
	{
		// page data		
		$page_data = array();
		
		// setup rules for a global message
		if ($this->input->post('global_message'))
			$this->form_validation->set_rules('g_msg', 'Global Message', 'required');
		
		// setup rules for clearing a channel
		if ($this->input->post('clear_channel'))
			$this->form_validation->set_rules('channel', 'Channel', 'required|callback__valid_channel');

		// did the user submit
		if ($this->form_validation->run())
		{
			// are we sending a global message?
			if ($this->input->post('global_message'))
				$callback = $this->operserv_model->send_global($this->input->post('g_msg'));

			// are we clearing a channel?
			if ($this->input->post('clear_channel'))
				$callback = $this->operserv_model->clear_channel($this->input->post('clear_action'), $this->input->post('channel'), $this->input->post('clear_reason'));
			
			// auth valid session
			if (!$this->atheme->valid_authcookie($callback))
				redirect('main/logout');

			// auth access check
			if (!$this->operserv_model->check_access())
				redirect('main');

            // atheme response
            $page_data['success'] = $callback['response'];
			$page_data['msg'] = $callback['data'];
		}

		// get user opserserv specs
		$callback = $this->operserv_model->specs();

		// auth valid session
		if (!$this->atheme->valid_authcookie($callback))
			redirect('main/logout');
			
		// auth access check
		if (!$this->operserv_model->check_access())
			redirect('main/nac');

		$page_data['specs'] = $this->fout->as_array($callback['data']);

		// load the main view
		$this->load->view('operserv/main', $page_data);
	}
	// --------------------------------------------------------

	/**
	 * Waiting Page
	 * Page displays list of channels waiting to be reviewed
	 */
	public function waiting()
	{
		// page data		
		$page_data = array();

		// get waiting channels
		$callback = $this->operserv_model->check_cs_waiting();
		
		// auth access check
		if (!$this->operserv_model->check_access())
			redirect('main/nac');


			$page_data['response'] = $callback['data'];

		// load the main view
		$this->load->view('operserv/waiting', $page_data);
		
		// set form rules for xop management
		if ($this->input->post('set_review'))
		{
			$this->form_validation->set_rules('rev_decision', 'ACTIVATE or REJECT', 'required');
			$this->form_validation->set_rules('rev_channel', 'Channel', 'required');
		}

		// did the user submit?
		if ($this->form_validation->run())
		{

			if (!$this->atheme->valid_authcookie($callback))
				redirect('main/logout');
				
		// auth access check
		if (!$this->operserv_model->check_access())
			redirect('main/nac');

			// are we managing our WAITING list
			if ($this->input->post('set_review'))
			{
				$callback = $this->operserv_model->channel_review($this->input->post('rev_decision'), $this->input->post('rev_channel'));
				
				// atheme response
	            $page_data['success'] = $callback['response'];
				$page_data['response2'] = $callback['data'];
			}


			
		}
	}
	// --------------------------------------------------------
	
	/**
	 * Waiting Page
	 * Page displays list of channels waiting to be reviewed
	 */
	public function hswaiting()
	{
		// page data		
		$page_data = array();

		// get waiting channels
		$callback = $this->operserv_model->check_hs_waiting();
		
		// auth access check
		if (!$this->operserv_model->check_access())
			redirect('main/nac');


			$page_data['response'] = $callback['data'];

		// load the main view
		$this->load->view('operserv/hswaiting', $page_data);
		
		// set form rules for xop management
		if ($this->input->post('set_review'))
		{
			$this->form_validation->set_rules('rev_decision', 'ACTIVATE or REJECT', 'required');
			$this->form_validation->set_rules('rev_nick', 'Nickname', 'required');
		}

		// did the user submit?
		if ($this->form_validation->run())
		{

			if (!$this->atheme->valid_authcookie($callback))
				redirect('main/logout');
				
		// auth access check
		if (!$this->operserv_model->check_access())
			redirect('main/nac');

			// are we managing our WAITING list
			if ($this->input->post('set_review'))
			{
				$callback = $this->operserv_model->vhost_review($this->input->post('rev_decision'), $this->input->post('rev_nick'));
				
				// atheme response
	            $page_data['success'] = $callback['response'];
				$page_data['response2'] = $callback['data'];
			}


			
		}
	}
	// --------------------------------------------------------


	
	/**
	 * AKill Page
	 * Page controls all the akill stuff
	 */
	public function akill()
	{
		// page data
		$page_data = array();
		
			// auth access check
		if (!$this->operserv_model->check_access())
			redirect('main/nac');

		// form validation rules for adding an akill
		if ($this->input->post('add_akill'))
		{
			$this->form_validation->set_rules('nick_host', 'Nickname or Hostmask', 'requried');
			$this->form_validation->set_rules('akill_type', 'Type of AKill', 'required');
		}

		// form validation rules for deleting an akill
		if ($this->input->post('del_akill'))
		{
			$this->form_validation->set_rules('akill_id', 'AKill ID', 'required');
		}

		// did the user submit?
		if ($this->form_validation->run())
		{
			// adding an akill
			if ($this->input->post('add_akill'))
				$callback = $this->operserv_model->akill_add($this->input->post('nick_host'), $this->input->post('akill_type'), $this->input->post('duration'), $this->input->post('reason'));

			// deleting an akill
			if ($this->input->post('del_akill'))
				$callback = $this->operserv_model->akill_del($this->input->post('akill_id'));

			// auth valid session
			if (!$this->atheme->valid_authcookie($callback))
				redirect('main/logout');

            // atheme response
            $page_data['success'] = $callback['response'];
			$page_data['msg'] = $callback['data'];
		}

		// get currently akill list
		$callback = $this->operserv_model->akill_list();

		// auth check
		if (!$this->atheme->valid_authcookie($callback))
			redirect('main/logout');

		if ($callback['response'])
			$page_data['info'] = $this->fout->as_akills($this->fout->as_array($callback['data']));

		$this->load->view('operserv/akill', $page_data);
	}
	// --------------------------------------------------------

	/**
	 * Uworld X-WAITING REVIEW Page
	 * Page allows users to manage channel flags via the XOP system, this page will only
	 * be display if $config['atheme_xop'] is set to TRUE.
	 * 
	 */
	public function waiting_review()
	{
		$page_data = array();

		// set form rules for xop management
		if ($this->input->post('set_review'))
		{
			$this->form_validation->set_rules('rev_decision', 'ACTIVATE or REJECT', 'required');
			$this->form_validation->set_rules('rev_channel', 'Channel', 'required');
		}

		// did the user submit?
		if ($this->form_validation->run())
		{

			// are we managing our WAITING list
			if ($this->input->post('set_review'))
			{
				$callback = $this->operserv_model->channel_review($this->input->post('rev_decision'), $this->input->post('rev_channel'));
				
				// atheme response
	            $page_data['success'] = $callback['response'];
				$page_data['msg'] = $callback['data'];
			}

			if (!$this->atheme->valid_authcookie($callback))
				redirect('main/logout');
		}


		$this->load->view('operserv/waiting', $page_data);
	}
	// --------------------------------------------------------

	/**
	 * Modules Page
	 * Page deals with all the module stuff, loading, unloading etc...
	 */
	public function modules()
	{
		// page data
		$page_data = array();
		
				// auth access check
		if (!$this->operserv_model->check_access())
			redirect('main/nac');

		// validation rules for loading a module
		if ($this->input->post('load_module'))
			$this->form_validation->set_rules('module_name', 'Module Name', 'required');

		// validation rules for unloading a module
		if ($this->input->post('unload_module'))
			$this->form_validation->set_rules('module_name', 'Module Name', 'required');

		// did the user submit?
		if ($this->form_validation->run())
		{
			// are we loading a module?
			if ($this->input->post('load_module'))
				$callback = $this->operserv_model->module_load($this->input->post('module_name'));

			// are we unloading a module?
			if ($this->input->post('unload_module'))
				$callback = $this->operserv_model->module_unload($this->input->post('module_name'));

			// auth check
			if (!$this->atheme->valid_authcookie($callback))
				redirect('main/logout');

			// atheme response
			$page_data['success'] =  $page_data['info'] = $callback['response'];
			$page_data['msg'] = $callback['data'];
		}

		// get modules list
		$callback = $this->operserv_model->module_list();
		
		// auth check
		if (!$this->atheme->valid_authcookie($callback))
			redirect('main/logout');

		// clean modules list for options list
		$page_data['modules'] = $this->fout->as_modules($this->fout->as_array($callback['data']));

		// load the main view
		$this->load->view('operserv/modules', $page_data);
	}
	// --------------------------------------------------------
	

	/**
	 * Soper Page
	 * Page deals with all opserserv soper stuff
	 */
	public function soper()
	{
		// page data
		$page_data = array();
		
				// auth access check
		if (!$this->operserv_model->check_access())
			redirect('main/nac');

		// validation rules for adding a soper
		if ($this->input->post('add_soper'))
		{
			$this->form_validation->set_rules('soper_name', 'Soper Name', 'required');
			$this->form_validation->set_rules('soper_class', 'Soper Class', 'required');
		}

		// validation rules for removing soper
		if ($this->input->post('del_soper'))
			$this->form_validation->set_rules('soper_name', 'Soper Name', 'required');

		// did the user submit
		if ($this->form_validation->run())
		{
			// are we adding a soper?
			if ($this->input->post('add_soper'))
				$callback = $this->operserv_model->soper_add($this->input->post('soper_name'), $this->input->post('soper_class'));

			// are we removing a soper
			if ($this->input->post('del_soper'))
				$callback = $this->operserv_model->soper_del($this->input->post('soper_name'));

			// auth check
			if (!$this->atheme->valid_authcookie($callback))
				redirect('main/logout');

			// atheme response
			$page_data['success'] =  $page_data['info'] = $callback['response'];
			$page_data['msg'] = $callback['data'];
		}

		// get soper list
		$callback = $this->operserv_model->soper_list();

		// auth check
		if (!$this->atheme->valid_authcookie($callback))
			redirect('main/logout');

		// clean modules list for options list
		$page_data['sopers'] = $this->fout->as_sopers( $this->fout->as_array($callback['data']) );

		// load view
		$this->load->view('operserv/soper', $page_data);
	}
	// --------------------------------------------------------


	/**
	 * Rehash Page 
	 * Page will rehash Atheme Services
	 */
	public function rehash()
	{
		// page data
		$page_data = array();
		
				// auth access check
		if (!$this->operserv_model->check_access())
			redirect('main/nac');

		// validation rules
		$this->form_validation->set_rules('rehash_check', 'Rehash Confirm', 'required|callback__rehash_confirm');

		if ($this->form_validation->run())
		{
			// issue rehash command
			$callback = $this->operserv_model->rehash();

			// auth check
			if (!$this->atheme->valid_authcookie($callback))
				redirect('main/logout');

			// atheme response
			$page_data['success'] =  $page_data['info'] = $callback['response'];
			$page_data['msg'] = $callback['data'];
		}

		// load the main view
		$this->load->view('operserv/rehash', $page_data);
	}
	// --------------------------------------------------------


	/**
	 * Hash Page
	 * This page allows users to generate password hashes for user with Atheme
	 */
	public function hash()
	{
		$page_data = array();
		
				// auth access check
		if (!$this->operserv_model->check_access())
			redirect('main/nac');

		// form validation rules
		$this->form_validation->set_rules('password', 'Password', 'required');

		// did the user submit?
		if ($this->form_validation->run())
		{
			// hash the password using POSIX crypt(3)
			if ($this->input->post('enc_type') === "CRYPT")
			{
				$salt = $this->gen_salt();
				$page_data['hash'] = '$1$' . $salt . '$' . crypt($this->input->post('password'), $salt);
			}

			// hash the password using MD5
			if ($this->input->post('enc_type') === "MD5")
				$page_data['hash'] = '$rawmd5$' . md5($this->input->post('password'));

			// hash the password using SHA1
			if ($this->input->post('enc_type') === "SHA1")
				$page_data['hash'] = '$rawsha1$' . sha1($this->input->post('password'));
		}

		
		$this->load->view('operserv/hash', $page_data);
	}
	// --------------------------------------------------------

	
	//========================================================
	// CALLBACK FUNCTIONS
	//========================================================
	

	/**
	 * _rehash_confirm()
	 * function will make sure the user enters "YES" into the confirm box
	 * 
	 * @param string $str 	- the string to confirm as a "YES"
	 */
	public function _rehash_confirm($str)
	{
		if ($str === "YES")
			return TRUE;

		$this->form_validation->set_message('_rehash_confirm', 'You must confirm a rehash by entering "YES" into the %s field.');
		return FALSE;
	}


	/**
	 * _valid_channel
	 * Function checks to see if a passed channel name needs a # prepended to it or not.
	 *
	 * @access public
	 * @param string $str - string of a channel name
	 * @return $str with pre-peneded #
	 *
	 */
	public function _valid_channel($str)
	{
		if (substr($str, 0, 1) != '#')
			return $str = "#" . $str;
	}

	
	//========================================================
	// PRIVATE FUNCTIONS
	//========================================================


	/**
	 * gen_salt()
	 * function will generate a random string to be used as a salt
	 * 
	 * @param int $len 	- length of the random string (default 8)
	 * @return random string
	 */
	private function gen_salt($len = 8)
	{
		$allowable_chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$salt = "";

		for ($x = 0; $x < $len; $x++)
			$salt .= $allowable_chars[rand(0, strlen($allowable_chars) - 1)];

		return $salt;
	}

	public function waitinglists()
	{
		$page_data = array();
		$this->load->view('operserv/waitinglists', $page_data);		
	}


}
