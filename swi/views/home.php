<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
			
			<div>
				<h2><img src=<?php print base_url(); ?>ico/premium.png> <?php _t('gen_welcome'); ?></h2>
				<p class="hlight"><img src=<?php print base_url(); ?>ico/featured.png> You're connected to the <?php print $this->config->item('site_name'); ?>, giving you the ability to manage your <a href="<?php print site_url('nickserv'); ?>">nicknames</a>, <a href="<?php print site_url('chanserv/info'); ?>">channels</a> and <a href="<?php print site_url('memoserv'); ?>">memos</a> and even <a href="<?php print site_url('hostserv/offerlist'); ?>">vHosts</a> via the World Wide Web.<br><br>
				<IMG SRC="<?php print base_url(); ?>ico/new.png"> <strong>NEW</strong> You can now manage your <a href="<?php print site_url('nickserv/set'); ?>">Nickname Settings</a>, <a href="<?php print site_url('chanserv/set'); ?>">Channel Settings</a>, view your <a href="<?php print site_url('main/logins'); ?>">current sessions</a> & more, via the Services Web Interface!</p>


			</div>
			
			<div class="column left">

			
			</div>
			
			<div class="column right">
				<h2><img src=<?php print base_url(); ?>ico/flag.png> <?php _t('gen_channel_access'); ?></h2>
				<ul class="clist">
				<?php if (isset($response)): ?>
					<?php foreach($response as $line) : ?>
						<li><?php print $line; ?></li>
					<?php endforeach; endif; ?>
				</ul>
			</div>
			<a id="flagstoggle" href="#" class="button">Toggle Flags List</a>
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
				<tr>
					<td>h</td>
					<td>Enables use of the halfop/dehalfop commands.</td>
				</tr>
				<tr>
					<td>H</td>
					<td>Enables automatic halfop.</td>
				</tr>
				<tr>
					<td>o</td>
					<td>Enables use of the op/deop commands.</td>
				</tr>
				<tr>
					<td>O</td>
					<td>Enables automatic op.</td>
				</tr>
				<tr>
					<td>a</td>
					<td>Enables use of the protect/deprotect commands.</td>
				</tr>
				<tr>
					<td>q</td>
					<td>Enables use of the owner/deowner commands.</td>
				</tr>
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
					<td>S</td>
					<td>Marks the user as a successor.</td>
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
