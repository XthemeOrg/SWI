<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
			
			<h2><img src=<?php print base_url(); ?>ico/archives.png> <?php print ucfirst(strtolower($this->config->item('atheme_botserv'))); ?> &gt; Delete a Bot</h2>
			<div class="box-content">
				<p class="hlight">
		
				Delete or Remove a BotServ bot...		
		
				</p>
			</div>
			<div class="column left"><form>
			<h3><img src=<?php print base_url(); ?>ico/consulting.png> Bot Removal Guide </h3>
			
				<section>
					<label>
						Bot Nickname
					</label>
					<div>
						What is the BotServ bot's <strong>current nickname</strong>?<br>
					</div>
				</section>			

				</form>
				
			</div>

			<div class="column right">
			<h3><img src=<?php print base_url(); ?>ico/config.png> Delete (Remove) Bot </h3>			
			<form action="" method="post">
				<section>
					<label>
						Current Nickname
					</label>
					<section>
						<input name="nickname" id="nickname" size="35" maxlength="100" type="text" placeholder="Bot Nickname" class="required" />						<br /><br />
					</section>
					
						<br /><br />
						<input type="submit" name="submit" value="Kill the Bot!" class="button primary" />	<br /><br /></form>

						</div>			

			<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>