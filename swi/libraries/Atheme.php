<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/****************************************************************/
/* EGs Web Panel (Web Services for Atheme)                      */
/*                                                              */
/* author: 	J. Newing (synmuffin)                               */
/* web:		http://egs.ircmojo.org                              */
/* email: 	jnewing [at] gmail [dot] com                        */
/* irc: 	pool.ircmojo.org                                    */
/* version: 3.1                                                 */
/****************************************************************/


/**
 * Atheme Library
 *
 */
class Atheme {


	//========================================================
	// PRIVATE VARS
	//========================================================
	
	private $ci;
	
	
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
	public function __construct($params = NULL)
	{
		// grab the instance
		$this->ci =& get_instance();
		
		if ($params)
		{
			$this->ci->xmlrpc->server("http://{$params[0]}{$params[1]}", $params[3]);
		}
		else
		{
			$this->ci->xmlrpc->server("http://" . $this->ci->config->item('atheme_host') . $this->ci->config->item('atheme_path'), $this->ci->config->item('atheme_port'));	
		}
	}
	// --------------------------------------------------------
	
	
	/**
	 * login()
	 * login function sends a login request to the XMLRCP Atheme server
	 *
	 * @param string $nick 		- Nickname to login with
	 * @param string $password 	- Password to try and auth with
	 * @return bool
	 *
	 */ 
	public function login($nick, $password)
	{
		$this->ci->xmlrpc->method("atheme.login");
		$request = array($nick, $password);
		$this->ci->xmlrpc->request($request);
		
		if ($this->ci->xmlrpc->send_request())
		{
			return TRUE;
		}
		
		return FALSE;
	}
	// --------------------------------------------------------
	
	
	/**
	 * logout()
	 * logout function logs the users out and clears session
	 *
	 * @param string $nick - Nicknam to deauth
	 * @param string $auth - Auth code to deauth
	 * 
	 */
	public function logout($nick, $auth)
	{
		$this->ci->xmlrpc->method("atheme.logout");
		$request = array($auth, $nick, ".", "NICKSERV", "LOGOUT");
		$this->ci->xmlrpc->request($request);	
	}
	// --------------------------------------------------------
	

	/**
	 * ison()
	 * returns json TRUE or FALSE if user is on or not, NOTE: not all versions of atheme have
	 * this yet! don't use it unless your 100% sure yours does.
	 *
	 * @param string $nick 	- nickname of the user to check if he/she ison
	 *
	 */
	public function isonline($nick)
	{
		$this->ci->xmlrpc->method("atheme.ison");
		$request = array($nick);
		$this->ci->xmlrpc->request($request);

		return $this->ci->xmlrpc->send_request();
	}

	
	/**
	 * atheme_command()
	 * atheme_command sends the commmad with the nickname and authcode to the atheme XMLRCP server
	 *
	 * @param string $nick 		- Nickname of user sending the command
	 * @param string $auth 		- Authcode assoicated with the nickname (make sure user is valid and logged in)
	 * @param string $command	- Command to send to the Atheme XMLRPC server
	 * @param bool $debug		- Debug bool (default: false)
	 * @return XMLRCP Servers response.
	 *
	 */
	public function atheme_command($nick, $auth, $command, $parameters, $debug = FALSE)
	{
		$this->ci->xmlrpc->set_debug($debug);
				
		$this->ci->xmlrpc->method("atheme.command");
		
		$request = array($auth, $nick, "0.0.0.0", $command);
		foreach ($parameters as $param)
			array_push($request, $param);

		$this->ci->xmlrpc->request($request);
		
		return $this->ci->xmlrpc->send_request();
	}
	// --------------------------------------------------------


	/**
	 * valid_authcookie()
	 * function makes sure our callback data is not saying that our authcookie has expired
	 *
	 * @param array $callback_array 	- Callback array returned from teh XMLRPC Server
	 * @return bool
	 */
	public function valid_authcookie($callback_array = FALSE)
	{
		if (!is_array($callback_array))
		{
			$this->ci->session->set_flashdata('timeout', TRUE);	
			return FALSE;
		}
			

		if (!$callback_array['response'] && $callback_array['data'] == "Invalid authcookie for this account.")
		{
			$this->ci->session->set_flashdata('timeout', TRUE);	
			return FALSE;	
		}		

		return TRUE;
	}
	// --------------------------------------------------------
	
	
	//========================================================
	// PRIVATE FUNCTIONS
	//========================================================
	

}

?>
