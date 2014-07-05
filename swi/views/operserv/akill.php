<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
			
			<h2><img src=<?php print base_url(); ?>ico/star.png> <?php print ucfirst(strtolower($this->config->item('atheme_operserv'))); ?> &gt; <?php _t('os_akill'); ?></h2>

			<!-- akill list -->
			<table>
			<thead>
				<th>ID</th>
				<th><?php _t('os_akill_nick_host'); ?></th>
				<th><?php _t('os_akill_added'); ?></th>
				<th><?php _t('os_akill_expires'); ?></th>
				<th><?php _t('gen_reason'); ?></th>
			</thead>
			<tbody>
			<?php if (!empty($info)) : ?>
				<?php foreach ($info as $akill) : ?>
				<tr>
					<td id="aid"><?php print $akill['id']; ?></td>
					<td><?php print $akill['nick_host']; ?></td>
					<td><?php print $akill['added_by']; ?></td>
					<td><?php print $akill['expires']; ?></td>
					<td><?php print $akill['reason']; ?></td>
				</tr>
				<?php endforeach;?>
			<?php else : ?>
				<tr>
					<td colspan="5"><?php _t('os_akill_none'); ?></td>
				</tr>
			<?php endif; ?>
			</tbody>
			</table>


			<div class="column left">

				<h3><?php _t('os_akill_delete'); ?></h3>
				<form action="" method="post">
				
				<section>
					<label>
						ID
						<small><?php _t('os_akill_id_hint'); ?></small>
					</label>
					<div>
						<input type="text" name="akill_id" id="akill_id" placeholder="ID" class="required" />
						<br /><br />
						<img src=<?php print base_url(); ?>ico/process.png> <input type="submit" name="delakill" value="<?php _t('gen_delete'); ?>" class="button primary danger" />
					</div>
				</section>

				<input type="hidden" name="del_akill" value="1" />
				</form>
			
			</div>

			<div class="column right">
				
				<h3><?php _t('os_akill_add'); ?></h3>
				<form action="" method="post">
				
				<section>
					<label>
						<?php _t('os_akill_nick_host'); ?>
						<small>siniStar | foo@bar.com</small>
					</label>
					<div>
						<input type="text" name="nick_host" placeholder="<?php _t('os_akill_nick_host'); ?>" class="required" />
					</div>
				</section>

				<section>
					<label>
						<?php _t('gen_type'); ?>
					</label>
					<div>
						<select name="akill_type" id="akill_type">
							<option value="!P"><?php _t('gen_perma'); ?></option>
							<option value="!T"><?php _t('gen_timed'); ?></option>
						</select>
					</div>
				</section>

				<!-- timed popup -->
				<section id="timed">
					<label>
						<?php _t('gen_duration'); ?>
						<small>Format: 1d2h</small>
					</label>
					<div>
						<input type="text" name="duration" class="required" />
					</div>
				</section>

				<section>
					<label>
						<?php _t('gen_reason'); ?>
					</label>
					<div>
						<input type="text" name="reason" class="required" />
						<br /><br />
						<img src=<?php print base_url(); ?>ico/process.png> <input type="submit" name="submit" value="<?php _t('os_akill_add'); ?>" class="button primary" />
					</div>
				</section>

				<input type="hidden" name="add_akill" value="1" />
				</form>

			</div>
		
			<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>