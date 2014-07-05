<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
		
			<h2><img src=<?php print base_url(); ?>ico/sitemap.png> <?php print ucfirst(strtolower($this->config->item('atheme_hostserv'))); ?> &gt; <?php _t('hs_offer'); ?></h2>
		
			<?php if (isset($response)) : ?>
			<h3><?php _t('hs_list_response'); ?></h3>
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
			
			<a id="taketable" href="#" class="button">Take one of the above Offered vHosts</a>
			<br /><br />
			
			<div id="taketable">

			<h2><?php _t('hs_take'); ?> an Offered Hostname</h2>
		
			<form action="<?php print site_url('hostserv/take'); ?>" method="post">
			<section>
				<label>
					<?php _t('gen_hostname'); ?>
					<small>* Must be a valid offered hostname from the above list</small>
				</label>
				<div>
					<input name="hostname" size="35" maxlength="50" type="text" placeholder="<?php _t('gen_hostname'); ?>" class="required" />
					<br /><br />
					<img src=<?php print base_url(); ?>ico/process.png> <input type="submit" name="submit" value="<?php _t('hs_take'); ?>" class="primary button" />
				</div>
			</section>
			</form>
			</div>

					
		<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>