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
 * Botserv Model
 *
 */
class Botserv_model extends CI_Model {

	
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
	 * bot_offerlist()
	 * function will display the current list of offered bots via botserv
	 *
	 * @return array 	- server response
	 *
	 */
	public function bot_offerlist()
	{
		$ret_array = array();
		
		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_botserv'),
			array(
				"BOTLIST"
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
	 * bot_assign()
	 * function allows a user to assign an offered botserv bot on their channel.
	 *
	 * @param string $channel 	- the users channel
	 * @param string $bot		- the requested botserv bot
	 *
	 * @return - xmlrpc server response
	 */
	public function bot_assign($channel, $bot)
	{
		$ret_array = array();

		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_botserv'),
			array(
				"ASSIGN",
				$channel,
				$bot
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
	 * bot_unassign()
	 * function allows a user to unassign an botserv bot on their channel.
	 *
	 * @param string $channel 	- the users channel
	 *
	 * @return - xmlrpc server response
	 */
	public function bot_unassign($channel)
	{
		$ret_array = array();

		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_botserv'),
			array(
				"UNASSIGN",
				$channel
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
	 * bot_addbot()
	 * function allows a user to assign an offered botserv bot on their channel.
	 *
	 * @param string $nickname 	- the bot nickname
	 * @param string $user		- the bot username
	 * @param string $host  	- the bot hostname
	 * @param string $realname	- the bot realname
	 *
	 * @return - xmlrpc server response
	 */
	public function bot_addbot($nickname, $user, $host, $realname)
	{
		$ret_array = array();

		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_botserv'),
			array(
				"BOT",
				"ADD",
				$nickname,
				$user,
				$host,
				$realname
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
	 * bot_delbot()
	 * function allows a user to assign an offered botserv bot on their channel.
	 *
	 * @param string $nickname 	- the bot nickname
	 *
	 * @return - xmlrpc server response
	 */
	public function bot_delbot($nickname)
	{
		$ret_array = array();

		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_botserv'),
			array(
				"BOT",
				"DEL",
				$nickname
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
	 * bot_changebot()
	 * function allows a user to assign an offered botserv bot on their channel.
	 *
	 * @param string $oldnick	- the current nickname of the bot
	 * @param string $nickname 	- the bot nickname
	 * @param string $user		- the bot username
	 * @param string $host  	- the bot hostname
	 * @param string $realname	- the bot realname
	 *
	 * @return - xmlrpc server response
	 */
	public function bot_changebot($oldnick, $nickname, $user, $host, $realname)
	{
		$ret_array = array();

		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_botserv'),
			array(
				"BOT",
				"CHANGE",
				$oldnick,
				$nickname,
				$user,
				$host,
				$realname
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
