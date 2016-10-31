<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/****************************************************************/
/* SWI (Services Web Interface) An enhanced web-panel for IRC   */
/*    networks.                                                 */
/*                                                              */
/* Author: Austin Ellis (siniStar @ Xtheme Group)               */
/* Website: http://www.xtheme.org/SWI                           */
/* IRC: irc.IRC4Fun.net in #SWI -or- chat.freenode.net in #SWI  */
/****************************************************************/


/**
 * Nickserv Controller
 * 
 */
class Nickserv extends CI_Controller {

	
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
        if (!$this->config->item('atheme_nickserv'))
            redirect('main/rd');
	}
	// --------------------------------------------------------
	
	
	/**
	 * Index Page
	 * Page displays some basic user info on the given nickname
	 *
	 */
	public function index()
	{		
		$page_data = array();
		
		$this->form_validation->set_rules('nickname', 'Nickname', 'required');

		// default callback is on your own nick
		$callback = $this->nickserv_model->get_info();

		if ($this->form_validation->run())
			$callback = $this->nickserv_model->get_info($this->input->post('nickname'));
		
		if (!$this->atheme->valid_authcookie($callback))
			redirect('main/logout');

        if (!$this->config->item('atheme_nickserv'))
            redirect('main/rd');
		
		if ($callback['response'])
		{
			$tmp = $this->fout->nick_info($callback['data']);
			$page_data['response'] = implode("<br />", $tmp);
		}	
				
		$this->load->view('nickserv/main', $page_data);
	}
	// --------------------------------------------------------

	/**
	 * Index Page
	 * Page displays some basic user info on the given nickname
	 *
	 */
	public function info()
	{		
		$page_data = array();
		
		$this->form_validation->set_rules('nickname', 'Nickname', 'required');

		// default callback is on your own nick
		$callback = $this->nickserv_model->get_info2();

		if ($this->form_validation->run())
			$callback = $this->nickserv_model->get_info2($this->input->post('nickname'));
		
		if (!$this->atheme->valid_authcookie($callback))
			redirect('main/logout');

        if (!$this->config->item('atheme_nickserv'))
            redirect('main/rd');
		
		if ($callback['response'])
		{
			$tmp = $this->fout->nick_info($callback['data']);
			$page_data['response'] = implode("<br />", $tmp);
		}	
				
		$this->load->view('nickserv/main', $page_data);
	}
	// --------------------------------------------------------	
	
	/**
	 * Email Page
	 * Page allows users to change their set email address associated with their nickname
	 *
	 */
	public function email()
	{	
		$page_data = array();
		
		$this->form_validation->set_rules('email', 'Account Email', 'required');
		
		if ($this->form_validation->run())
		{
			
			$callback = $this->nickserv_model->set_email($this->input->post('email'));

			if (!$this->atheme->valid_authcookie($callback))
				redirect('main/logout');

            if (!$this->config->item('atheme_nickserv'))
                redirect('main/rd');
						
			$page_data['success'] = $callback['response'];
			$page_data['msg'] = $callback['data'];
		}
		
		$this->load->view('nickserv/email', $page_data);
	}
	// --------------------------------------------------------

	/**
	 * Verify Page
	 * Page allows users to verify their set email address associated with their nickname
	 *
	 */
	public function verify()
	{	
		$page_data = array();
				
		$this->form_validation->set_rules('ver_operation', 'Operation to VERIFY', 'required');
		$this->form_validation->set_rules('ver_key', 'Your VERIFY key', 'required');
		
		if ($this->form_validation->run())
		{
			
			$callback = $this->nickserv_model->verify($this->input->post('ver_operation'), $this->input->post('ver_key'));

			if (!$this->atheme->valid_authcookie($callback))
				redirect('main/logout');

            if (!$this->config->item('atheme_nickserv'))
                redirect('main/rd');
						
			$page_data['success'] = $callback['response'];
			$page_data['msg'] = $callback['data'];
		}
		
		$this->load->view('nickserv/verify', $page_data);
	}
	// --------------------------------------------------------

	/**
	 * Email Page
	 * Page allows users to change their set email address associated with their nickname
	 *
	 */
	public function set()
	{	
		$page_data = array();
		
		// default callback is on your own nick
		$callback = $this->nickserv_model->get_info();
		
		if (!$this->atheme->valid_authcookie($callback))
			redirect('main/logout');

        if (!$this->config->item('atheme_nickserv'))
            redirect('main/rd');
		
		if ($callback['response'])
		{
			$tmp = $this->fout->nick_info($callback['data']);
			$page_data['response'] = implode("<br />", $tmp);
		}
		
		$this->form_validation->set_rules('set_option', 'Option to Set', 'required');
		$this->form_validation->set_rules('set_value', 'Value of Setting', 'required');
		
		if ($this->form_validation->run())
		{
			
			$callback = $this->nickserv_model->set_options($this->input->post('set_option'), $this->input->post('set_value'));

			if (!$this->atheme->valid_authcookie($callback))
				redirect('main/logout');

            if (!$this->config->item('atheme_nickserv'))
                redirect('main/rd');
						
			$page_data['success'] = $callback['response'];
			$page_data['msg'] = $callback['data'];
		}
		
		$this->load->view('nickserv/set', $page_data);
	}
	// --------------------------------------------------------	
	
	/**
	 * Password Page
	 * Page allows users to manage their current nickname password
	 *
	 */
	public function password()
	{
		$page_data = array();
		
		$this->form_validation->set_rules('password', 'Password', 'required|matches[password_again]');
		$this->form_validation->set_rules('password_again', 'Password Again', 'required');
		
		if ($this->form_validation->run())
		{
			$callback = $this->nickserv_model->set_password($this->input->post('password'));
			
			if (!$this->atheme->valid_authcookie($callback))
				redirect('main/logout');

            if (!$this->config->item('atheme_nickserv'))
                redirect('main/rd');
			
			$page_data['success'] = $callback['response'];
			$page_data['msg'] = $callback['data'];
		}
		
		$this->load->view('nickserv/password', $page_data); 
	}
	// --------------------------------------------------------
	
	
	/**
	 * json_access Page
	 * Page displayes a json list of channels that you have access to
	 * 
	 */
	public function json_access($json = true)
	{
		header("Content-Type: text/plain");
		
		if ($json)
		{
			$callback = $this->nickserv_model->list_chans();
			$channel_data = array();
			
			if ($callback['response'] && $callback['data'] > 1)
			{
				$channels = $callback['data'];
				array_pop($channels);
				
				$count = 1;
				foreach ($channels as $channel)
				{
					$buf = explode(" ", $channel);
					$tmp['id']	= $count;
					$tmp['text']	= $buf[4];
					$count++;
					
					array_push($channel_data, $tmp);
				}
			}
			
			print json_encode($channel_data);			
		}
	}
	// --------------------------------------------------------
	
	
	//========================================================
	// CALLBACK FUNCTIONS
	//========================================================
	
	
	//========================================================
	// PRIVATE FUNCTIONS
	//========================================================

}
