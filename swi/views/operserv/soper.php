<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
			
			<h2><img src=<?php print base_url(); ?>ico/star.png> <?php print ucfirst(strtolower($this->config->item('atheme_operserv'))); ?> &gt; <?php _t('os_soper'); ?></h2>

			<!-- akill list -->
			<table>
			<thead>
				<th><?php _t('gen_account'); ?></th>
				<th><?php _t('gen_type'); ?></th>
				<th><?php _t('gen_operclass'); ?></th>
			</thead>
			<tbody>
			<?php if (!empty($sopers)) : ?>
				<?php foreach ($sopers as $sop) : ?>
				<tr>
					<td><?php print $sop[0]; ?></td>
					<td><?php print $sop[1]; ?></td>
					<td><?php print $sop[2]; ?></td>
				</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr>
					<td colspan="5">None found.</td>
				</tr>
			<?php endif; ?>
			</tbody>
			</table>


			<div class="column left">
				<h3><?php _t('os_soper_add'); ?></h3>
			
				<form action="" method="post">
				<section>
					<label>
						<?php _t('os_soper_name'); ?>
					</label>
					<div>
						<input type="text" name="soper_name" placeholder="<?php _t('os_soper_name'); ?>" class="required" />
					</div>
				</section>

				<section>
					<label>
						<?php _t('os_soper_class'); ?>
					</label>
					<div>
						<input type="text" name="soper_class" placeholder="<?php _t('os_soper_class'); ?>" class="required" />
						<br /><br />
						<img src=<?php print base_url(); ?>ico/process.png> <input type="submit" name="submit" value="<?php _t('os_soper_add'); ?>" class="button primary" />
					</div>
				</section>

				<input type="hidden" name="add_soper" value="1" />
				</form>

			</div>

			<div class="column right">
				<h3><?php _t('os_soper_del'); ?></h3>

				<form action="" method="post">
				<section>
					<label>
						<?php _t('os_soper_name'); ?>
					</label>
					<div>
						<input type="text" name="soper_name" placeholder="<?php _t('os_soper_name'); ?>" class="required" />
						<br /><br />
						<img src=<?php print base_url(); ?>ico/process.png> <input type="submit" name="submit" value="<?php _t('os_soper_del'); ?>" class="button primary danger" />
					</div>
				</section>

				<input type="hidden" name="del_soper" value="1" />
				</form>

			</div>
		
			<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>