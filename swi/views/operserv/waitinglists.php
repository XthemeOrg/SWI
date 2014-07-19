<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
			
			<h2><img src=<?php print base_url(); ?>ico/star.png> <?php print ucfirst(strtolower($this->config->item('atheme_operserv'))); ?> &gt; Requests Waiting to be Reviewed</h2>
			
			Please choose the type of <i>WAITING</i> list you are wanting to review. 

			<div class="box-content">
					<p class="hlight">

			<?php if ($this->config->item('atheme_cswaiting')) : ?>	
* <a href=<?php print site_url('operserv/waiting'); ?>><strong>Channel Reviews</strong></a> - Activate or Reject channels awaiting registration with <strong><?php print ucfirst(strtolower($this->config->item('atheme_chanserv'))); ?></strong>. <BR>
			<?php endif; ?>
			<?php if ($this->config->item('atheme_hswaiting')) : ?>
* <a href=<?php print site_url('operserv/hswaiting'); ?>><strong>vHost Reviews</strong></a> - Activate or Reject customized vHosts requests with <strong><?php print ucfirst(strtolower($this->config->item('atheme_hostserv'))); ?></strong>. 
			<?php endif; ?>

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