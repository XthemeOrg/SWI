<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
		
			<h2><img src=<?php print base_url(); ?>ico/category.png> <?php print ucfirst(strtolower($this->config->item('atheme_chanserv'))); ?> &gt; <?php _t('cs_topic'); ?></h2>
			
			<form action="" method="post" name="TopicForm"">
			<section>
				<label for="channel">
					<?php _t('gen_channel'); ?>
					<small><?php _t('cs_topic_channel_hint'); ?>.</small>
				</label>
				<div>
					<input name="channel" id="channel" size="35" maxlength="50" type="text" placeholder="#<?php _t('gen_channel'); ?>" class="required" />
				</div>
			</section>
        	
        	<section>
	          	<label for="topic">
	          		<?php _t('gen_topic'); ?>
	          		<small><?php _t('cs_topic_topic_hint'); ?>.</small>	
	          	</label>
    	      	<div>
    	      		<input name="topic" id="topic" size="35" maxlength="307" type="text" placeholder="<?php _t('gen_topic'); ?>" class="required" />
    	      		<br /><div id="topic-status"></div><br />
    	      		<img src=<?php print base_url(); ?>ico/edit.png> <input type="submit" name="submit" value="<?php _t('gen_update'); ?>" class="primary button" />
    	      	</div>
			</section>
			</form>
			
<script type="text/javascript">

fieldlimiter.setup({
	thefield: document.TopicForm.topic, //reference to form field
	maxlength: 307,
	statusids: ["topic-status"], //id(s) of divs to output characters limit in the form [id1, id2, etc]. If non, set to empty array [].
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
