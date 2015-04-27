<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Base URL
 * This should be the base url to your site WITH the trailing slash
 * eg: http://yournetwork.net/
 */
$config['base_url']	= 'http://yournetwork.net/swi/';

/**
 * Site Name
 * Name for your site, this is use in the page titles
 * You will probably want to change at least the Network
 * name.
 */
$config['site_name']	= "IRC4Fun Services Web Interface";

/** 
 * Xtheme/Atheme Host
 * This should the set to the ip address or hostname that is running
 * your Xtheme/Atheme serivces
 */
$config['atheme_host'] = "127.0.0.1";

/**
 * Xtheme/Atheme Path
 * This should be set to the xmlrpc path in your xtheme.conf/atheme.conf,
 * you should be able to just leave this as is.
 */
$config['atheme_path'] = "/xmlrpc";

/**
 * Xtheme/Atheme Port
 * The port your Xtheme/Atheme httpd is running on
 */
$config['atheme_port'] = 8080;

/**
 * Xtheme/Atheme Service
 * Set these to the names of the Xtheme/Atheme services you run on your
 *  network.  FALSE if they do NOT exist on your network
 */
$config['atheme_chanserv'] = "ChanServ";
$config['atheme_nickserv'] = "NickServ";
$config['atheme_memoserv'] = "MemoServ";
$config['atheme_hostserv'] = "HostServ";
$config['atheme_operserv'] = "OperServ";
$config['atheme_botserv'] = "BotServ";
$config['atheme_groupserv'] = "GroupServ";

/**
 * XOP System
 * If you wish to enable the XOP system within SWI
 */
$config['atheme_xop']	= TRUE;

/**
 * FLAGS System
 * If you wish to enable the XOP system within SWI
 */
$config['atheme_flags']	= TRUE;

/**
 * Current Sessions (contrib/ns_listlogins) System
 * If you wish to enable the Current Sessions system within SWI
 * you must ensure that the Xtheme/Atheme contrib/ns_listlogins module
 * is loaded on your Xtheme/Atheme Services instance and set this to 
 * TRUE.  To disable Current Sessions, or if your Xtheme/Atheme is not
 * using contrib/ns_listlogins keep this at FALSE.
 */
$config['atheme_listlogins']	= FALSE;

/**
 * WAITING LISTS System
 * If you wish to enable the WAITING LISTS system within SWI
 * OperServ dashboard.
 *
 * NOTE: Be sure to enable the one or more waiting lists below.
 * if you enable the WAITING LISTS system.
 */
$config['atheme_waitings']	= FALSE;

/**
 * ChanServ WAITING LIST
 * If you wish to enable the ChanServ WAITING LIST within SWI
 * OperServ dashboard. *Requires chanserv/moderate enabled in
 * Xtheme/Atheme configuration file. (xtheme.conf/atheme.conf)
 */
$config['atheme_cswaiting']	= FALSE;

/**
 * HostServ WAITING LIST
 * If you wish to enable the HostServ WAITING LIST within SWI
 * OperServ dashboard. *Requires hostserv/request enabled in
 * Xtheme/Atheme configuration file. (xtheme.conf/atheme.conf)
 */
$config['atheme_hswaiting']	= FALSE;

/**
 * GroupServ FUNCTIONALITY
 * If you wish to enable the GroupServ within SWI.
 */
$config['atheme_groups']	= FALSE;

/**
 * SOPER Module?
 * Set to TRUE or FALSE depending on if you run this Atheme
 * module or not.
 */
$config['atheme_soper']	= TRUE;

/**
 * Web Register?
 * Allow users to register via the web?
 */
$config['web_register'] = TRUE;

/**
 * Enable Staff Messages?
 * Optional messages to users from staff page.  
 * File /swi/views/staff_messages.php
 * Edit file to your preferences and try not to forget to update it once in a while.
 */
$config['staff_messages'] = TRUE;

/**
 * Enable Social Media?
 * Optional links to network facebook or twitter.  
 * TRUE enables Social Media, FALSE disables it.
 */
$config['social_media'] = TRUE;

/**
 * Network Facebook URL?
 * Optional URL to network Facebook account.  
 * You will probably want to change this from the default
 */
$config['fb_url'] = 'http://www.facebook.com/IRC4Fun';

/**
 * Network Twitter URL?
 * Optional URL to network Twitter account.  
 * You will probably want to change this from the default
 */
$config['tw_url'] = 'http://twitter.com/IRC4Fun';

/**
 * Index Page
 * This variable should be left as is UNLESS you want to remove it using .htaccess
 * and mod_rewrite (or equivalent) in that case comment out the line below and keep reading.
 */
$config['index_page'] = 'index.php';

/**
 * If you wish to use Apache's mod_rewrite to remove the the index.php from your URI's
 * then uncomment the line below.
 */
//$config['index_page'] = '';

/**
 * Encryption Key
 * This NEEDS to be set to a nice long random string this key will be used to secure
 * session and cookies
 */
$config['encryption_key'] = 'YOU NEED TO SET THIS!';

/**
 * Session Config Options
 * I would hope these are fairly self explanitory
 */
$config['sess_cookie_name']		= 'swi3_session';
$config['sess_expiration']		= 7200;
$config['sess_expire_on_close']	= FALSE;
$config['sess_encrypt_cookie']	= FALSE;
$config['sess_match_ip']		= FALSE;
$config['sess_match_useragent']	= TRUE;
$config['sess_time_to_update']	= 300;
$config['cookie_prefix']	= "swi3_";
$config['cookie_domain']	= "";
$config['cookie_path']		= "/";
$config['cookie_secure']	= FALSE;

/**
 * Compress Output
 * You can choose to compress all output at GZIP however
 * please make sure your system its working before doing this.
 */
$config['compress_output'] = FALSE;

/**
 * Recaptcha
 * You can enable and use recaptcha for user login and registration.
 * You will nee a recaptcha key head over to: http://www.google.com/recaptcha sign up to get one
 * it's free and simple.
 */
$config['login_recaptcha']      = FALSE;
$config['register_recaptcha']   = FALSE;
$config['recaptcha'] = array(
    'public'                        => 'set your public recaptcha key',
    'private'                       => 'set your private recaptcha key',
/**  If your site uses SSL, you will want to change http: to https: on the following line for ReCaptcha
 *   to work and display properly.
 */
    'RECAPTCHA_API_SERVER'          => 'http://www.google.com/recaptcha/api',
    'RECAPTCHA_API_SECURE_SERVER'   => 'https://www.google.com/recaptcha/api',
    'RECAPTCHA_VERIFY_SERVER'       => 'www.google.com',
    'RECAPTCHA_SIGNUP_URL'          => 'https://www.google.com/recaptcha/admin/create',
    'theme'                         => 'white'
);

//
//  ___        _  _     _     ___    _ _ _     ___     _              _  _             
// |   \ ___  | \| |___| |_  | __|__| (_) |_  | _ )___| |_____ __ __ | || |___ _ _ ___ 
// | |) / _ \ | .` / _ \  _| | _|/ _` | |  _| | _ | -_) / _ \ V  V / | __ / -_) '_/ -_)
// |___/\___/ |_|\_\___/\__| |___\__,_|_|\__| |___|___|_\___/\_/\_/  |_||_\___|_| \___|
//
// You shoulnd't need to anything below this line, only attempt to do so if you know wtf you're doing!
//

$config['subclass_prefix'] = 'EG_';
$config['uri_protocol']	= 'AUTO';
$config['url_suffix'] = '';
$config['language']	= 'english';
$config['charset'] = 'UTF-8';
$config['enable_hooks'] = FALSE;
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';
$config['allow_get_array']		= TRUE;
$config['enable_query_strings'] = FALSE;
$config['controller_trigger']	= 'c';
$config['function_trigger']		= 'm';
$config['directory_trigger']	= 'd';
$config['log_threshold'] = 0;
$config['log_path'] = '';
$config['log_date_format'] = 'Y-m-d H:i:s';
$config['cache_path'] = '';
$config['sess_use_database']	= FALSE;
$config['sess_table_name']		= 'egs_sessions';
$config['global_xss_filtering'] = TRUE;
$config['csrf_protection'] = FALSE;
$config['csrf_token_name'] = 'csrf_test_name';
$config['csrf_cookie_name'] = 'csrf_cookie_name';
$config['csrf_expire'] = 7200;
$config['time_reference'] = 'local';
$config['rewrite_short_tags'] = FALSE;
$config['proxy_ips'] = '';
$config['swi_vers'] = 'v3.3.0';
