<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
			
			<h2><img src=<?php print base_url(); ?>ico/star.png> <?php print ucfirst(strtolower($this->config->item('atheme_operserv'))); ?> &gt; Channels Waiting to be Reviewed</h2>
			
			The channels <i>(if any)</i> listed below are awaiting their Channel Registration review.  Please review the below channels immediately!

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
						<b>ACTIVATE</b> will accept the Channel Registration and notify the user via <b><?php print ucfirst(strtolower($this->config->item('atheme_memoserv'))); ?></b> (memo) of acceptance.  <b><?php print ucfirst(strtolower($this->config->item('atheme_chanserv'))); ?></b> will join immediately if a user is present in the channel, otherwise it will join as soon as someone joins the channel.<br>
						<b>REJECT</b> will deny the Channel Registration and notify the user via <b><?php print ucfirst(strtolower($this->config->item('atheme_memoserv'))); ?></b> (memo) of the rejection. 
					</div>
				</section>

				<section>
					<label>
						Channel
					</label>
					<div>
						<b>CHANNEL</b> is the channel as shown in the above waiting list.  Please ensure you enter the correct channel name when reviewing a channel.
					</div>
				</section>
        	
				<section>
					<label>
						Please refresh your Waiting List and see that your action went through!
					</label>
					<div>
						After you review a channel, you must click the 'Refresh' button (to the side) to refresh the waiting list.  (Otherwise, it will appear your submission did not go through)
					</div>
				</section>
				</form>
				
			</div>
			
			<div class="column right">
				
				<h3><img src=<?php print base_url(); ?>ico/issue.png> Review a Channel</h3>
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
						Channel
					</label>
					<div>
						<input name="rev_channel" size="35" maxlength="50" type="text" placeholder="#<?php _t('gen_channel'); ?>" class="required" />
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
				</section> <form method="link" action="<?php print site_url('operserv/waiting'); ?>">
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