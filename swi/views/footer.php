		<!-- 
			// SWI - Services Web Interface (v3)
			// Additional Functionality, Bug Fixes, Cosmetic Fixes and more by 
			// siniStar (Austin Ellis) <siniStar@IRC4Fun.net>
		-->

		<footer id="copyright">[ <a href="<?php print base_url(); ?>" target="_top"><img src=<?php print base_url(); ?>ico/world.png></a> <?php if ($this->config->item('social_media')) : ?>| <a href="<?php print $this->config->item('fb_url'); ?>" target="_blank"><img src=<?php print base_url(); ?>ico/facebook.png></a> | <a href="<?php print $this->config->item('tw_url'); ?>" target="_blank"><img src=<?php print base_url(); ?>ico/twitter.png></a><?php endif; ?> ] &nbsp;&nbsp;&nbsp; <a href="http://atheme.github.io/" target="_top">Services Web Interface</a> (<a href="http://atheme.github.io/" target="_top">SWI <?php print $this->config->item('swi_vers'); ?></a>) [<b><a href="<?php print site_url('main/credits'); ?>"><?php _t('gen_swicredits'); ?></a></b>] (<a href="<?php print site_url('main/cookies'); ?>"><?php _t('gen_swicookies'); ?></a>)</footer>
	</div>
</body>
</html>
