<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
			
			<h2><img src=<?php print base_url(); ?>ico/archives.png> <?php print ucfirst(strtolower($this->config->item('atheme_botserv'))); ?> &gt; BotServ Botlist</h2>
			<div class="box-content">
		
			<?php if (isset($response)) : ?>
			<h3><?php _t('bs_botlist_response'); ?></h3>
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

			<a id="taketable" href="#" class="button">Assign one of the above Offered Bots</a>
			<br /><br />
			
			<div id="taketable">

			<h2>Assign an Offered BotServ bot</h2>
		
			<form action="<?php print site_url('botserv/assign'); ?>" method="post">
				<section>
					<label>
						Channel
					<small>	* You must have Founder level access on the channel you are assigning a bot to.</small></label>

				<div>
				<input name="channel" size="35" maxlength="50" type="text" placeholder="#Channel" class="required" />
				<input name="bot" size="35" maxlength="50" type="text" placeholder="Bot" class="required" />
					<br /><br />
					<img src=<?php print base_url(); ?>ico/process.png> <input type="submit" name="submit" value="Assign It!" class="primary button" />
				</div>
			</section>
			</form>
			</div>

			
			<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>
