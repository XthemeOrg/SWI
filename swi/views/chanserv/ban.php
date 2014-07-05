<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
		
			<h2><img src=<?php print base_url(); ?>ico/brainstorming.png> <?php print ucfirst(strtolower($this->config->item('atheme_chanserv'))); ?> &gt; <?php _t('cs_ban'); ?></h2>
		
			<form action="" method="post">
			<section>
	          	<label for="channel">
	          		<?php _t('gen_channel'); ?>
	          		<small><?php _t('cs_ban_channel_hint'); ?>.</small>
	          	</label>
	          	<div>
	          		<input name="channel" id="channel" size="35" maxlength="50" type="text" placeholder="#<?php _t('gen_channel'); ?>" class="required" />
	          	</div>
			</section>
        	
			<section>
	          	<label for="nick">
	          		<?php _t('gen_username'); ?>
	          		<small><?php _t('cs_ban_nick_hint'); ?>.</small>
	          	</label>
    	      	<div>
    	      		<input name="nick" id="nick" size="35" maxlength="50" type="text" placeholder="<?php _t('gen_username'); ?>" class="required" />
    	      	</div>
			</section>
        	
        	<section>
        		<label for="unban">
        			<?php _t('cs_ban_unban_label'); ?>?
        			<small><?php _t('cs_ban_unban_hint'); ?>?</small>
        		</label>
        		<div>
        			<input type="checkbox" name="unban" id="unban" class="required" placeholder="" value="1" />
        			<br /><br />
        			<img src=<?php print base_url(); ?>ico/process.png> <input type="submit" name="submit" value="<?php _t('gen_update'); ?>" class="primary button" />
        		</div>
        	</section>
			</form>
		
			<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>