<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="distribution" content="global" />
    <meta name="robots" content="follow, all" />
    <meta name="language" content="en" />
    
    <title>Sign-In - SWI3</title>
    
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
				<li class="current"><a href="<?php print site_url('login'); ?>"><?php _t('gen_login'); ?></a></li>
				<?php if ($this->config->item('web_register')) : ?>
					<li><a href="<?php print site_url('register'); ?>"><?php _t('gen_register'); ?></a></li>
				<?php endif; ?>

			</ul>
			</nav>
			
			<section id="content">
			
				<div id="login" class="tab">
					<form action="" method="post">
					<section>
						<label>
							<img src=<?php print base_url(); ?>images/information.png> Services Web Interface v3 
						</label>
            	      	<div>
				<small> Manage your <strong>Nickname(s)</strong>, <strong>Channels</strong>, <strong>Memos</strong> & <strong>vHosts</strong> via the World Wide Web with <i>more ways to manage what is important to you from anywhere!</i></small>
						</div>
					</section>
					<section>
						<label for="username"><?php _t('gen_username'); ?></label>
						<div>
							<input type="text" name="username" placeholder="<?php _t('gen_username'); ?>" class="required" />
						</div>
					</section>
					
					<section>
						<label for="password"><?php _t('gen_password'); ?></label>
						<div>
							<input type="password" name="password" id="password" placeholder="<?php _t('gen_password'); ?>" class="required" />
							<br /><br /><img src=<?php print base_url(); ?>ico/login.png> <input type="submit" value="<?php _t('gen_login'); ?>" class="button primary" />
							<a href="#" class="button"><?php _t('gen_cancel'); ?></a>
						</div>
					</section>


                    <?php if ($this->config->item('login_recaptcha')) : ?>
                    <section>
                        <?php print $recaptcha; ?>
                    </section>
                    <?php endif; ?>

					</form>
				</div>
						
			</section>
		</div>
        
		<footer id="copyright">[ <a href="<?php print base_url(); ?>" target="_top"><img src=<?php print base_url(); ?>ico/world.png></a> <?php if ($this->config->item('social_media')) : ?>| <a href="<?php print $this->config->item('fb_url'); ?>" target="_blank"><img src=<?php print base_url(); ?>ico/facebook.png></a> | <a href="<?php print $this->config->item('tw_url'); ?>" target="_blank"><img src=<?php print base_url(); ?>ico/twitter.png></a><?php endif; ?> ] &nbsp;&nbsp;&nbsp; Services Web Interface (SWI <?php print $this->config->item('swi_vers'); ?>) [<b><a href="<?php print site_url('main/credits'); ?>"><?php _t('gen_swicredits'); ?></a></b>]</footer>
	</div>

</body>
</html>