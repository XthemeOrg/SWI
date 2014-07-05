<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
		
			<h2><img src=<?php print base_url(); ?>ico/brainstorming.png> <?php print ucfirst(strtolower($this->config->item('atheme_chanserv'))); ?> &gt; <?php _t('cs_kick'); ?></h2>
		
			<form action="" method="post" name="kickform"">
			
			<section>
	          	<label for="channel">
	          		<?php _t('gen_channel'); ?>
	          		<small><?php _t('cs_kick_channel_hint'); ?>.</small>
	          	</label>
	          	<div>
	          		<input name="channel" id="channel" size="35" maxlength="50" type="text" placeholder="#<?php _t('gen_channel'); ?>" class="required" />
	          	</div>
			</section>
        	
			<section>
	          	<label for="nick">
	          		<?php _t('gen_username'); ?>
	          		<small><?php _t('cs_kick_nickname_hint'); ?>.</small>
	          	</label>
	          	<div>
	          		<input name="nick" id="nick" size="35" maxlength="50" type="text" placeholder="<?php _t('gen_username'); ?>" class="required" />
	          	</div>
        	</section>
        	
			<section>
	          	<label for="reason">
	          		<?php _t('gen_reason'); ?>
	          		<small><?php _t('form_optional'); ?><?php _t('cs_kick_reason_hint'); ?>.</small>
	          	</label>
	          	<div>
	          		<input name="reason" id="reason" size="35" maxlength="255" type="text" placeholder="<?php _t('gen_reason'); ?>" class="required" />
	          		<br /><div id="reason-status"></div><br />
	          		<img src=<?php print base_url(); ?>ico/process.png> <input type="submit" name="submit" value="<?php _t('gen_update'); ?>" class="primary button" />
	          	</div>
        	</section>
        	
			</form>

<script type="text/javascript">

fieldlimiter.setup({
	thefield: document.kickform.reason, //reference to form field
	maxlength: 255,
	statusids: ["reason-status"], //id(s) of divs to output characters limit in the form [id1, id2, etc]. If non, set to empty array [].
	onkeypress:function(maxlength, curlength){ //onkeypress event handler
		if (curlength<maxlength) //if limit hasn't been reached
			this.style.border="2px solid gray" //"this" keyword returns form field
		else
			this.style.border="2px solid red"
	}
})

</script>
		
			<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>