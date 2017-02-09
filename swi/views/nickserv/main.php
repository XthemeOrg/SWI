<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
			
			<h2><img src=<?php print base_url(); ?>ico/my-account.png> <?php print ucfirst(strtolower($this->config->item('atheme_nickserv'))); ?> &gt; <?php _t('ns_info'); ?></h2>
			<div class="box-content">
				<p class="hlight"><?php if(isset($response)){print $response;} ?></p>
			</div>
			
			<form action="" method="post">
				<section>
					<label>
						<?php _t('gen_username'); ?>
						<small><?php _t('ns_info_hint'); ?></small>
					</label>
					<div>
						<input name="nickname" size="35" maxlength="50" type="text" placeholder="<?php _t('gen_username'); ?>" class="required" />
						<br /><br />
						<img src=<?php print base_url(); ?>ico/search.png> <input type="submit" value="<?php _t('ns_get_info'); ?>" class="button primary" />
					</div>	
				</section>
			</form>

			<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>