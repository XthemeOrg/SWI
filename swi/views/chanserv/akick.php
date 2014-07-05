<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
		
			<h2><img src=<?php print base_url(); ?>ico/brainstorming.png> <?php print ucfirst(strtolower($this->config->item('atheme_chanserv'))); ?> &gt; <?php _t('cs_akick'); ?></h2>
			
				<?php if (isset($response) && is_array($response)) : ?>
				<p class="hlight">
					<?php foreach ($response as $line) : ?>
						<?php print $line; ?><br />
					<?php endforeach; ?>
				</p>
				<?php endif; ?>
			
			<div class="column left">
				<h3><?php _t('cs_akick_list'); ?></h3>
				
				
				<form action="" method="post">
				<section>
					<label for="channel">
						<?php _t('gen_channel_name'); ?>
						<small><?php _t('cs_akick_channel_hint'); ?>.</small>
					</label>
					<div>
						<input name="channel" id="channel" size="35" maxlength="50" type="text" placeholder="#<?php _t('gen_channel'); ?>" class="required" />
						<br /><br />
						<img src=<?php print base_url(); ?>ico/search.png> <input type="submit" value="<?php _t('gen_list'); ?>" name="submit" class="primary button" />
					</div>
				
					<input type="hidden" name="list_akicks" value="1" />
				</section>
				</form>
				
			</div>
			
			<div class="column right">
				<h3><?php _t('cs_akick_manage_list'); ?></h3>
				<form action="" method="post" name="akickform"">
				<section>
					<label for="channel">
						<?php _t('gen_channel_name'); ?>
					</label>
					<div>
						<input name="channel" id="channel" size="35" maxlength="50" type="text" placeholder="#<?php _t('gen_channel'); ?>" class="required" />
					</div>
				</section>
					
				<section>
					<label for="nick">
						<?php _t('gen_username'); ?>
					</label>
					<div>
						<input name="nick" id="nick" size="35" maxlength="50" type="text" placeholder="<?php _t('gen_username'); ?>" class="required" />
					</div>
				</section>
					
				<section>
					<label for="action">
						Action
					</label>
					<div>
						<select name="action" id="action">
							<option value="add"><?php _t('gen_add'); ?></option>
							<option value="del"><?php _t('gen_delete'); ?></option>
						</select>	
					</div>
				</section>

				<section>
					<label>
						AKICK Type
					</label>
					<div>
						<select name="akick_type" id="akick_type">
							<option value="!P"><?php _t('gen_perma'); ?></option>
							<option value="!T"><?php _t('gen_timed'); ?></option>
						</select>
					</div>
				</section>

				<!-- timed popup -->
				<section id="timed-ak">
					<label>
						<?php _t('gen_duration'); ?>
						<small>Format: 1d2h</small>
					</label>
					<div>
						<input type="text" name="akick_duration" id="akick_duration" class="required" />
					</div>
				</section>

					
				<section>
					<label for="reason">
						<?php _t('gen_reason') ; ?>
					</label>
					<div>
						<input name="reason" id="reason" size="35" maxlength="224" type="text" placeholder="<?php _t('gen_reason'); ?>" class="optional" />
						<br /><div id="reason-status"></div><br />
						<img src=<?php print base_url(); ?>ico/process.png> <input type="submit" value="<?php _t('gen_update'); ?>" class="primary button" />
					</div>
				
					<input type="hidden" name="set_akick" value="1" />
				</section>
				</form>
				
<script type="text/javascript">

fieldlimiter.setup({
	thefield: document.akickform.reason, //reference to form field
	maxlength: 224,
	statusids: ["reason-status"], //id(s) of divs to output characters limit in the form [id1, id2, etc]. If non, set to empty array [].
	onkeypress:function(maxlength, curlength){ //onkeypress event handler
		if (curlength<maxlength) //if limit hasn't been reached
			this.style.border="2px solid gray" //"this" keyword returns form field
		else
			this.style.border="2px solid red"
	}
})

</script>
				
			</div>
						
			<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>