<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
			
			<h2><img src=<?php print base_url(); ?>ico/address.png> <?php print ucfirst(strtolower($this->config->item('atheme_nickserv'))); ?> &gt; <?php _t('ns_email'); ?></h2>
			<div>
				
				<p><?php _t('ns_email_desc'); ?></p>
				<form action="" method="post">
				<section>
					<label><?php _t('gen_account_email'); ?></label>
					<div>
						<input name="email" size="35" maxlength="50" type="text" placeholder="<?php _t('gen_email'); ?>" class="required" />
						<br /><br />
						<input type="submit" value="<?php _t('gen_update'); ?>" class="button primary" />
					</div>	
				</section>
				
			</div>
			
			<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>