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
 * Main Controller
 * 
 */
class Main extends CI_Controller {

	
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
	}
	// --------------------------------------------------------
	
	
	/**
	 * Index Page
	 * Displays the main dashboard page or redirects to the login page.
	 *
	 */
	public function index()
	{
		if ($this->session->userdata('is_authed'))
			redirect('main/home');
		
		$page_data = array(
			'recaptcha' => $this->recaptcha->get_html()
		);
		
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->config->item('login_recaptcha'))
			$this->form_validation->set_rules('recaptcha_response_field', 'Are you human?', 'required|callback__check_captcha');
		
		if ($this->form_validation->run())
		{	
			if ($this->atheme->login($this->input->post('username'), $this->input->post('password')))
			{				
				$user_data = array(
					'is_authed'	=> TRUE,
					'nick'	=> $this->input->post('username'),
					'auth'	=> $this->xmlrpc->display_response(),
				);
				
				$this->session->set_userdata($user_data);
				
				redirect('main/home');
			}
			else
			{
				$page_data['success'] = FALSE;
				$page_data['msg'] = $this->xmlrpc->display_error();
			}
		}

		$this->load->view('login', $page_data);
	}
	// --------------------------------------------------------
	
	public function credits()
	{
		$page_data = array();
		$this->load->view('credits', $page_data);		
	}

	public function staff_messages()
	{
		$page_data = array();
		$this->load->view('staff_messages', $page_data);		
	}
	public function nac()
	{
		$page_data = array();
		$this->load->view('nac', $page_data);		
	}
	
	/**
	 * Home Page
	 * Displays the main dashboard page.
	 * 
	 */
	public function home()
	{	
		$page_data = array();
		
		// info
		$callback = $this->nickserv_model->get_info();
		
		// validation check
		if (!$this->atheme->valid_authcookie($callback))
			redirect('main/logout');
		
		// set our response
		if ($callback['response'])
			$page_data['info'] = $this->fout->nick_info($callback['data']);
			
		// parse users email and set into session
		// we'll use this for gravatar icons
		//
		// i had to use a loop for this as where the email can appear in the callback varies per net
		// depending on what modules they have installed and in use on NS.
		foreach ($page_data['info'] as $ep)
		{
			if (strstr($ep, 'Email'))
			{
				$email_parts = explode(":", $ep);
				$u_email = explode(" ", trim($email_parts[1]));
			}
								
		}
		$this->session->set_userdata('email', $u_email[0]);
		
		// channel access
		$callback = $this->nickserv_model->list_chans();
		
		// validation check
		if (!$this->atheme->valid_authcookie($callback))
			redirect('main/logout');

		$page_data['response'] = $callback['data'];
		
		$this->load->view('home', $page_data);
	}
	// --------------------------------------------------------

		public function logins()
	{	
		$page_data = array();
		
		// info
		$callback = $this->nickserv_model->get_info();
		
		// validation check
		if (!$this->atheme->valid_authcookie($callback))
			redirect('main/logout');
		
		// set our response
		if ($callback['response'])
			$page_data['info'] = $this->fout->nick_info($callback['data']);
			
		// parse users email and set into session
		// we'll use this for gravatar icons
		//
		// i had to use a loop for this as where the email can appear in the callback varies per net
		// depending on what modules they have installed and in use on NS.
		foreach ($page_data['info'] as $ep)
		{
			if (strstr($ep, 'Email'))
			{
				$email_parts = explode(":", $ep);
				$u_email = explode(" ", trim($email_parts[1]));
			}
								
		}
		$this->session->set_userdata('email', $u_email[0]);
		
		// channel access
		$callback = $this->nickserv_model->list_logins();
		
		// validation check
		if (!$this->atheme->valid_authcookie($callback))
			redirect('main/logout');

		$page_data['response'] = $callback['data'];
		
		$this->load->view('logins', $page_data);
	}
	// --------------------------------------------------------
	
	/**
	 * Logout Page
 	 * Does the user logout and then redirects.
 	 * 
 	 */
	public function logout()
	{
		$page_data = array();

		$this->atheme->logout($this->session->userdata('nick'), $this->session->userdata('auth'));
		$this->session->sess_destroy();
		
		redirect('');
	}
	// --------------------------------------------------------
	
	
	/**
	 * Register Page
	 * Displayes the users registration page, if allowd via the config.
	 *
	 */
	public function register()
	{
		// make sure it's not available if we set config option to FALSE
		if (!$this->config->item('web_register'))
			redirect('');
			
	    $page_data = array(
			'recaptcha' => $this->recaptcha->get_html()
		);
	    
	    $this->form_validation->set_rules('username', 'Nickname', 'required');
	    $this->form_validation->set_rules('password', 'Password', 'required');
	    $this->form_validation->set_rules('repassword', 'Re-Typed Password', 'required|matches[password]');
	    $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		
	    if ($this->config->item('register_recaptcha'))
	    	$this->form_validation->set_rules('recaptcha_response_field', 'Are you human?', 'required|callback__check_captcha');
	    
	    if ($this->form_validation->run())
	    {
	        $callback = $this->nickserv_model->register($this->input->post('username'), $this->input->post('password'), $this->input->post('email'));
			
			// validation check
			if (!$this->atheme->valid_authcookie($callback))
				redirect('main/logout');
			
			$page_data['success'] = $callback['response'];
			$page_data['msg'] = $callback['data'] . '<br /><br /><a href="' . base_url() . '">Click here</a> to be taken back to login screen.';
	    }
	    
	    $this->load->view('register', $page_data);
	}
	// --------------------------------------------------------
	
	
	//========================================================
	// CALLBACK FUNCTIONS
	//========================================================
	
	/**
	 * _check_captcha()
	 * function checks a captcha callback
	 */
	function _check_captcha($val)
	{
	  	if ($this->recaptcha->check_answer($this->input->ip_address(), $this->input->post('recaptcha_challenge_field'), $val))
	    	return TRUE;

	    $this->form_validation->set_message('_check_captcha', 'Incorrect Security Image Response');
	    return FALSE;
	}
	// --------------------------------------------------------

	
	//========================================================
	// PRIVATE FUNCTIONS
	//========================================================
	
}
