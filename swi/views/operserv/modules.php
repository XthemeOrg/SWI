<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
			
			<h2><img src=<?php print base_url(); ?>ico/star.png> <?php print ucfirst(strtolower($this->config->item('atheme_operserv'))); ?> &gt; <?php _t('os_modules'); ?></h2>

			<p><h3 style="color: red;"><?php _t('gen_warning'); ?></h3> <?php _t('os_module_warn'); ?></p>

			<!-- load module -->
			<div class="column left">
				
				<form action="" method="post">
				<section>
					<label>
						<?php _t('gen_module'); ?>
					</label>
					<div>
						<input type="text" name="module_name" placeholder="modules/path/module_name" class="required" />
						<br /><br />
						<img src=<?php print base_url(); ?>ico/lightbulb.png> <input type="submit" name="submit" value="<?php _t('os_module_load'); ?>" class="button primary" />
					</div>
				</section>

				<input type="hidden" name="load_module" value="1" />
				</form>

			</div>

			<!-- unload module -->
			<div class="column right">

				<form action="" method="post">
				<section>
					<label>
						<?php _t('gen_module'); ?>
					</label>
					<div>
						<select name="module_name">
							<?php foreach ($modules as $mod) : ?>
								<option><?php print $mod; ?></option>
							<?php endforeach; ?>
						</select>
						<br /><br />
						<img src=<?php print base_url(); ?>ico/brainstorming.png> <input type="submit" name="submit" value="<?php _t('os_module_unload'); ?>" class="button primary danger" /> <img src=<?php print base_url(); ?>ico/busy.png> 
					</div>
				</section>

				<input type="hidden" name="unload_module" value="1" />
				</form>
				
			</div>

			<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>