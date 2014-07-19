<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
			
			<h2><img src=<?php print base_url(); ?>ico/user.png> <?php print ucfirst(strtolower($this->config->item('atheme_groupserv'))); ?> &gt; Group's Channel Access..</h2>
			<div class="box-content">
		
			<?php if (isset($response)) : ?>
			<h3><?php _t('gs_listchans_response'); ?></h3>
			<p class="hlight">
				<?php if (is_array($response)) : ?>
					<?php foreach ($response as $line) : ?>
						<?php print $line; ?> <br />
					<?php endforeach; ?>
				<?php else : ?>
					<?php print $response; ?>
				<?php endif; ?>
			</p>
			<?php endif; ?>

			<a id="taketable" href="#" class="button">Check a Group's Channel Access</a>
			<br /><br />
			
			<div id="taketable">

			<h2>Check a Group's Channel Access</h2>
		
			<form action="<?php print site_url('groupserv/listchans'); ?>" method="post">
				<section>
					<label>
						Group
					<small>	* Group to check for Channel Access.</small></label>

				<div>
				<input name="group" size="35" maxlength="65" type="text" placeholder="!GroupName" class="required" />
					<br /><br />
					<img src=<?php print base_url(); ?>ico/suppliers.png> <input type="submit" name="submit" value="Check Group Access!" class="primary button" />
				</div>
			</section>
			</form>
			</div>

			
			<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>
