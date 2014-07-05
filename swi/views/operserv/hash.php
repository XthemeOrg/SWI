<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
			
			<h2><img src=<?php print base_url(); ?>ico/star.png> <?php print ucfirst(strtolower($this->config->item('atheme_operserv'))); ?> &gt; <?php _t('os_passhash'); ?></h2>

			<?php if (isset($hash)) : ?>
				<pre id="ccopy"><?php print $hash; ?></pre>
			<?php endif; ?>

			<div>
				
				<form action="" method="post">
				<section>
					<label>
						<?php _t('gen_password'); ?>
					</label>
					<div>
						<input type="text" name="password" class="required" />
					</div>
				</section>

				<section>
					<label>
						<?php _t('gen_enc'); ?>
					</label>
					<div>
						<select name="enc_type">
							<option value="CRYPT">POSIX-style crypt</option>
							<option>MD5</option>
							<option>SHA1</option>
						</select>
						<br /><br />
						<img src=<?php print base_url(); ?>ico/process.png> <input type="submit" name="submit" value="<?php _t('os_gen_hash'); ?>" class="button primary" />
					</div>
				</section>
				</form>

			</div>

			<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>