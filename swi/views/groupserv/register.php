<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
		
			<h2><img src=<?php print base_url(); ?>ico/user.png> <?php print ucfirst(strtolower($this->config->item('atheme_groupserv'))); ?> &gt; Register a Group</h2>
		
			<form action="" method="post">
			<section>
				<label>
					Group Name
					<small>* The name of your new Group.</small>
				</label>
				<label>
					Group
					<small>The name of the <?php print ucfirst(strtolower($this->config->item('atheme_groupserv'))); ?> group you are wanting to create.</small>
				</label>
				<div>
					<input name="group" size="35" maxlength="65" type="text" placeholder="!GroupName" class="required" />
					<br /><br />
					<img src=<?php print base_url(); ?>ico/hire-me.png> <input type="submit" name="submit" value="Create Group!" class="primary button" />
				</div>
			</section>
			</form>
					
		<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>