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
 * Memoserv Model
 *
 */
class Memoserv_model extends CI_Model {
	
	
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
	 * get_memos()
	 * function will get all current memos for user
	 *
	 * @param bool $count	- if we want to return just a count or not
	 * @return array		- server response
	 * 
	 */
	public function get_memos($count = FALSE)
	{
		$ret_array = array();
		$tmp_memos = array();
		
		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_memoserv'),
			array(
				"LIST",
				$this->session->userdata('nick')
			)
		);
		
		if ($cmd)
		{
			$ret_array['response'] = TRUE;
			
			if ($count)
			{
				$mcount = $this->fout->as_array($this->xmlrpc->display_response());	
				$ret_array['data'] = $mcount[0];
			}
			else
			{
				$memos_array = $this->fout->as_array($this->xmlrpc->display_response());
		
				if (sizeof($memos_array) > 1)
				{
					for ($x = 2; $x < sizeof($memos_array); $x++)
						array_push($tmp_memos, $memos_array[$x]);
				}
				
				$ret_array['data'] = $this->fout->as_memos($tmp_memos);
			}			
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
	 * get_memo()
	 * function will get a specific memo for the user
	 *
	 * @param int $memoid	- the id of the memo we want to get
	 * @return array		- server response
	 *
	 */
	public function get_memo($memoid)
	{
		$ret_array = array();
		
		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_memoserv'),
			array(
				"READ",
				$memoid
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
	 * send_memo()
	 * function will send a memo
	 *
	 * todo: make this static! well more static so we can pass params to it.
	 *
	 */
	public function send_memo()
	{
		$ret_array = array();
		
		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_memoserv'),
			array(
				"SEND",
				$this->input->post('nickname'),
				$this->input->post('thememo')
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
	 * fwd_memo()
	 * function will forward on a memo to another user
	 *
	 * @param int $memoid		- the id of the memo we want to fwd
	 * @param string $nickname	- the nickname of the user we want to fwd the memo to
	 * @return array			- server response
	 *
	 */
	public function fwd_memo($memoid, $nickname)
	{
		$ret_array = array();
		
		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_memoserv'),
			array(
				"FORWARD",
				$nickname,
				$memoid
			),
			TRUE
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
	 * delete_memo()
	 * function will delete a memo based on passed id
	 *
	 * @param int $memoid	- id of the memo we wish to delete
	 * @return array		- server response
	 *
	 */
	public function delete_memo($memoid)
	{
		$ret_array = array();
	 	
		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_memoserv'), 
	 		array(
	 			"DEL",
	 			$memoid
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
	 * delete_allmemos()
	 * function will delete a memo based on passed id
	 *
	 * @param int $memoid	- id of the memo we wish to delete
	 * @return array		- server response
	 *
	 */
	public function delete_allmemos()
	{
		$ret_array = array();
	 	
		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_memoserv'), 
	 		array(
	 			"DEL",
	 			'ALL'
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
