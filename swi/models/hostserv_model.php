<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/****************************************************************/
/* SWI (Services Web Interface) An enhanced web-panel for IRC   */
/*    networks.                                                 */
/*                                                              */
/* Author: Austin Ellis (siniStar @ Atheme Group)               */
/* Website: http://atheme.github.io/swi.html                    */
/* IRC: irc.IRC4Fun.net in #SWI -or- chat.freenode.net in #SWI  */
/****************************************************************/


/**
 * Hostserv Model
 *
 */
class Hostserv_model extends CI_Model {

	
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
	 */
	public function __construct()
	{
		parent::__construct();
	}
	// --------------------------------------------------------
	
	
	/**
	 * host_offerlist()
	 * function will display the current list of offered vhosts via hostserv
	 *
	 * @return array 	- server response
	 *
	 */
	public function host_offerlist()
	{
		$ret_array = array();
		
		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_hostserv'),
			array(
				"OFFERLIST"
			)
		);
		
		if ($cmd)
		{
			$ret_array['response'] = TRUE;
			$ret_array['data'] = $this->fout->as_array($this->xmlrpc->display_response());
		}
		else
		{
			$ret_array['response'] = FALSE;
			$ret_array['data'] = $this->xmlrpc->display_error();
		}
		
		return $ret_array;
	}
	// --------------------------------------------------------
	
	
	/**
	 * host_request()
	 * function will request a offered hostname for your nick
	 *
	 * @return array	- server response
	 *
	 */
	public function host_request($hostname)
	{
		$ret_array = array();
		
		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_hostserv'),
			array(
				"REQUEST",
				$hostname
			)
		);
		
		if ($cmd)
		{
			$ret_array['response'] = TRUE;
			$ret_array['data'] = $this->xmlrpc->display_response();
		}
		else
		{
			$ret_array['response'] = FALSE;
			$ret_array['data'] = $this->xmlrpc->display_error();
		}
		
		return $ret_array;
	}
	// --------------------------------------------------------


	/**
	 * host_take()
	 * function allows a user to take an offerd hostname on the network.
	 *
	 * @param string $hostname 	- the offered hostname a user wishes to take
	 *
	 * @return - xmlrpc server response
	 */
	public function host_take($hostname)
	{
		$ret_array = array();

		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_hostserv'),
			array(
				"TAKE",
				$hostname
			)
		);

		if ($cmd)
		{
			$ret_array['response'] = TRUE;
			$ret_array['data'] = $this->xmlrpc->display_response();
		}
		else
		{
			$ret_array['response'] = FALSE;
			$ret_array['data'] = $this->xmlrpc->display_error();
		}
		
		return $ret_array;
	}
	// --------------------------------------------------------
	
	
	//========================================================
	// PRIVATE FUNCTIONS
	//========================================================
	
	
}
