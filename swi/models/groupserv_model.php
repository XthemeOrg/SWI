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
 * Groupserv Model
 *
 */
class Groupserv_model extends CI_Model {

	
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
	 * gs_listgroups()
	 * function will display the current list of Groups via Nickserv
	 *
	 * @return array 	- server response
	 *
	 */
	public function gs_listgroups()
	{
		$ret_array = array();
		
		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_nickserv'),
			array(
				"LISTGROUPS"
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
	 * gs_join()
	 * function allows a user to join an open GroupServ group.
	 *
	 * @param string $group 	- the desired group to join
	 *
	 * @return - xmlrpc server response
	 */
	public function gs_join($group)
	{
		$ret_array = array();

		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_groupserv'),
			array(
				"JOIN",
				$group
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
	 * gs_register()
	 * function allows a user to register a GroupServ group.
	 *
	 * @param string $group 	- the desired group to register
	 *
	 * @return - xmlrpc server response
	 */
	public function gs_register($group)
	{
		$ret_array = array();

		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_groupserv'),
			array(
				"REGISTER",
				$group
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
	 * gs_listchans()
	 * function allows a user to see channels that the group has access to.
	 *
	 * @param string $group 	- the desired group to check channel access on
	 *
	 * @return - xmlrpc server response
	 */
	public function gs_listchans($group)
	{
		$ret_array = array();

		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_groupserv'),
			array(
				"LISTCHANS",
				$group
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
	 * gs_flags_list()
	 * function allows the user to view a list of current group flags
	 *
	 * @param string $group	- group name with !
	 * @return array 			- server response
	 *
	 */
	public function gs_flags_list($group)
	{
		$ret_array = array();
		
		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_groupserv'),
			array(
				"FLAGS",
				$group
			)
		);
		
		if ($cmd)
		{
			$ret_array['response'] = TRUE;
			$ret_array['data'] = $this->fout->as_array($this->xmlrpc->display_response(), TRUE);
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
	 * gs_flags_set()
	 * function allows user to set the channel flags
	 *
	 * @param string $group	- group to set flags on
	 * @param string $flags		- flags to set with + and/or - included
	 * @return array			- server response
	 *
	 */
	public function gs_flags_set($group, $nick, $flags)
	{
		$ret_array = array();
		
		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_groupserv'),
			array(
				"FLAGS",
				$group,
				$nick,
				$flags
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
	 * gs_set()
	 * function allows user to set the group settings flags
	 *
	 * @param string $group	- channel to set flags on
	 * @param string $option		- group option
	 * @param string $value 		- group option value
	 * @return array			- server response
	 *
	 */
	public function gs_set($group, $option, $value)
	{
		$ret_array = array();
		
		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_groupserv'),
			array(
				"SET",
				$group,
				$option,
				$value
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
	 * group_info()
	 * function will query the xmlrpc server to get info on requested group
	 *
	 * @param string $group	- group name string with !
	 * @return array 			- server response
	 *
	 */
	public function group_info($group)
	{
		$ret_array = array();
		
		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_groupserv'),
			array(
				"INFO",
				$group
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
		
		return $ret_array;
	}
	// --------------------------------------------------------
	
	//========================================================
	// PRIVATE FUNCTIONS
	//========================================================
	
	
}
