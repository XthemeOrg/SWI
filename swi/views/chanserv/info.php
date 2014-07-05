<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
			
			<h2><img src=<?php print base_url(); ?>ico/archives.png> <?php print ucfirst(strtolower($this->config->item('atheme_chanserv'))); ?> &gt; <?php _t('gen_info'); ?></h2>
			<div class="box-content">
		
				<?php if (isset($response)) : ?>
					<h3><?php _t('cs_info_response'); ?></h3>
					<p class="hlight">
					<?php if (is_array($response)) : ?>
						<?php foreach ($response as $line) : ?>
							<?php print trim($line); ?> <br />
						<?php endforeach; ?>
					<?php else : ?>
						<?php print $response; ?>
					<?php endif; ?>
					</p>
				<?php endif; ?>
			
				<form action="" method="post">
				<section>
					<label for="channel">
						<?php _t('gen_channel'); ?>
						<small><?php _t('cs_info_channel_hint'); ?>.</small>
					</label>
					<div>
						<input name="channel" id="channel" size="35" maxlength="50" type="text" placeholder="#<?php _t('gen_channel'); ?>" class="required" />
						<br /><br />
						<img src=<?php print base_url(); ?>ico/search.png> <input type="submit" value="<?php _t('cs_get_info'); ?>" class="primary button" />
						<input type="reset" value="<?php _t('gen_clear'); ?>" class="button" />
					</div>
				</section>
				</form>
			</div>
			
			<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>
