<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
			
			<h2><img src=<?php print base_url(); ?>ico/administrative-docs.png> <?php print ucfirst(strtolower($this->config->item('atheme_chanserv'))); ?> &gt; Channel Settings</h2>
			<div class="box-content">
				<p class="hlight">
		
				Here you can change your Channel's Settings in <strong><?php print ucfirst(strtolower($this->config->item('atheme_chanserv'))); ?></strong> that will allow you to better customize your channel and how it is ran as well as maintained.  You can also grant other users in your Channels the ability to modify flags by granting them the <strong>+s</strong> flag.		
		
				</p>
			</div>
			<div class="column left"><form>
			<h3><img src=<?php print base_url(); ?>ico/consulting.png> Settings Information </h3>
			
							
				<section>
					<label>
						Antiflood
					</label>
					<div>
						Set your Channel's <b>Antiflood</b> action. (KICKBAN, QUIET, AKILL or OFF)<br>
					</div>
				</section>			
				<section>
					<label>
						Email
					</label>
					<div>
						Set your Channel's <b>Email Address</b>.<br>
					</div>
				</section>
                                
				<section>
					<label>
						Entrymsg
					</label>
					<div>
						Set the ENTRYMSG Notice that <?php print ucfirst(strtolower($this->config->item('atheme_chanserv'))); ?> or a <?php print ucfirst(strtolower($this->config->item('atheme_botserv'))); ?> bot will send to users joining your channel.<br>
					</div>
				</section>

				<section>
					<label>
						Guard
					</label>
					<div>
						<b>ON</b> will cause <?php print ucfirst(strtolower($this->config->item('atheme_chanserv'))); ?> or a <?php print ucfirst(strtolower($this->config->item('atheme_botserv'))); ?> bot to join and manage your channel from inside the channel.  When disabled, <?php print ucfirst(strtolower($this->config->item('atheme_chanserv'))); ?> will manage your channel from outside the channel.<br>
					</div>
				</section>
				
				<section>
					<label>
						KeepTopic
					</label>
					<div>
						<b>ON</b> causes <?php print ucfirst(strtolower($this->config->item('atheme_chanserv'))); ?> to preserve the channel topic, even if the channel is empty or if the topic is lost in a netsplit.<br>
					</div>
				</section>

				<section>
					<label>
						MLock
					</label>
					<div>
						Set your Channel's <b>MODE Lock</b> to ensure the correct modes are always or never set.<br>
					</div>
				</section>
				
				<section>
					<label>
						Restricted
					</label>
					<div>
						<b>ON</b> causes <?php print ucfirst(strtolower($this->config->item('atheme_chanserv'))); ?> to KICKBAN users joining your channel that are not: <b>a)</b> On <?php print ucfirst(strtolower($this->config->item('atheme_chanserv'))); ?>'s access list or have applicable flags for the channel, <b>b)</b> IDENTIFY'd to <?php print ucfirst(strtolower($this->config->item('atheme_nickserv'))); ?> before joining.<br>
					</div>
				</section>
				
				<section>
					<label>
						Secure
					</label>
					<div>
						<b>ON</b> causes <?php print ucfirst(strtolower($this->config->item('atheme_chanserv'))); ?> to prevent users not on the access list or with applicable flags to gain Operator status on the channel. <br>
					</div>
				</section>
                                
    				<section>
					<label>
						URL
					</label>
					<div>
						Sets your Channel's <b>URL</b> which is shown to users as they join your channel by the server. <br>
					</div>
				</section>

				<section>
					<label>
						Verbose
					</label>
					<div>
						<b>ON</b> causes <?php print ucfirst(strtolower($this->config->item('atheme_chanserv'))); ?> to broadcast events to channel users; such as Access changes, Channel Settings, etc. <br>
					</div>
				</section>				
				</form>
				
			</div>

			<div class="column right">
			<h3><img src=<?php print base_url(); ?>ico/config.png> Change Settings </h3>			
			<form action="" method="post">
				<section>
					<label>
						Channel
					</label>
					<section>
						<input name="channel" id="channel" size="35" maxlength="100" type="text" placeholder="#Channel" class="required" />						<br /><br />
					</section>
						
					<label>
						Setting
					</label>
					<section>
<select name="option" id="option">
	<option>Guard</option>
	<option>KeepTopic</option>
	<option>Restricted</option>
	<option>Secure</option>
	<option>Verbose</option>
</select>
					</section>
<section>
<input type="radio" name="value" value="ON">ON<br>
<input type="radio" name="value" value="OFF">OFF
						<br /><br />
						<input type="submit" name="submit" value="Toggle Channel Setting" class="button primary" /><input type="hidden" name="set_copts" value="1" />	<br /><br /></form>

						
			<h3><img src=<?php print base_url(); ?>ico/config.png> Additional Settings </h3>			
			<form action="" method="post">
				<section>
					<label>
						Channel
					</label>
					<section>
						<input name="channel" id="channel" size="35" maxlength="100" type="text" placeholder="#Channel" class="required" />						<br /><br />
					</section>
					
					<label>
						Setting
					</label>
					<section>
<select name="option" id="option">
	<option>AntiFlood</option>
	<option>Email</option>
	<option>EntryMsg</option>
	<option>MLock</option>
	<option>TopicLock</option>
	<option>URL</option>
</select>
					</section>
<section>
						<input name="value" id="value" size="35" maxlength="200" type="text" placeholder="Value" class="required" />						<br /><br />
						<input type="submit" name="submit" value="Toggle Channel Setting" class="button primary" /><input type="hidden" name="set_copts" value="1" />	<br /><br />
					</div>	
				</section>
			</form>
			

			<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>