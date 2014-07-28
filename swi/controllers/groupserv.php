<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/****************************************************************/
/* SWI3 Inferface by siniStar @ IRC4Fun                         */
/*                                                              */
/* author: 	Austin (siniStar)                                   */
/* web:		http://irc4fun.github.io/SWI/						*/
/* email: 	siniStar [at] IRC4Fun [dot] net                     */
/* irc: 	irc.IRC4Fun.net                                     */
/****************************************************************/


/**
 * Groupserv Controller
 * 
 */
class Groupserv extends CI_Controller {
	
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
	 * Constructor
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
	 *
	 */
	public function index()
	{
		// durp?
	}
	// --------------------------------------------------------
	
	
	/**
	 * Groupserv LISTGROUPS Page
	 * Page displayes list of Groups that account is subscribed to.
	 *
	 */
	public function listgroups()
	{
		$page_data = array();
		
		$callback = $this->groupserv_model->gs_listgroups();
			
		if (!$this->atheme->valid_authcookie($callback))
			redirect('main/logout');
			
		$page_data['response'] = $callback['data'];
		
		$this->load->view('groupserv/listgroups', $page_data);
	}
	// --------------------------------------------------------
	
	/**
	 * Groupserv Join Page
	 * This page allows users to join an open group
	 *
	 */
	public function join()
	{
		$page_data = array();

		// set form validation rules
		$this->form_validation->set_rules('group', 'Group', 'required');
		
		// did the user submit?
		if ($this->form_validation->run())
		{
			$callback = $this->groupserv_model->gs_join($this->input->post('group')); 
			
			// validate the call
			if (!$this->atheme->valid_authcookie($callback))
				redirect('main/logout');
				
			$page_data['success'] = $callback['response'];
			$page_data['msg'] = $callback['data'];
		}

		$this->load->view('groupserv/join', $page_data);
	}
	// --------------------------------------------------------
	
	/**
	 * Groupserv Register Page
	 * This page allows users to register a group
	 *
	 */
	public function register()
	{
		$page_data = array();

		// set form validation rules
		$this->form_validation->set_rules('group', 'Group', 'required');
		
		// did the user submit?
		if ($this->form_validation->run())
		{
			$callback = $this->groupserv_model->gs_register($this->input->post('group')); 
			
			// validate the call
			if (!$this->atheme->valid_authcookie($callback))
				redirect('main/logout');
				
			$page_data['success'] = $callback['response'];
			$page_data['msg'] = $callback['data'];
		}

		$this->load->view('groupserv/register', $page_data);
	}
	// --------------------------------------------------------

	/**
	 * Groupserv Listchans Page
	 * This page allows users to see channel access that group has
	 *
	 */
	public function listchans()
	{
		$page_data = array();

		// set form validation rules
		$this->form_validation->set_rules('group', 'Group', 'required');
		
		// did the user submit?
		if ($this->form_validation->run())
		{
			$callback = $this->groupserv_model->gs_listchans($this->input->post('group')); 
			
			// validate the call
			if (!$this->atheme->valid_authcookie($callback))
				redirect('main/logout');
				
			$page_data['response'] = $callback['data'];
		}

		$this->load->view('groupserv/listchans', $page_data);
	}
	// --------------------------------------------------------
	
	/**
	 * Groupserv Flags Page
	 * Page allows user to manage flags for a specified group
	 * 
	 */
	public function flags()
	{
		$page_data = array();
		
		if ($this->input->post('list_flags'))
		{
			$this->form_validation->set_rules('group', 'Group name', 'required');
		}
		
		if ($this->input->post('set_flags'))
		{
			$this->form_validation->set_rules('group', 'Group name', 'required');
			$this->form_validation->set_rules('nick', 'Nickname', 'required');
			$this->form_validation->set_rules('flags', 'Flags', 'required');
		}
		
		if ($this->form_validation->run())
		{
			
			if ($this->input->post('list_flags'))
			{
				$callback = $this->groupserv_model->gs_flags_list($this->input->post('group'));
				
				$page_data['response'] = $callback['data']; 
			}
			
			if ($this->input->post('set_flags'))
			{
				$callback = $this->groupserv_model->gs_flags_set($this->input->post('group'), $this->input->post('nick'), $this->input->post('flags'));
								
				$page_data['success'] = $callback['response'];
				$page_data['msg'] = $callback['data'];
			}

			if (!$this->atheme->valid_authcookie($callback))
				redirect('main/logout');
			
		}
		
		$this->load->view('groupserv/flags', $page_data);
	}
	// --------------------------------------------------------
	
	/**
	 * Groupserv Settings Page
	 * Page allows user to set options for a specified group
	 * 
	 */
	public function set()
	{
		$page_data = array();
		
		if ($this->input->post('group_info'))
		{
			$this->form_validation->set_rules('group', 'Group name', 'required');
		}
		
		if ($this->input->post('gs_set'))
		{
			$this->form_validation->set_rules('group', 'Group name', 'required');
			$this->form_validation->set_rules('option', 'Option', 'required');
			$this->form_validation->set_rules('value', 'Value', 'required');
		}
		
		if ($this->form_validation->run())
		{
			
			if ($this->input->post('group_info'))
			{
				$callback = $this->groupserv_model->gs_info($this->input->post('group'));
				
				$page_data['response'] = $callback['data']; 
			}
			
			if ($this->input->post('gs_set'))
			{
				$callback = $this->groupserv_model->gs_set($this->input->post('group'), $this->input->post('option'), $this->input->post('value'));
								
				$page_data['success'] = $callback['response'];
				$page_data['msg'] = $callback['data'];
			}

			if (!$this->atheme->valid_authcookie($callback))
				redirect('main/logout');
			
		}
		
		$this->load->view('groupserv/set', $page_data);
	}
	// --------------------------------------------------------
	
	/**
	 * Groupserv Info Page
	 * Page displayes info on the user requested group.
	 *
	 */
	public function info()
	{
		$page_data = array();
		
		$this->form_validation->set_rules('group', 'Group Name', 'required');
		
		if ($this->form_validation->run())
		{
			$callback = $this->groupserv_model->group_info($this->input->post('group'));
			
			if (!$this->atheme->valid_authcookie($callback))
				redirect('main/logout');
			
			$page_data['response'] = $callback['data'];
				
		}
		
		
		$this->load->view('groupserv/info', $page_data);
	}
	// --------------------------------------------------------
	
	//========================================================
	// CALLBACK FUNCTIONS
	//========================================================
	
	
	//========================================================
	// PRIVATE FUNCTIONS
	//========================================================
	
}

