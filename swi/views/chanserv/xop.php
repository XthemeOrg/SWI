<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
		
			<h2><img src=<?php print base_url(); ?>ico/user.png> <?php print ucfirst(strtolower($this->config->item('atheme_chanserv'))); ?> &gt; <?php _t('cs_xop'); ?></h2>
		
			<?php if (isset($response)) : ?>
				<h3><?php _t('cs_flags_response'); ?></h3>
				<p class="hlight">
					<?php print nl2br(print_r($response, true)); ?>
				</p>
			<?php endif; ?>
			
			<div class="column left">
			
				<h3><?php _t('cs_flags_tab_list'); ?></h3>
				<form action="" method="post">
				<section>
					<label>
						<?php _t('cs_xop'); ?>
					</label>
					<div>
						<select name="xop_type">
							<option>VOP</option>
							<option>HOP</option>
							<option>AOP</option>
							<option>SOP</option>
						</select>
					</div>
				</section>

				<section>
					<label>
						<?php _t('gen_channel'); ?>
					</label>
					<div>
						<input name="xop_channel" size="35" maxlength="50" type="text" placeholder="#<?php _t('gen_channel'); ?>" class="required" />
						<br /><br />
						<img src=<?php print base_url(); ?>ico/search.png> <input type="submit" name="submit" value="<?php _t('gen_list'); ?>" class="primary button" />
						<input type="hidden" name="list_xop" value="1" />
					</div>
				</section>
				</form>
				
			</div>
			
			<div class="column right">
				
				<h3><?php _t('cs_flags_tab_change'); ?></h3>
				<form action="" method="post">
				
				<section>
					<label>
						<?php _t('cs_xop'); ?>
					</label>
					<div>
						<select name="xop_type">
							<option>VOP</option>
							<option>HOP</option>
							<option>AOP</option>
							<option>SOP</option>
						</select>
					</div>
				</section>

				<section>
					<label>
						<?php _t('gen_channel'); ?>
					</label>
					<div>
						<input name="xop_channel" size="35" maxlength="50" type="text" placeholder="#<?php _t('gen_channel'); ?>" class="required" />
					</div>
				</section>

				<section>
					<label>
						<?php _t('gen_action'); ?>
					</label>
					<div>
						<select name="xop_action">
							<option value="add"><?php _t('gen_add'); ?></option>
							<option value="del"><?php _t('gen_delete'); ?></option>
						</select>
					</div>
				</section>
        	
				<section>
					<label>
						<?php _t('gen_username'); ?>
					</label>
					<div>
						<input name="xop_nick" size="35" maxlength="50" type="text" placeholder="<?php _t('gen_username'); ?>" class="required" />
						<br /><br />
						<img src=<?php print base_url(); ?>ico/settings.png> <input type="submit" name="submit" value="<?php _t('gen_update'); ?>" class="primary button" />
						<input type="hidden" name="set_xop" value="1" />
					</div>
				</section>
				</form>
				
			</div>
			<div class="clear">&nbsp;</div>
			
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>