<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
			
			<div>
				<h2><img src=<?php print base_url(); ?>ico/lock.png> Insufficient Access</h2>
<p>
	<img src=<?php print base_url(); ?>ico/login.png> <strong>You do not have sufficient access to utilize/view this resource!</strong><br>
	<center><a href="<?php print site_url('main'); ?>">Please return to the main dashboard</a></center>
</p>
			</div>
			

			</div>
			
			<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>