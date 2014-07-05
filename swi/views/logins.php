<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
			
			<div>
				<h2><img src=<?php print base_url(); ?>ico/lightbulb.png> Current Sessions</h2>
				<p class="hlight"><strong>Current IRC Logins:</strong>
								
								<?php if (isset($response)): ?>
					<?php foreach($response as $line) : ?>
						<?php print $line; ?><br>
					<?php endforeach; endif; ?>
				</p>


			</div>
			
			<div class="column left">
			</div>
			
			<div class="column right">
			</div>
			
			<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>
