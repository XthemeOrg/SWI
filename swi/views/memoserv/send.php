<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
		
			<h2><img src=<?php print base_url(); ?>ico/email.png> <?php print ucfirst(strtolower($this->config->item('atheme_memoserv'))); ?> &gt; <?php _t('ms_send'); ?></h2>
			
			<?php if (isset($nickname) && !$nickname) : ?>
			
				<form action="" method="post" name="memoform"">
				<section>
					<label for="nickname">
						<?php _t('gen_username'); ?>
						<small><?php _t('ms_send_nickname_hint'); ?>.</small>
					</label>
					<div>
						<input name="nickname" id="nickname" <?php print "value='{$nickname}'"; ?> size="35" maxlength="50" type="text" placeholder="<?php _t('gen_username'); ?>" class="required" />
					</div>
				</section>
				
				<section>
					<label for="thememo">
						<?php _t('gen_memo'); ?>
					</label>
					<div>
						<textarea name="thememo" id="thememo"></textarea>
						<br /><div id="memo-status"></div><br />
						<input type="submit" name="submit" value="<?php _t('gen_send'); ?>" class="primary button" />
					</div>
				</section>				
				</form>
				
<script type="text/javascript">

fieldlimiter.setup({
	thefield: document.memoform.thememo, //reference to form field
	maxlength: 300,
	statusids: ["memo-status"], //id(s) of divs to output characters limit in the form [id1, id2, etc]. If non, set to empty array [].
	onkeypress:function(maxlength, curlength){ //onkeypress event handler
		if (curlength<maxlength) //if limit hasn't been reached
			this.style.border="2px solid gray" //"this" keyword returns form field
		else
			this.style.border="2px solid red"
	}
})

</script>
							
			<?php else : ?>
			
				<form action="" method="post" name="memoform"">
				<section>
					<label for="nickname">
						<?php _t('gen_username'); ?>
						<small><?php _t('ms_send_nickname_hint'); ?>.</small>
					</label>
					<div>
						<input name="nickname" id="nickname" <?php print "placeholder='{$nickname}'"; ?> size="35" maxlength="50" type="text" class="required" />
					</div>
				</section>
				
				<section>
					<label for="thememo">
						<?php _t('gen_memo'); ?>
					</label>
					<div>
						<textarea name="thememo" id="thememo" maxlength="300"></textarea>
						<br /><div id="memo-status"></div><br />
						<img src=<?php print base_url(); ?>ico/communication.png> <input type="submit" name="submit" value="<?php _t('gen_send'); ?>" class="primary button" />
					</div>
				</section>

				</form>
				
<script type="text/javascript">

fieldlimiter.setup({
	thefield: document.memoform.thememo, //reference to form field
	maxlength: 300,
	statusids: ["memo-status"], //id(s) of divs to output characters limit in the form [id1, id2, etc]. If non, set to empty array [].
	onkeypress:function(maxlength, curlength){ //onkeypress event handler
		if (curlength<maxlength) //if limit hasn't been reached
			this.style.border="2px solid gray" //"this" keyword returns form field
		else
			this.style.border="2px solid red"
	}
})

</script>
							
			<?php endif; ?>
			
		<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>