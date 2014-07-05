<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

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
 * Chanserv Model
 *
 */
class Chanserv_model extends CI_Model {
	
	
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
	 * channel_info()
	 * function will query the xmprcp server to get info on requested channel
	 *
	 * @param string $channel	- channel name as string with #
	 * @return array 			- server response
	 *
	 */
	public function channel_info($channel)
	{
		$ret_array = array();
		
		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_chanserv'),
			array(
				"INFO",
				$channel
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

	/**
	 * channel_reg()
	 * function will query the xmprcp server to get to register requested channel
	 *
	 * @param string $channel	- channel name as string with #
	 * @return array 			- server response
	 *
	 */
	public function channel_reg($channel)
	{
		$ret_array = array();
		
		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_chanserv'),
			array(
				"REGISTER",
				$channel
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
	
	/**
	 * channel_topic()
	 * function sets the specified topic on the specified channel
	 *
	 * @param string $channel	- channel name with # to setup the topic on
	 * @param string $topic 	- the topic that you wish to set
	 * @return array 			- server response
	 *
	 */
	public function channel_topic($channel, $topic)
	{
		$ret_array = array();
		
		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_chanserv'),
			array(
				"TOPIC",
				$channel,
				$topic
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
	 * channel_kick()
	 * function will kick the specified user from the channel
	 * 
	 * @param string $channel	- specified channel with #
	 * @param string $nickname	- nickname of the user to kick from the channel
	 * @param string $reason	- reason to kick the user (optional)
	 * @return array			- server response
	 *
	 */
	public function channel_kick($channel, $nick, $reason = FALSE)
	{
		$ret_array = array();
		
		if ($reason)
		{
			$cmd_data = array(
				"KICK",
				$channel,
				$nick,
				$reason
			);
		}
		else
		{
			$cmd_data = array(
				"KICK",
				$channel,
				$nick
			);
		}	 
		
		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_chanserv'), $cmd_data);
		
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
	 * channel_ban()
	 * function will all user to manage bans
	 * 
	 * @param string $channel 	- channel to manage the ban on
	 * @param string $nick		- nickname of the person to manage
	 * @param bool $unban		- bool value to + or - b
	 * @return array			- server response
	 *
	 */
	public function channel_ban($channel, $nick, $unban = FALSE)
	{
		$ret_array = array();
		
		if ($unban)
		{
			$cmd_data = array(
				"UNBAN",
				$channel,
				$nick
			);	
		}
		else
		{
			$cmd_data = array(
				"BAN",
				$channel,
				$nick
			);
		}		
		
		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_chanserv'), $cmd_data);
		
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
	 * channel_flags_list()
	 * function allows the user to view a list of current channel flags
	 *
	 * @param string $channel	- channel name with #
	 * @return array 			- server response
	 *
	 */
	public function channel_flags_list($channel)
	{
		$ret_array = array();
		
		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_chanserv'),
			array(
				"FLAGS",
				$channel
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
	 * channel_flags_set()
	 * function allows user to set the channel flags
	 *
	 * @param string $channel	- channel to set flags on
	 * @param string $flags		- flags to set with + and/or - included
	 * @return array			- server response
	 *
	 */
	public function channel_flags_set($channel, $nick, $flags)
	{
		$ret_array = array();
		
		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_chanserv'),
			array(
				"FLAGS",
				$channel,
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
	 * channel_set()
	 * function allows user to set the channel flags
	 *
	 * @param string $channel	- channel to set flags on
	 * @param string $flags		- flags to set with + and/or - included
	 * @return array			- server response
	 *
	 */
	public function set_copts($channel, $option, $value)
	{
		$ret_array = array();
		
		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_chanserv'),
			array(
				"SET",
				$channel,
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
	 * channel_akick_list()
	 * function will get a list of a channel current akicks
	 *
	 * @param string $channel	- channel name to get the list of akicks for
	 * @return array			- server response
	 *
	 */
    public function channel_akick_list($channel)
    {
        $ret_array = array();
        
        $cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_chanserv'),
            array('AKICK',
                $channel,
                'LIST'
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
    

	/**
	 * channel_akick_set()
	 * function allows user to set a akick on a specific channel
	 *
	 * @param string $channel	- channel name to set the akick on
	 * @param string $action	- action to take set or unset
	 * @param string $nickname	- nick!host@mask to set teh akick on
	 * @param string $reason	- reason for the akick (optional)
	 * @return array			- server response
	 *
	 */
    public function channel_akick_set($channel, $action, $nickmask, $akick_type, $akick_duration = FALSE, $reason = FALSE)
    {
        $ret_array = array();

	if ($akick_type == "!T")
		{
            $cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_chanserv'),
                array("AKICK",
                    $channel,
                    "ADD",
                    $nickmask,
		    $akick_type . ' ' . ($akick_duration) ? $akick_duration : '1d' . ' ' . ($reason) ? $reason : 'No reason given via SWI3' 
                )
            );
	}
	elseif ($akick_type == "!P") {
            $cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_chanserv'),
                array("AKICK",
                    $channel,
                    "ADD",
                    $nickmask,
		    $akick_type . ' ' . ($reason) ? $reason : 'No reason given via SWI3' 
                )
            );
	}

        if ($action == 'del')
        {
            $cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_chanserv'),
                array('AKICK',
                    $channel,
                    'DEL',
                    $nickmask
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
     * channel_xop()
     * function allows users to manage their XOP lists.
     * 
     * @param string $xop_type 		- type of XOP (VOP|HOP|AOP|SOP)
     * @param string $xop_channel	- channel we want to manage
     * @param string $xop_action	- action we want to preform (ADD|DELETE|LIST)
     * @param string $xop_nickhost	- xop nickname or host we want to manage
     * 
     * @return - xmlrcp server response
     */
    public function channel_xop($xop_type, $xop_channel, $xop_action, $xop_nickhost = FALSE)
    {
    	$ret_array = array();
    	
    	if (!$xop_nickhost)
    		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_chanserv'),
	    		array(
	    			$xop_type,
	    			$xop_channel,
	    			$xop_action
	    		)
	    	);
    	else
    		$cmd = $this->atheme->atheme_command($this->session->userdata('nick'), $this->session->userdata('auth'), $this->config->item('atheme_chanserv'),
	    		array(
	    			$xop_type,
	    			$xop_channel,
	    			$xop_action,
	    			$xop_nickhost
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
