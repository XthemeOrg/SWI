<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="distribution" content="global" />
    <meta name="robots" content="follow, all" />
    <meta name="language" content="en" />
    
    <title><?php print $this->config->item('site_name'); ?> - SWI3</title>
    
    <!-- Icon -->
    <link rel="Shortcut Icon" href="<?php print base_url(); ?>favicon.ico" type="image/x-icon" />
      
    <!-- CSS -->
    <link rel="stylesheet" href="<?php print base_url(); ?>style.css" type="text/css" media="screen" charset="utf-8" />
    
    <!--[if lt IE 9]>
      <link rel="stylesheet" href="ie.css" />
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <!-- Javascript -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php print base_url(); ?>js/notify.js"></script>
    <script type="text/javascript" src="<?php print base_url(); ?>js/placeholder.js"></script>
    <script type="text/javascript" src="<?php print base_url(); ?>js/egs.js"></script>
    
<script language="javascript" type="text/javascript">
<!--
/****************************************************
     Documents Popup        Author: Eric King
     Url: http://redrival.com/eak/index.shtml
****************************************************/
var win=null;
function NewWindow(mypage,myname,w,h,scroll,pos){
if(pos=="random"){LeftPosition=(screen.width)?Math.floor(Math.random()*(screen.width-w)):100;TopPosition=(screen.height)?Math.floor(Math.random()*((screen.height-h)-75)):100;}
if(pos=="center"){LeftPosition=(screen.width)?(screen.width-w)/2:100;TopPosition=(screen.height)?(screen.height-h)/2:100;}
else if((pos!="center" && pos!="random") || pos==null){LeftPosition=0;TopPosition=20}
settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',location=no,directories=no,status=yes,menubar=no,toolbar=no,resizable=no';
win=window.open(mypage,myname,settings);}
// -->
</script>

<script type="text/javascript" src="<?php print base_url(); ?>formfieldlimiter.js">

/***********************************************
* Form field Limiter v2.0- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* Visit Project Page at http://www.dynamicdrive.com for full source code
***********************************************/

</script>


</head>
<body>
	<?php include_once("analyticstracking.php") ?>
	
	<?php $this->load->view('response'); ?>

	<div id="container">
	
	<!-- header -->
	<header>
		<h1 id="logo">Admin Control Panel</h1>
		<div id="userinfo">
			<div class="intro">
				<?php _t('gen_welcome_back'); ?>; <?php print $this->session->userdata('nick'); ?> 
				[ <a href="<?php print site_url('nickserv/set'); ?>">Account Settings</a> | <a href="<?php print site_url('main/logout'); ?>"><?php _t('gen_logout'); ?></a> ] <br />
				<br />
			</div>
		</div>
	</header>
        
	<!-- application "window" -->
	<div id="application">
	