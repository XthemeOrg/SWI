<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="distribution" content="global" />
    <meta name="robots" content="follow, all" />
    <meta name="language" content="en" />
    
    <title>Register - SWI3</title>
    
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
        
</head>
<body>
	<?php $this->load->view('response'); ?>
	
	<div id="container" class="logincontainer">
		<header>
			<h1 id="logo">Admin Control Panel</h1> 
		</header>
		
		<!-- login window -->
		<div id="application">
			<nav id="secondary">
			<ul>
				<li><a href="<?php print site_url('login'); ?>"><?php _t('gen_login'); ?></a></li>
				<?php if ($this->config->item('web_register')) : ?>
					<li class="current"><a href="<?php print site_url('register'); ?>"><?php _t('gen_register'); ?></a></li>
				<?php endif; ?>

				</ul>
			</nav>
			
			<section id="content">
				
				<?php if (!$this->session->userdata('is_authed')
						 && $this->config->item('web_register')) : ?>

				<div id="register" class="tab">
					<br /><br />
					<form action="" method="post">
					
					<section>
						<label for="username">
							<?php _t('gen_username'); ?>
							<small>Select a nickname to register</small>
						</label>
            	      	<div>
							<input name="username" id="username" size="35" maxlength="31" type="text" placeholder="<?php _t('gen_username'); ?>" class="required" />
						</div>
					</section>


					<section>
						<label for="password">
							<?php _t('gen_password'); ?>
							<small>Select a secure password.</small>
						</label>
						<div>
							<input name="password" id="password" size="35" maxlength="50" type="password" placeholder="<?php _t('gen_password'); ?>" class="required" />
						</div>
					</section>

					<section>
						<label for="repassword">
							<?php _t('gen_retype_password'); ?>
							<small>Re-Type the password above.</small>
						</label>
						<div>
							<input name="repassword" id="repassword" size="35" maxlength="50" type="password" placeholder="<?php _t('gen_retype_password'); ?>" class="required" />
						</div>
					</section>

					<section>
						<label for="email">
							<?php _t('gen_email'); ?>
							<small>Email must be valid.</small>
						</label>
						<div>
                	    	<input name="email" id="email" size="35" type="text" placeholder="<?php _t('gen_email'); ?>" class="required" />
				<img src=<?php print base_url(); ?>ico/issue.png> You must be <strong>13 or older</strong> to register.<br /><br />
				<img src=<?php print base_url(); ?>ico/current-work.png> You will need to use the <strong>Verify</strong> command on IRC or use the <strong>Verify</strong> console via this interface to validate your email address within 24 hours of registration; otherwise the registration will be dropped. <br /><br />
                	    	<br /><br /><img src=<?php print base_url(); ?>ico/hire-me.png> <input type="submit" value="<?php _t('gen_register'); ?>" class="button primary" />
							<a href="#" class="button"><?php _t('gen_cancel'); ?></a>
                	    </div>
					</section>
					
                    <?php if ($this->config->item('register_recaptcha')) : ?>
                    <section>
                        <?php print $recaptcha; ?>
                    </section>
                    <?php endif; ?>
					
					</form>
				</div>
				
				<?php endif; ?>
			</section>
		</div>
        
		<footer id="copyright">[ <a href="<?php print base_url(); ?>" target="_top"><img src=<?php print base_url(); ?>ico/world.png></a> <?php if ($this->config->item('social_media')) : ?>| <a href="<?php print $this->config->item('fb_url'); ?>" target="_blank"><img src=<?php print base_url(); ?>ico/facebook.png></a> | <a href="<?php print $this->config->item('tw_url'); ?>" target="_blank"><img src=<?php print base_url(); ?>ico/twitter.png></a><?php endif; ?> ] &nbsp;&nbsp;&nbsp; <a href="http://www.xtheme.org/" target="_top">Services Web Interface</a> (<a href="http://www.xtheme.org/" target="_top">SWI <?php print $this->config->item('swi_vers'); ?></a>) [<b><a href="<?php print site_url('main/credits'); ?>"><?php _t('gen_swicredits'); ?></a></b>] </br>(<a href="<?php print site_url('main/cookies'); ?>"><?php _t('gen_swicookies'); ?></a>)</footer>

		</div>

</body>
</html>
