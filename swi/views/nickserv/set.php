<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
			
			<h2><img src=<?php print base_url(); ?>ico/my-account.png> <?php print ucfirst(strtolower($this->config->item('atheme_nickserv'))); ?> &gt; Account Settings</h2>
			<div class="box-content">
				<p class="hlight"><?php if(isset($response)){print $response;} ?></p>
			</div>
			<div class="column left"><form>
			<h3><img src=<?php print base_url(); ?>ico/consulting.png> Settings Information </h3>
			
			
				<section>
					<label>
						EmailMemos
					</label>
					<div>
						<b>ON</b> will enable <?php print ucfirst(strtolower($this->config->item('atheme_memoserv'))); ?> to email your memos to you as you receive one.<br>
					</div>
				</section>

				<section>
					<label>
						Enforce
					</label>
					<div>
						<b>ON</b> will enable additional protection for all nicknames on your account.  This will automatically change the nick of someone trying to use it without identifying in time, and temporarily block it's use, which can be removed at your discretion. See HELP RELEASE.<br>
					</div>
				</section>

				<section>
					<label>
						HideMail
					</label>
					<div>
						<b>ON</b> will not reveal your email address (except Staff) in INFO outputs.<br>
					</div>
				</section>
				
				<section>
					<label>
						NeverOp
					</label>
					<div>
						<b>ON</b> prevents users from adding you to any access lists.<br>
					</div>
				</section>

				<section>
					<label>
						NoMemo
					</label>
					<div>
						<b>ON</b> prevents users from sending you Memos via <?php print ucfirst(strtolower($this->config->item('atheme_memoserv'))); ?>.<br>
					</div>
				</section>
				
				<section>
					<label>
						NoOp
					</label>
					<div>
						<b>ON</b> prevents <?php print ucfirst(strtolower($this->config->item('atheme_chanserv'))); ?> or <?php print ucfirst(strtolower($this->config->item('atheme_botserv'))); ?> bots from setting modes upon you automatically in channels where you have access.<br>
					</div>
				</section>
				
				<section>
					<label>
						Private
					</label>
					<div>
						<b>ON</b> hides information about you from other users.<br>
					</div>
				</section>
				
				<section>
					<label>
						Please refresh after making changes!
					</label>
					<div>
						After you toggle an account setting, you must click the 'Refresh' button (to the side) to refresh the account information.  (Otherwise, it will appear your submission did not go through)
					</div>
				</section>
				</form>
				
			</div>

			<div class="column right">
			<h3><img src=<?php print base_url(); ?>ico/config.png> Change Settings </h3>			
			<form action="" method="post">
				<section>
					<label>
						Setting
						<small>The account setting you wish to change</small>
					</label></section>
					<section>
<select name="set_option">
	<option>EmailMemos</option>
	<option>Enforce</option>
	<option>HideMail</option>
	<option>NeverOp</option>
	<option>NoMemo</option>
	<option>NoOp</option>
	<option>Private</option>
</select>
					</section>
<section>
<input type="radio" name="set_value" value="ON">ON<br>
<input type="radio" name="set_value" value="OFF">OFF
						<br /><br />
						<input type="submit" name="submit" value="Toggle Account Setting" class="button primary" />	<br /><br />
					</div>	
				</section>
			</form>
			
			<form method="link" action="<?php print site_url('nickserv/set'); ?>">
				<section>
					<label>
						After making changes; refresh the output...
					</label>
						<img src=<?php print base_url(); ?>ico/refresh.png> <input type="submit" value="Refresh" class="button"></form>
				</section>

			<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>