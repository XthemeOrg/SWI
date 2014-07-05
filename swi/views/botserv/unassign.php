<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
		
			<h2><img src=<?php print base_url(); ?>ico/sitemap.png> <?php print ucfirst(strtolower($this->config->item('atheme_botserv'))); ?> &gt; Unassign</h2>
		
			<form action="" method="post">
			<section>
				<label>
					Channel
					<small>* You must be the Founder of the channel to unassign a BotServ bot in it.</small>
				</label>
				<div>
					<input name="channel" size="35" maxlength="50" type="text" placeholder="#Channel" class="required" />
					<br /><br />
					<img src=<?php print base_url(); ?>ico/process.png> <input type="submit" name="submit" value="Unassign Bot!" class="primary button" />
				</div>
			</section>
			</form>
					
		<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>