<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
			
			<h2><img src=<?php print base_url(); ?>ico/archives.png> <?php print ucfirst(strtolower($this->config->item('atheme_botserv'))); ?> &gt; Change a Bot</h2>
			<div class="box-content">
				<p class="hlight">
		
				Change or Modify a BotServ bot...		
		
				</p>
			</div>
			<div class="column left"><form>
			<h3><img src=<?php print base_url(); ?>ico/consulting.png> Bot Modification Guide </h3>
			
				<section>
					<label>
						Current Nickname
					</label>
					<div>
						What is the BotServ bot's <strong>current nickname</strong>?<br>
					</div>
				</section>			
				<section>
					<label>
						Nickname
					</label>
					<div>
						What should the BotServ bot's <strong>new nickname</strong> be?<br>
					</div>
				</section>			
				<section>
					<label>
						User@
					</label>
					<div>
						What should the BotServ bot's <strong>new user</strong>@ be? <em>(do not include @ sign)</em><br>
					</div>
				</section>
                                
				<section>
					<label>
						@Hostname
					</label>
					<div>
						What should the BotServ bot's @<strong>new hostname</strong> be? <em>(do not include @ sign)</em><br>
					</div>
				</section>

				<section>
					<label>
						Realname
					</label>
					<div>
						What should the BotServ bot's <strong>new Real Name</strong> be?<br>						
					</div>
				</section>
				
				</form>
				
			</div>

			<div class="column right">
			<h3><img src=<?php print base_url(); ?>ico/config.png> Change (Modify) Bot </h3>			
			<form action="" method="post">
				<section>
					<label>
						Current Nickname
					</label>
					<section>
						<input name="oldnick" id="oldnick" size="35" maxlength="100" type="text" placeholder="Current Nickname" class="required" />						<br /><br />
					</section>
					
				<section>
					<label>
						New Nickname
					</label>
					<section>
						<input name="nickname" id="nickname" size="35" maxlength="100" type="text" placeholder="New Nickname" class="required" />						<br /><br />
					</section>
					
					<label>
						User@
					</label>
					<section>
						<input name="user" id="user" size="35" maxlength="100" type="text" placeholder="Username" class="required" />						<br /><br />
					</section>
						
					<label>
						@Hostname
					</label>
					<section>
						<input name="host" id="host" size="35" maxlength="100" type="text" placeholder="Hostname" class="required" />						<br /><br />
					</section>

					<label>
						Realname
					</label>
					<section>
						<input name="realname" id="realname" size="35" maxlength="100" type="text" placeholder="Real Name" class="required" />						<br /><br />
					</section>
					
						<br /><br />
						<input type="submit" name="submit" value="Change the Bot!" class="button primary" />	<br /><br /></form>

						</div>			

			<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>