<?php $this->load->view('header'); ?>
	<?php $this->load->view('navigation'); ?>
	
		<!-- The content -->
		<section id="content">
		
			<h2><img src=<?php print base_url(); ?>ico/email.png> <?php print ucfirst(strtolower($this->config->item('atheme_memoserv'))); ?> &gt; <?php _t('gen_list'); ?></h2>

				<form action="" method="post">
<input type="radio" name="delete_allmemos" value="1">All Memos<br>
<input type="radio" name="delete_oldmemos" value="1">Read Memos<br>
			<input type="submit" name="submit" value="Delete" class="button danger" />
</form>
			
			<?php if (isset($response)) : ?>
				<p class="hlight"><?php print nl2br($response); ?></p>
			<?php endif; ?>

			<div class="memo heading">
				<div class="memofrom"><strong><?php _t('gen_from'); ?></strong></div>
				<div class="memodate"><strong><?php _t('gen_date'); ?></strong></div>
				<div class="memostatus"><strong><?php _t('gen_status'); ?></strong></div>
				<div class="memoactions"><strong><?php _t('gen_actions'); ?></strong></div>
			</div>

			<?php foreach ($memos as $memo) : ?>	
			<div class="memo">
				<div class="memofrom"><?php print $memo[2]; ?></div>
				<div class="memodate"><?php print $memo[3]; ?></div>
				<div class="memostatus"><?php print ucfirst($memo[4]); ?></div>
				<div class="memoactions button-group">
					<a href="<?php print site_url("memoserv/viewmemo/{$memo[1]}"); ?>" class="button primary"><?php _t('gen_open'); ?></a>
					<a href="<?php print site_url("memoserv/delmemo/{$memo[1]}"); ?>" class="button danger"><?php _t('gen_delete'); ?></a>
				</div>
    		</div>
    		<?php endforeach; ?>

						
			<div class="clear">&nbsp;</div>
		</section>
	</div>
          
<?php $this->load->view('footer'); ?>