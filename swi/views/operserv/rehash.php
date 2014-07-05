<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
			
			<h2><img src=<?php print base_url(); ?>ico/star.png> <?php print ucfirst(strtolower($this->config->item('atheme_operserv'))); ?> &gt; <?php _t('os_rehash'); ?></h2>
				
			<form action="" method="post">
			<section>
				<label>
					<?php _t('os_rehash_check'); ?>
					<small><?php _t('os_rehash_hint'); ?></small>
				</label>
				<div>
					<input type="text" name="rehash_check" class="required" />
					<br /><br />
					<img src=<?php print base_url(); ?>ico/brainstorming.png> <img src=<?php print base_url(); ?>ico/process.png>  <input type="submit" name="submit" value="<?php _t('os_rehash'); ?>" class="button primary danger" />
				</div>
			</section>
			</form>
		
			<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>