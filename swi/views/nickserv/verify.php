<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
			
			<h2><img src=<?php print base_url(); ?>ico/address.png> <?php print ucfirst(strtolower($this->config->item('atheme_nickserv'))); ?> &gt; VERIFY Account</h2>
			<div>
				
				<p>To VERIFY a New Account or Email Address change, please select the operation below and input the key Services have emailed to the address on your account.  <br><br> <strong>NOTE:</strong> All verifications must be completed within 24 hours of registration or email change, otherwise the registration will be purged and/or email address will be reverted.<br>* Staff are unable to reverse any dropped registrations or email address reversals.<br>** Registrations that dropped for non-verification will be available to users again as the registration is dropped.</p>
				<form action="" method="post">
				<section>
					<label>VERIFY</label>
					<div>
<select name="ver_operation">
	<option>REGISTER</option>
	<option>EMAILCHG</option>
</select>

						<input name="ver_key" size="35" maxlength="50" type="text" placeholder="VERIFY Key" class="required" />
						<br /><br />
						<input type="submit" value="Verify" class="button primary" />
					</div>	
				</section>
				
			</div>
			
			<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>