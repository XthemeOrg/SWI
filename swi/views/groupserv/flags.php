<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
		
			<h2><img src=<?php print base_url(); ?>ico/user.png> <?php print ucfirst(strtolower($this->config->item('atheme_groupserv'))); ?> &gt; <?php _t('gen_flags'); ?></h2>
		
			<?php if (isset($response) && is_array($response)) : ?>
				<h3><?php _t('gs_flags_response'); ?></h3>
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
					<label for="group">
						Group
					</label>
					<div>
						<input name="group" id="group" size="35" maxlength="50" type="text" placeholder="!GroupName" class="required" />
						<br /><br />
						<img src=<?php print base_url(); ?>ico/search.png> <input type="submit" name="submit" value="List Flags" class="primary button" />
						<input type="hidden" name="list_flags" value="1" />
					</div>
				</section>
				</form>
				
			</div>
			
			<div class="column right">
				
				<h3><?php _t('cs_flags_tab_change'); ?></h3>
				<form action="" method="post">
				
				<section>
					<label for="group">
						Group
					</label>
					<div>
						<input name="group" id="group" size="35" maxlength="50" type="text" placeholder="!GroupName" class="required" />
					</div>
				</section>
        	
				<section>
					<label for="nick">
						Nickname
					</label>
					<div>
						<input name="nick" id="nick" size="35" maxlength="50" type="text" placeholder="Nickname" class="required" />
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
					<td>f</td>
					<td>Enables modification of group access list.</td>
				</tr>
				<tr>
					<td>F</td>
					<td>Grants full founder access.</td>
				</tr>
				<tr>
					<td>m</td>
					<td>Read memos sent to the group.</td>
				</tr>
				<tr>
					<td>c</td>
					<td>Have channel access in channels where the group has sufficient privileges.</td>
				</tr>
				<tr>
					<td>v</td>
					<td>Take vhosts offered to the group through HostServ.</td>
				</tr>
				<tr>
					<td>s</td>
					<td>Ability to use GroupServ SET commands on the group.</td>
				</tr>
				<tr>
					<td>b</td>
					<td>Ban a user from the group. The user will not be able to join the group with the JOIN command and it will not show up in their NickServ INFO or anywhere else. NOTE that setting this flag will NOT automatically remove the users' privileges (if applicable). </td>
				</tr>
				<tr>
					<td>i</td>
					<td>Grants the ability to invite users to the group.</td>
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