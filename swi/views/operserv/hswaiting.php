<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
			
			<h2><img src=<?php print base_url(); ?>ico/star.png> <?php print ucfirst(strtolower($this->config->item('atheme_operserv'))); ?> &gt; VHosts Waiting to be Reviewed</h2>
			
			The users <i>(if any)</i> listed below are awaiting their VHost Request review.  Please review the below user requests immediately!

			<div class="box-content">
					<?php if (isset($response)) : ?>
					<p class="hlight">
					<?php if (is_array($response)) : ?>
						<?php foreach ($response as $line) : ?>
							<?php print trim($line); ?> <br />
						<?php endforeach; ?>
					<?php else : ?>
						<?php print $response; ?>
					<?php endif; ?>
					</p>
				<?php endif; ?>
				</p>
			</div>

			<div class="column left">
<form>				
				<h3><img src=<?php print base_url(); ?>ico/consulting.png> Please Note:</h3>				
				<section>
					<label>
						Decision
					</label>
					<div>
						<b>ACTIVATE</b> will accept the VHost Request and notify the user via <b><?php print ucfirst(strtolower($this->config->item('atheme_memoserv'))); ?></b> (memo) of acceptance.  <b>HostServ</b> will immediately set the user's requested VHost if they are online, otherwise it will set it upon their next session.<br>
						<b>REJECT</b> will deny the VHost Request and notify the user via <b><?php print ucfirst(strtolower($this->config->item('atheme_memoserv'))); ?></b> (memo) of the rejection.  The user's (if any) current VHost will remain in effect.
					</div>
				</section>

				<section>
					<label>
						Nickname
					</label>
					<div>
						<b>Nickname</b> is the user requesting a vHost as shown in the above waiting list.  Please ensure you enter the correct nickname when reviewing a VHost.
					</div>
				</section>
        	
				<section>
					<label>
						Please refresh your Waiting List and see that your action went through!
					</label>
					<div>
						After you review a vhost, you must click the 'Refresh' button (to the side) to refresh the waiting list.  (Otherwise, it will appear your submission did not go through)
					</div>
				</section>
				</form>
				
			</div>
			
			<div class="column right">
				
				<h3><img src=<?php print base_url(); ?>ico/issue.png> Review a VHost Request</h3>
				<form action="" method="post">
				
				<section>
					<label>
						Decision
					</label>
					<div>
						<select name="rev_decision">
							<option>ACTIVATE</option>
							<option>REJECT</option>
						</select>
					</div>
				</section>

				<section>
					<label>
						Nickname
					</label>
					<div>
						<input name="rev_nick" size="35" maxlength="50" type="text" placeholder="Nickname" class="required" />
					</div>
				</section>
        	
				<section>
					<label>
						Process (finalize) the Review
					</label>

					<div>
						<img src=<?php print base_url(); ?>ico/process.png> <input type="submit" name="submit" value="Process Review" class="primary button" />
						<input type="hidden" name="set_review" value="1" /></form>
					</div>
				</section> <form method="link" action="<?php print site_url('operserv/hswaiting'); ?>">
				<section>
					<label>
						After Reviewing; update the list...
					</label>
					<div>
						<img src=<?php print base_url(); ?>ico/refresh.png> <input type="submit" value="Refresh" class="button"></form>
					</div>
				</section>
				
			</div>




			<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>