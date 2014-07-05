<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
			
			<h2><img src=<?php print base_url(); ?>ico/administrative-docs.png> <?php print ucfirst(strtolower($this->config->item('atheme_nickserv'))); ?> &gt; <?php _t('ns_password'); ?></h2>
			<p><?php _t('ns_password_desc'); ?></p>
			
			<form action="" method="post">
			<section>
				<label><?php _t('gen_password'); ?></label>
				<div>
					<input name="password" size="35" maxlength="50" type="password" placeholder="<?php _t('gen_password'); ?>" class="required" />
				</div>
			</section>
				
			<section>
				<label><?php _t('gen_retype_password'); ?></label>
				<div>
					<input name="password_again" size="35" maxlength="50" type="password" placeholder="<?php _t('gen_retype_password'); ?>" class="required" />
					<br /><br />
					<input type="submit" value="<?php _t('gen_update'); ?>" class="button primary" />
				</div>
			</section>
			
			<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>