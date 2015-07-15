<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/****************************************************************/
/* SWI (Services Web Interface) An enhanced web-panel for IRC   */
/*    networks.                                                 */
/*                                                              */
/* Author: siniStar @ Xtheme Development Group                  */
/* Website: http://www.Xtheme.org/                              */
/* IRC: irc.IRC4Fun.net in #SWI -or- chat.freenode.net in #SWI  */
/****************************************************************/


/**
 * Operserv Model
 *
 */
class Operserv_model extends CI_Model {

	
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
	}
	// --------------------------------------------------------
	

	/**
	 * check_cs_waiting()
	 * function will check for channels waiting registration review
	 * or not
	 *
	 */
	public function check_cs_waiting()
	{
		$ret_array = array();
		
		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_chanserv'),
			array(
				"WAITING"
			)
		);
		
		if ($cmd)
		{
			$ret_array['response'] = TRUE;
			$ret_array['data'] = $this->fout->as_array($this->xmlrpc->display_response(), FALSE);
		}
		else
		{
			$ret_array['response'] = FALSE;
			$ret_array['data'] = $this->xmlrpc->display_error();
		}
		
		return $ret_array;	}
	// --------------------------------------------------------

	/**
	 * check_cs_waiting()
	 * function will check for vHosts waiting to be reviewed
	 * or not
	 *
	 */
	public function check_hs_waiting()
	{
		$ret_array = array();
		
		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_hostserv'),
			array(
				"WAITING"
			)
		);
		
		if ($cmd)
		{
			$ret_array['response'] = TRUE;
			$ret_array['data'] = $this->fout->as_array($this->xmlrpc->display_response(), FALSE);
		}
		else
		{
			$ret_array['response'] = FALSE;
			$ret_array['data'] = $this->xmlrpc->display_error();
		}
		
		return $ret_array;	}
	// --------------------------------------------------------
	
	/**
	 * check_access()
	 * function will check for access to Operserv and return a bool value if users has access
	 * or not
	 *
	 */
	public function check_access()
	{
		$ret_array = array();

		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_operserv'),
			array(
				"HELP"
			)
		);

		if ($cmd)
			return TRUE;

		return FALSE;
	}
	// --------------------------------------------------------

    /**
     * channel_review()
     * function allows Staff to review Channel Registration requests.
     * 
     * @param string $rev_decision 	- ACTIVATE (Accept) or REJECT (Decline)
     * @param string $rev_channel	- channel we want to review
     * 
     * @return - xmlrcp server response
     */
    public function channel_review($rev_decision, $rev_channel)
    {
    	$ret_array = array();
    	
    	if (!$rev_channel)
    		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_chanserv'),
	    		array(
	    			$rev_decision,
	    			$rev_channel
	    		)
	    	);
    	else 
    		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_chanserv'),
	    		array(
	    			$rev_decision,
	    			$rev_channel
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
     * vhost_review()
     * function allows Staff to review VHost requests.
     * 
     * @param string $rev_decision 	- ACTIVATE (Accept) or REJECT (Decline)
     * @param string $rev_nick	- channel we want to review
     * 
     * @return - xmlrcp server response
     */
    public function vhost_review($rev_decision, $rev_nick)
    {
    	$ret_array = array();
    	
    	if (!$rev_nick)
    		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_hostserv'),
	    		array(
	    			$rev_decision,
	    			$rev_nick
	    		)
	    	);
    	else 
    		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_hostserv'),
	    		array(
	    			$rev_decision,
	    			$rev_nick
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
	 * akill_add()
	 * function allows service admins to add a specific akill to the network
	 *
	 * @param string $nick_host		- nickname, or hostname of the user to add the akill for
	 * @param string $type 			- type of akilll to add perma (!P) or timed (!T)
	 * @param string $duration 		- if the above param is !T then a time can be specified in format #d#m etc...
	 * @param string $reason 		- optional reason for the akill
	 */
	public function akill_add($nick_host, $akill_type, $duration = FALSE, $reason = FALSE)
	{
		$ret_array = array();

		if ($akill_type == "!T" && $duration)
		{
			$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_operserv'),
				array(
					"AKILL",
					"ADD",
					$nick_host,
					$akill_type . ' ' . ($duration) ? $duration : '1d' . ' ' . ($reason) ? $reason : 'No reason given.'
				)
			);	
		}
		else
		{
			$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_operserv'),
				array(
					"AKILL",
					"ADD",
					$nick_host,
					($reason) ? $reason : 'No reason given.',
				)
			);
		}

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
	 * akill_del()
	 * function deletes an akill for the akill list via id, now i know that bulk actions are supported via #,#,# or #:# format
	 * however support for it has not been added to SWI yet... it's on the todo list.
	 *
	 * @param int $akill_id 	- the id of the akill to remove
	 */
	public function akill_del($akill_id)
	{
		$ret_array = array();

		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_operserv'),
			array(
				'AKILL',
				'DEL',
				$akill_id
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
	 * akill_list()
	 * function will list all the current services akills
	 *
	 * @param bool $full 		- display the reason? default yes
	 */
	public function akill_list($full = TRUE)
	{
		$ret_array = array();

		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_operserv'),
			array(
				"AKILL",
				"LIST",
				(($full) ? 'FULL' : NULL)
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
	 * send_global()
	 * function will send out a global message to all users on the network. mind the spam!
	 *
	 * @param string $global_msg 	- the global message you wish to send.
	 */
	public function send_global($global_msg)
	{
		$ret_array = array();

		// build the global lines
		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_operserv'),
			array(
				"GLOBAL",
				$global_msg
			)
		);

		// send the global
		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_operserv'),
			array(
				"GLOBAL",
				"SEND"
			)
		);

		// clear the global
		$cmd1 = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_operserv'),
			array(
				"GLOBAL",
				"CLEAR"
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
	 * module_list()
	 * function will list all currently active modules
	 */
	public function module_list()
	{
		$ret_array = array();

		// build the global lines
		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_operserv'),
			array(
				"MODLIST"
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
	 * module_unload()
	 * function will attempt to unload a currently loaded atheme module from the server
	 *
	 * @param string $module_name 		- path and name of the module you want to unload
	 */
	public function module_unload($module_name)
	{
		$ret_array = array();

		// build the global lines
		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_operserv'),
			array(
				"MODUNLOAD",
				$module_name
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
	 * module_load()
	 * function allows users to load a module into atheme via the web panel.
	 *
	 * @param string $module_name 	- the path/and/name of the module you wish to load into athtem
	 */
	public function module_load($module_name)
	{
		$ret_array = array();

		// build the global lines
		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_operserv'),
			array(
				"MODLOAD",
				$module_name
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
	 * soper_list()
	 * function will list all current soper access
	 */
	public function soper_list()
	{
		$ret_array = array();

		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_operserv'),
			array(
				"SOPER",
				"LIST"
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
	 * soper_add()
	 * function will add a user to the soper with the passed class access
	 *
	 * @param string $soper 	- soper (nickname) to add
	 * @param string $sclass 	- soper class to add the above nickname too
	 */
	public function soper_add($soper, $sclass)
	{
		$ret_array = array();

		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_operserv'),
			array(
				"SOPER",
				"ADD",
				$soper,
				$sclass
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
	 * soper_del()
	 * function will remove acces for a passes soper
	 *
	 * @param string $soper 	- soper name (nickname) of the user you want to remove services access for
	 */
	public function soper_del($soper)
	{
		$ret_array = array();

		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_operserv'),
			array(
				"SOPER",
				"DEL",
				$soper
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
	 * soper_setpass()
	 * function will allow the user to change the password for the named soper
	 *
	 * @param string $soper 	- soper that you want to set the password for
	 * @param string $passhash 	- hash for the password (generated useing genpasswordhash)
	 */
	public function soper_setpass($soper, $passhash)
	{
		$ret_array = array();

		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_operserv'),
			array(
				"SOPER",
				"SETPASS",
				$soper,
				$passhash
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
	 * clear_channel()
	 * this function allows users to issue the CLEARNCHAN command on a given channel with
	 * the passed given parameters.
	 * 
	 * @param string $clear_action 		- action to use when clearing the channel
	 * @param string $clear_channel 	- #channel name to clear
	 * @param string $clear_reason 		- reason given for the channel clear, (optional)
	 */
	public function clear_channel($clear_action, $clear_channel, $clear_reason = FALSE)
	{
		$ret_array = array();

		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_operserv'),
			array(
				"CLEARCHAN",
				$clear_action,
				$clear_channel,
				($clear_reason) ? $clear_reason : 'No reason given.'
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
	 * rehash()
	 * function will rehash anope upon request
	 */
	public function rehash()
	{
		$ret_array = array();

		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_operserv'),
			array(
				"REHASH"
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
	 * specs()
	 * function will run a specs command on the current user
	 */
	public function specs()
	{
		$ret_array = array();

		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_operserv'),
			array(
				"SPECS"
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
