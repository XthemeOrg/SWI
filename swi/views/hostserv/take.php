<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
		
			<h2><img src=<?php print base_url(); ?>ico/sitemap.png> <?php print ucfirst(strtolower($this->config->item('atheme_hostserv'))); ?> &gt; <?php _t('hs_take'); ?></h2>
		
			<form action="" method="post">
			<section>
				<label>
					<?php _t('gen_hostname'); ?>
					<small><?php _t('hs_take_hint'); ?></small>
				</label>
				<div>
					<input name="hostname" size="35" maxlength="50" type="text" placeholder="<?php _t('gen_hostname'); ?>" class="required" />
					<br /><br />
					<img src=<?php print base_url(); ?>ico/process.png> <input type="submit" name="submit" value="<?php _t('hs_take'); ?>" class="primary button" />
				</div>
			</section>
			</form>
					
		<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>