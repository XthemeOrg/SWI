<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/****************************************************************/
/* SWI (Services Web Interface) An enhanced web-panel for IRC   */
/*    networks.                                                 */
/*                                                              */
/* Author: Austin Ellis (siniStar @ Atheme Group)               */
/* Website: http://atheme.github.io/swi.html                    */
/* IRC: irc.IRC4Fun.net in #SWI -or- chat.freenode.net in #SWI  */
/****************************************************************/


/**
 * Botserv Controller
 * 
 */
class Botserv extends CI_Controller {
	
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
	 * Botserv Botlist Page
	 * Page displayes list of BotServ bots that the user can request for their channel. (only!)
	 *
	 */
	public function botlist()
	{
		$page_data = array();
		
		$callback = $this->botserv_model->bot_offerlist();
			
		if (!$this->atheme->valid_authcookie($callback))
			redirect('main/logout');
			
		$page_data['response'] = $callback['data'];
		
		$this->load->view('botserv/botlist', $page_data);
	}
	// --------------------------------------------------------

	/**
	 * Botserv Assign Page
	 * This page allows users to assign a bot offered by Botserv
	 *
	 */
	public function assign()
	{
		$page_data = array();

		// set form validation rules
		$this->form_validation->set_rules('channel', 'Channel', 'required');
		$this->form_validation->set_rules('bot', 'Bot', 'required');
		
		// did the user submit?
		if ($this->form_validation->run())
		{
			$callback = $this->botserv_model->bot_assign($this->input->post('channel'), $this->input->post('bot')); 
			
			// validate the call
			if (!$this->atheme->valid_authcookie($callback))
				redirect('main/logout');
				
			$page_data['success'] = $callback['response'];
			$page_data['msg'] = $callback['data'];
		}

		$this->load->view('botserv/assign', $page_data);
	}
	// --------------------------------------------------------

	/**
	 * Botserv Unassign Page
	 * This page allows users to unassign a BotServ bot from their channel
	 *
	 */
	public function unassign()
	{
		$page_data = array();

		// set form validation rules
		$this->form_validation->set_rules('channel', 'Channel', 'required');
		
		// did the user submit?
		if ($this->form_validation->run())
		{
			$callback = $this->botserv_model->bot_unassign($this->input->post('channel')); 
			
			// validate the call
			if (!$this->atheme->valid_authcookie($callback))
				redirect('main/logout');
				
			$page_data['success'] = $callback['response'];
			$page_data['msg'] = $callback['data'];
		}

		$this->load->view('botserv/unassign', $page_data);
	}
	
	// --------------------------------------------------------

	/**
	 * Botserv Bot ADD Page
	 * This page allows staff to add or create a bot to be offered by Botserv
	 *
	 */
	public function addbot()
	{
		$page_data = array();

		// set form validation rules
		$this->form_validation->set_rules('nickname', 'Nickname', 'required');
		$this->form_validation->set_rules('user', 'Username', 'required');
		$this->form_validation->set_rules('host', 'Hostname', 'required');
		$this->form_validation->set_rules('realname', 'Realname', 'required');
		
		// did the user submit?
		if ($this->form_validation->run())
		{
			$callback = $this->botserv_model->bot_addbot($this->input->post('nickname'), $this->input->post('user'), $this->input->post('host'), $this->input->post('realname')); 

		// auth access check
		if (!$this->operserv_model->check_access())
			redirect('main/nac');
			
			// validate the call
			if (!$this->atheme->valid_authcookie($callback))
				redirect('main/logout');
				
			$page_data['success'] = $callback['response'];
			$page_data['msg'] = $callback['data'];
		}

		$this->load->view('botserv/addbot', $page_data);
	}
	
	// --------------------------------------------------------

	/**
	 * Botserv Bot DEL Page
	 * This page allows staff to delete a bot offered by Botserv
	 *
	 */
	public function delbot()
	{
		$page_data = array();

		// set form validation rules
		$this->form_validation->set_rules('nickname', 'Nickname', 'required');
		
		// did the user submit?
		if ($this->form_validation->run())
		{
			$callback = $this->botserv_model->bot_delbot($this->input->post('nickname')); 
			
		// auth access check
		if (!$this->operserv_model->check_access())
			redirect('main/nac');
			
			// validate the call
			if (!$this->atheme->valid_authcookie($callback))
				redirect('main/logout');
				
			$page_data['success'] = $callback['response'];
			$page_data['msg'] = $callback['data'];
		}

		$this->load->view('botserv/delbot', $page_data);
	}
	
	// --------------------------------------------------------	

	/**
	 * Botserv Bot CHANGE Page
	 * This page allows staff to modify a bot offered by Botserv
	 *
	 */
	public function changebot()
	{
		$page_data = array();

		// set form validation rules
		$this->form_validation->set_rules('oldnick', 'Old Nickname', 'required');
		$this->form_validation->set_rules('nickname', 'New Nickname', 'required');
		$this->form_validation->set_rules('user', 'Username', 'required');
		$this->form_validation->set_rules('host', 'Hostname', 'required');
		$this->form_validation->set_rules('realname', 'Realname', 'required');
		
		// did the user submit?
		if ($this->form_validation->run())
		{
			$callback = $this->botserv_model->bot_changebot($this->input->post('oldnick'), $this->input->post('nickname'), $this->input->post('user'), $this->input->post('host'), $this->input->post('realname')); 

		// auth access check
		if (!$this->operserv_model->check_access())
			redirect('main/nac');
			
			// validate the call
			if (!$this->atheme->valid_authcookie($callback))
				redirect('main/logout');
				
			$page_data['success'] = $callback['response'];
			$page_data['msg'] = $callback['data'];
		}

		$this->load->view('botserv/changebot', $page_data);
	}

	public function bot()
	{
		$page_data = array();
		$this->load->view('botserv/bot', $page_data);		
		
				// auth access check
		if (!$this->operserv_model->check_access())
			redirect('main/nac');
	}	

	// --------------------------------------------------------
	
	//========================================================
	// CALLBACK FUNCTIONS
	//========================================================
	
	
	//========================================================
	// PRIVATE FUNCTIONS
	//========================================================
	
}

