<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
		
			<h2><img src=<?php print base_url(); ?>ico/user.png> <?php print ucfirst(strtolower($this->config->item('atheme_chanserv'))); ?> &gt; <?php _t('gen_flags'); ?></h2>
		
			<?php if (isset($response) && is_array($response)) : ?>
				<h3><?php _t('cs_flags_response'); ?></h3>
				<p class="hlight">
				<?php foreach ($response as $line) : ?>
					<?php print $line; ?><br />
				<?php endforeach; ?>
				</p>
			<?php endif; ?>
			
			<div class="column left">
			
				<h3><?php _t('cs_flags_tab_list'); ?></h3>
				<form action="" method="post">
				<section>
					<label for="channel">
						<?php _t('gen_channel'); ?>
					</label>
					<div>
						<input name="channel" id="channel" size="35" maxlength="50" type="text" placeholder="#<?php _t('gen_channel'); ?>" class="required" />
						<br /><br />
						<img src=<?php print base_url(); ?>ico/search.png> <input type="submit" name="submit" value="<?php _t('gen_list'); ?>" class="primary button" />
						<input type="hidden" name="list_flags" value="1" />
					</div>
				</section>
				</form>
				
			</div>
			
			<div class="column right">
				
				<h3><?php _t('cs_flags_tab_change'); ?></h3>
				<form action="" method="post">
				
				<section>
					<label for="channel">
						<?php _t('gen_channel'); ?>
					</label>
					<div>
						<input name="channel" id="channel" size="35" maxlength="50" type="text" placeholder="#<?php _t('gen_channel'); ?>" class="required" />
					</div>
				</section>
        	
				<section>
					<label for="nick">
						<?php _t('gen_username'); ?>
					</label>
					<div>
						<input name="nick" id="nick" size="35" maxlength="50" type="text" placeholder="<?php _t('gen_username'); ?>" class="required" />
					</div>
				</section>
        				
				<section>
					<label for="flags">
						<?php _t('gen_flags'); ?>
					</label>
					<div>
						<input name="flags" id="flags" size="35" maxlength="50" type="text" placeholder="<?php _t('gen_flags'); ?>" class="required" />
						<br /><br />
						<img src=<?php print base_url(); ?>ico/settings.png> <input type="submit" name="submit" value="<?php _t('gen_update'); ?>" class="primary button" />
						<input type="hidden" name="set_flags" value="1" />
					</div>
				</section>
				</form>
				
			</div>
			<div class="clear">&nbsp;</div>
			
			<br />
			<img src=<?php print base_url(); ?>ico/consulting.png> <a id="flagstoggle" href="#" class="button"><?php _t('cs_flags_toggle'); ?></a>
			<br /><br />
			
			<div id="flagstable">
				<table>
				<thead>
				<tr>
					<th>Flag</th>
					<th>Information</th>
				</tr>
				</thead>
				
				<tbody>
				<tr>
					<td>v</td>
					<td>Enables use of the voice/devoice commands.</td>
				</tr>
				<tr>
					<td>V</td>
					<td>Enables automatic voice.</td>
				</tr>
<?php if ($this->config->item('ircd_ho')) : ?>
				<tr>
					<td>h</td>
					<td>Enables use of the halfop/dehalfop commands.</td>
				</tr>
				<tr>
					<td>H</td>
					<td>Enables automatic halfop.</td>
				</tr>
<?php endif; ?>
				<tr>
					<td>o</td>
					<td>Enables use of the op/deop commands.</td>
				</tr>
				<tr>
					<td>O</td>
					<td>Enables automatic op.</td>
				</tr>
<?php if ($this->config->item('ircd_qa')) : ?>
				<tr>
					<td>a</td>
					<td>Enables use of the protect/deprotect commands.</td>
				</tr>
				<tr>
					<td>q</td>
					<td>Enables use of the owner/deowner commands.</td>
				</tr>
<?php endif; ?>
				<tr>
					<td>s</td>
					<td>Enables use of the set command.</td>
				</tr>
				<tr>
					<td>i</td>
					<td>Enables use of the invite and getkey commands.</td>
				</tr>
				<tr>
					<td>r</td>
					<td>Enables use of the kick, kickban, ban and unban commands.</td>
				</tr>
				<tr>
					<td>R</td>
					<td>Enables use of the recover and clear commands.</td>
				</tr>
				<tr>
					<td>f</td>
					<td>Enables modification of channel access lists.</td>
				</tr>
				<tr>
					<td>t</td>
					<td>Enables use of the topic and topicappend commands.</td>
				</tr>
				<tr>
					<td>A</td>
					<td>Enables viewing of channel access lists.</td>
				</tr>
				<tr>
					<td>F</td>
					<td>Grants full founder access.</td>
				</tr>
				<tr>
					<td>b</td>
					<td>Enables automatic kickban.</td>
				</tr>
				<tr>
					<td>e</td>
					<td>Exempts from +b and enables unbanning self.</td>
				</tr>

				<tr>
					<td>*</td>
					<td>The special permission +* adds (-* removes) all permissions except +b and +F.</td>
				</tr>
				</tbody>
				</table>
			</div>
			
			<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>