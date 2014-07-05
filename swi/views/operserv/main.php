<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
			
			<h2><img src=<?php print base_url(); ?>ico/star.png> <?php print ucfirst(strtolower($this->config->item('atheme_operserv'))); ?> &gt; <?php _t('gen_access'); ?></h2>

			<div class="box-content">
				<p class="hlight">
					<?php array_shift($specs); array_pop($specs); foreach ($specs as $spec): ?>
						<?php print $spec; ?><br /><br />
					<?php endforeach; ?>
				</p>
			</div>



			<!-- send global -->
			<div class="column left">
				<h3><?php _t('os_global'); ?></h3>
				
				<form action="" method="post">
				<section>
					<label>
						<?php _t('os_global'); ?>
					</label>
					<div>
						<textarea name="g_msg"></textarea>
						<br /><br />
						<img src=<?php print base_url(); ?>ico/pen.png> <input type="submit" name="submit" value="<?php _t('os_send_global'); ?>" class="button primary" />
					</div>
				</section>

				<input type="hidden" name="global_message" value="1" />
				</form>
			</div>

			<!-- clearchan command -->
			<div class="column right">
				<h3><?php _t('os_clear_channel'); ?></h3>

				<form action="" method="post">
				<section>
					<label>
						<?php _t('gen_action'); ?>
					</label>
					<div>
						<select name="clear_action">
							<option value="KICK">Kick</option>
							<option value="KILL">Kill</option>
							<option value="AKILL">AKill</option>
						</select>
					</div>
				</section>

				<section>
					<label>
						<?php _t('gen_channel'); ?>
					</label>
					<div>
						<input type="text" name="channel" placeholder="#<?php _t('gen_channel'); ?>" class="required" />
					</div>
				</section>

				<section>
					<label>
						<?php _t('gen_reason'); ?>
					</label>
					<div>
						<input type="text" name="clear_reason" class="required" />
						<br /><br />
						<img src=<?php print base_url(); ?>ico/process.png> <input type="submit" name="submit" value="<?php _t('os_clear_channel'); ?>" class="button primary danger" />
					</div>
				</section>

				<input type="hidden" name="clear_channel" value="1" />
				</form>
			</div>

			<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>