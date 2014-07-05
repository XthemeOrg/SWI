<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
			
			<h2><img src=<?php print base_url(); ?>ico/star.png> <?php print ucfirst(strtolower($this->config->item('atheme_botserv'))); ?> &gt; Bot management</h2>
			
			Please choose the type of <i>bot management</i> you want to perform... 

			<div class="box-content">
					<p class="hlight">

* <a href=<?php print site_url('botserv/addbot'); ?>><strong>Add a <?php print ucfirst(strtolower($this->config->item('atheme_botserv'))); ?> bot</strong></a> - Add a new <?php print ucfirst(strtolower($this->config->item('atheme_botserv'))); ?> bot for private use or public use <BR>
* <a href=<?php print site_url('botserv/changebot'); ?>><strong>Change a <?php print ucfirst(strtolower($this->config->item('atheme_botserv'))); ?> bot</strong></a> - Modify an existing <?php print ucfirst(strtolower($this->config->item('atheme_botserv'))); ?> bot <em>(change it's <strong>nickname/username/hostname/realname</strong>)</em> <BR>
* <a href=<?php print site_url('botserv/delbot'); ?>><strong>Delete a <?php print ucfirst(strtolower($this->config->item('atheme_botserv'))); ?> bot</strong></a> - Remove an existing <?php print ucfirst(strtolower($this->config->item('atheme_botserv'))); ?> bot from private or public use

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