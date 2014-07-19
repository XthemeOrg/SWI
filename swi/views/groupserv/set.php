<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
			
			<h2><img src=<?php print base_url(); ?>ico/administrative-docs.png> <?php print ucfirst(strtolower($this->config->item('atheme_groupserv'))); ?> &gt; Group Settings</h2>
			<div class="box-content">
				<p class="hlight">
		
				Here you can change your Group's Settings in <strong><?php print ucfirst(strtolower($this->config->item('atheme_groupserv'))); ?></strong> that will allow you to better customize your group and how it is ran as well as maintained.  You can also grant other users in your Group the ability to modify flags by granting them the <strong>+s</strong> flag.		
		
				</p>
			</div>
			<div class="column left"><form>
			<h3><img src=<?php print base_url(); ?>ico/consulting.png> Settings Information </h3>
			
							
				<section>
					<label>
						Channel
					</label>
					<div>
						Sets the group's <strong>channel</strong>.<br>
					</div>
				</section>			
				<section>
					<label>
						Description
					</label>
					<div>
						Sets the group <strong>description</strong>.<br>
					</div>
				</section>
                                
				<section>
					<label>
						Email
					</label>
					<div>
						Sets the group <strong>email address</strong>.<br>
					</div>
				</section>

				<section>
					<label>
						JoinFlags
					</label>
					<div>
						Sets the <strong>flags</strong> users will be given when they <strong>JOIN</strong> the group.<br>
					</div>
				</section>
				
				<section>
					<label>
						Open
					</label>
					<div>
						Sets the group as <strong>open for anyone</strong> to join.<br>
					</div>
				</section>

				<section>
					<label>
						Public
					</label>
					<div>
						Sets the group as <strong>public</strong>.<br>
					</div>
				</section>
				
				<section>
					<label>
						URL
					</label>
					<div>
						Sets the group <strong>URL</strong>.<br>
					</div>
				</section>
				</form>
				
			</div>

			<div class="column right">
			<h3><img src=<?php print base_url(); ?>ico/config.png> Change Settings </h3>			
			<form action="" method="post">
				<section>
					<label>
						Group
					</label>
					<section>
						<input name="group" id="group" size="35" maxlength="100" type="text" placeholder="!GroupName" class="required" />						<br /><br />
					</section>
						
					<label>
						Setting
					</label>
					<section>
<select name="option" id="option">
	<option>Open</option>
	<option>Public</option>
</select>
					</section>
<section>
<input type="radio" name="value" value="ON">ON<br>
<input type="radio" name="value" value="OFF">OFF
						<br /><br />
						<input type="submit" name="submit" value="Toggle Group Setting" class="button primary" /><input type="hidden" name="gs_set" value="1" />	<br /><br /></form>

						
			<h3><img src=<?php print base_url(); ?>ico/config.png> Additional Settings </h3>			
			<form action="" method="post">
				<section>
					<label>
						Group
					</label>
					<section>
						<input name="group" id="group" size="35" maxlength="100" type="text" placeholder="!GroupName" class="required" />						<br /><br />
					</section>
					
					<label>
						Setting
					</label>
					<section>
<select name="option" id="option">
	<option>Channel</option>
	<option>Description</option>
	<option>Email</option>
	<option>JoinFlags</option>
	<option>URL</option>
</select>
					</section>
<section>
						<input name="value" id="value" size="35" maxlength="200" type="text" placeholder="Value" class="required" />						<br /><br />
						<input type="submit" name="submit" value="Toggle Group Setting" class="button primary" /><input type="hidden" name="gs_set" value="1" />	<br /><br />
					</div>	
				</section>
			</form>
			

			<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>