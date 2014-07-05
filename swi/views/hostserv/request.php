<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
		
			<h2><img src=<?php print base_url(); ?>ico/sitemap.png> <?php print ucfirst(strtolower($this->config->item('atheme_hostserv'))); ?> &gt; <?php _t('hs_request'); ?></h2>
		
			<form action="" method="post" name="vhostform"">
			<section>
				<label for="hostname">
					<?php _t('gen_hostname'); ?>
					<small><?php _t('hs_request_hostname_hint'); ?>.</small>
				</label>
				<div>
					<input name="hostname" id="hostname" size="35" maxlength="50" type="text" placeholder="<?php _t('gen_hostname'); ?>" class="required" />
					<br /><div id="vhost-status"></div><br />
					<img src=<?php print base_url(); ?>ico/process.png> <input type="submit" name="submit" value="<?php _t('gen_update'); ?>" class="primary button" />
				</div>
			</section>
			</form>
			
<script type="text/javascript">

fieldlimiter.setup({
	thefield: document.vhostform.hostname, //reference to form field
	maxlength: 50,
	statusids: ["vhost-status"], //id(s) of divs to output characters limit in the form [id1, id2, etc]. If non, set to empty array [].
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