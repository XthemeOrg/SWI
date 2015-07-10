		<?php if ($this->session->userdata('is_authed')) : ?>
		
		<?php
			if ($this->config->item('atheme_memoserv')) {
				$mdata = $this->memoserv_model->get_memos(TRUE);
				
				if (preg_match('/\((.*) new\)/sm', $mdata['data'], $regs))
					$new_memos = $regs[1];
				else
					$new_memos = FALSE;
			}
		?>
		
		<!-- primary navigation -->
		<nav id="primary">
			<ul>
				<li <?php print ((stristr(uri_string(), "main")) ? 'class="current"' : '') ?>><a href="<?php print site_url('main'); ?>"><span class="icon dashboard"></span><?php _t('gen_dashboard'); ?></a></li>
                
                <?php if ($this->config->item('atheme_nickserv')) : ?>
                	<li <?php print ((stristr(uri_string(), "nickserv")) ? 'class="current"' : '') ?>><a href="<?php print site_url('nickserv'); ?>"><span class="icon tables"></span><?php print ucfirst(strtolower($this->config->item('atheme_nickserv'))); ?></a></li>
                <?php endif; ?>
                
                <?php if ($this->config->item('atheme_chanserv')) : ?>
                	<li <?php print ((stristr(uri_string(), "chanserv")) ? 'class="current"' : '') ?>><a href="<?php print site_url('chanserv/info'); ?>"><span class="icon modal"></span><?php print ucfirst(strtolower($this->config->item('atheme_chanserv'))); ?></a></li>
                <?php endif; ?>
                
                <?php if ($this->config->item('atheme_memoserv')) : ?>
                	<li <?php print ((stristr(uri_string(), "memoserv")) ? 'class="current"' : '') ?>><a href="<?php print site_url('memoserv'); ?>"><span class="icon pencil"></span><?php print (($new_memos) ? '<span class="badge"> ' . $new_memos . '</span>' : ''); ?><?php print ucfirst(strtolower($this->config->item('atheme_memoserv'))); ?></a></li>
               	<?php endif; ?>
               	
               	<?php if ($this->config->item('atheme_hostserv')) : ?>
                	<li <?php print ((stristr(uri_string(), "hostserv")) ? 'class="current"' : '') ?>><a href="<?php print site_url('hostserv/offerlist'); ?>"><span class="icon newspaper"></span><?php print ucfirst(strtolower($this->config->item('atheme_hostserv'))); ?></a></li>
                <?php endif; ?>
		
                <?php if ($this->config->item('atheme_botserv')) : ?>
                	<li <?php print ((stristr(uri_string(), "botserv")) ? 'class="current"' : '') ?>><a href="<?php print site_url('botserv/botlist'); ?>"><span class="icon anchor"></span><?php print ucfirst(strtolower($this->config->item('atheme_botserv'))); ?></a></li>
                <?php endif; ?>
				
			<?php if ($this->config->item('atheme_groups')) : ?>
                <?php if ($this->config->item('atheme_groupserv')) : ?>
                	<li <?php print ((stristr(uri_string(), "groupserv")) ? 'class="current"' : '') ?>><a href="<?php print site_url('groupserv/listgroups'); ?>"><span class="icon gallery"></span><?php print ucfirst(strtolower($this->config->item('atheme_groupserv'))); ?></a></li>
                <?php endif; ?>
            <?php endif; ?>

                <?php if ($this->config->item('atheme_operserv') && $this->operserv_model->check_access()) : ?>
                	<li <?php print ((stristr(uri_string(), "operserv")) ? 'class="current"' : '') ?>><a href="<?php print site_url('operserv'); ?>"><span class="icon chart"></span><?php print ucfirst(strtolower($this->config->item('atheme_operserv'))); ?></a></li>
                <?php endif; ?>
			</ul>
		</nav>
            
		<!-- secondary navigation -->
		<nav id="secondary">
		<?php if (stristr(uri_string(), "main")) : ?>
		<ul>
			<li <?php print ((uri_string() === "main/home") ? 'class="current"' : '') ?>><a href="<?php print site_url('main'); ?>"><?php _t('gen_dashboard'); ?></a></li>
			<?php if ($this->config->item('atheme_listlogins')) : ?>
			<li <?php print ((uri_string() === "main/logins") ? 'class="current"' : '') ?>><a href="<?php print site_url('main/logins'); ?>"><?php _t('curr_logins'); ?></a></li>
			<?php endif; ?>
			<?php if ($this->config->item('staff_messages')) : ?>
			<li <?php print ((uri_string() === "main/staff_messages") ? 'class="current"' : '') ?>><a href="<?php print site_url('main/staff_messages'); ?>"><?php _t('msgs_staff'); ?></a></li>
			<?php endif; ?>
		</ul>
		<?php elseif (stristr(uri_string(), "nickserv")) : ?>
		<ul>
			<li <?php print ((uri_string() === "nickserv") ? 'class="current"' : '') ?>><a href="<?php print site_url('nickserv'); ?>"><?php _t('ns_info'); ?></a></li>
			<li <?php print ((uri_string() === "nickserv/password") ? 'class="current"' : '') ?>><a href="<?php print site_url('nickserv/password'); ?>"><?php _t('ns_password'); ?></a></li>
			<li <?php print ((uri_string() === "nickserv/email") ? 'class="current"' : '') ?>><a href="<?php print site_url('nickserv/email'); ?>"><?php _t('ns_email'); ?></a></li>
			<li <?php print ((uri_string() === "nickserv/set") ? 'class="current"' : '') ?>><a href="<?php print site_url('nickserv/set'); ?>"><?php _t('ns_settings'); ?></a></li>
			<li <?php print ((uri_string() === "nickserv/verify") ? 'class="current"' : '') ?>><a href="<?php print site_url('nickserv/verify'); ?>"><?php _t('ns_verify'); ?></a></li>
		</ul>
		<?php elseif (stristr(uri_string(), "chanserv")) : ?>
			<ul>
				<li <?php print ((uri_string() === "chanserv/info") ? 'class="current"' : '') ?>><a href="<?php print site_url('chanserv/info'); ?>"><?php _t('cs_info'); ?></a></li>
				<li <?php print ((uri_string() === "chanserv/topic") ? 'class="current"' : '') ?>><a href="<?php print site_url('chanserv/topic'); ?>"><?php _t('cs_topic'); ?></a></li>
				<li <?php print ((uri_string() === "chanserv/kick") ? 'class="current"' : '') ?>><a href="<?php print site_url('chanserv/kick'); ?>"><?php _t('cs_kick'); ?></a></li>
				<li <?php print ((uri_string() === "chanserv/ban") ? 'class="current"' : '') ?>><a href="<?php print site_url('chanserv/ban'); ?>"><?php _t('cs_ban'); ?></a></li>
				<li <?php print ((uri_string() === "chanserv/akick") ? 'class="current"' : '') ?>><a href="<?php print site_url('chanserv/akick'); ?>"><?php _t('cs_akick'); ?></a></li>
			<?php if ($this->config->item('atheme_xop')) : ?>
				<li <?php print ((uri_string() === "chanserv/xop") ? 'class="current"' : '') ?>><a href="<?php print site_url('chanserv/xop'); ?>"><?php _t('cs_xop'); ?></a></li>
			<?php endif; ?>
			<?php if ($this->config->item('atheme_flags')) : ?>
				<li <?php print ((uri_string() === "chanserv/flags") ? 'class="current"' : '') ?>><a href="<?php print site_url('chanserv/flags'); ?>"><?php _t('cs_flags'); ?></a></li>
			<?php endif; ?>
				<li <?php print ((uri_string() === "chanserv/set") ? 'class="current"' : '') ?>><a href="<?php print site_url('chanserv/set'); ?>"><?php _t('cs_settings'); ?></a></li>				
			</ul>
		<?php elseif (stristr(uri_string(), "memoserv")) : ?>
			<ul>
				<li <?php print ((uri_string() === "memoserv") ? 'class="current"' : '') ?>><a href="<?php print site_url('memoserv'); ?>"><?php _t('ms_view'); ?></a></li>
				<li <?php print ((uri_string() === "memoserv/sendmemo") ? 'class="current"' : '') ?>><a href="<?php print site_url('memoserv/sendmemo'); ?>"><?php _t('ms_send'); ?></a></li>
				<li <?php print ((uri_string() === "memoserv/forward") ? 'class="current"' : '') ?>><a href="<?php print site_url('memoserv/forward'); ?>"><?php _t('ms_fwd'); ?></a></li>
				<li <?php print ((stristr(uri_string(), "memoserv/delmemo")) ? 'class="current"' : '') ?>><a href="<?php print site_url('memoserv/delmemo'); ?>"><?php _t('ms_delete'); ?></a></li>
			</ul>
		<?php elseif (stristr(uri_string(), "hostserv")) : ?>
			<ul>
				<li <?php print ((uri_string() === "hostserv/offerlist") ? 'class="current"' : '') ?>><a href="<?php print site_url('hostserv/offerlist'); ?>"><?php _t('hs_offer'); ?></a></li>
				<li <?php print ((uri_string() === "hostserv/take") ? 'class="current"' : '') ?>><a href="<?php print site_url('hostserv/take'); ?>"><?php _t('hs_take'); ?></a></li>
				<li <?php print ((uri_string() === "hostserv/request") ? 'class="current"' : '') ?>><a href="<?php print site_url('hostserv/request'); ?>"><?php _t('hs_request'); ?></a></li>
			</ul>

		<?php elseif (stristr(uri_string(), "botserv")) : ?>
			<ul>
				<li <?php print ((uri_string() === "botserv/botlist") ? 'class="current"' : '') ?>><a href="<?php print site_url('botserv/botlist'); ?>"><?php _t('bs_botlist'); ?></a></li>
				<li <?php print ((uri_string() === "botserv/assign") ? 'class="current"' : '') ?>><a href="<?php print site_url('botserv/assign'); ?>"><?php _t('bs_assign'); ?></a></li>
				<li <?php print ((uri_string() === "botserv/unassign") ? 'class="current"' : '') ?>><a href="<?php print site_url('botserv/unassign'); ?>"><?php _t('bs_unassign'); ?></a></li>
				<li <?php if ($this->config->item('atheme_operserv') && $this->operserv_model->check_access()) : ?>
					<?php print ((uri_string() === "botserv/bot") ? 'class="current"' : '') ?>><a href="<?php print site_url('botserv/bot'); ?>"><?php _t('bs_botmgt'); ?></a></li>
		                <?php endif; ?>
			</ul>

			<?php elseif (stristr(uri_string(), "groupserv")) : ?>
			<ul>
				<li <?php print ((uri_string() === "groupserv/listgroups") ? 'class="current"' : '') ?>><a href="<?php print site_url('groupserv/listgroups'); ?>"><?php _t('gs_listgroups'); ?></a></li>
				<li <?php print ((uri_string() === "groupserv/join") ? 'class="current"' : '') ?>><a href="<?php print site_url('groupserv/join'); ?>"><?php _t('gs_join'); ?></a></li>
				<li <?php print ((uri_string() === "groupserv/info") ? 'class="current"' : '') ?>><a href="<?php print site_url('groupserv/info'); ?>"><?php _t('gs_info'); ?></a></li>
				<li <?php print ((uri_string() === "groupserv/flags") ? 'class="current"' : '') ?>><a href="<?php print site_url('groupserv/flags'); ?>"><?php _t('gs_flags'); ?></a></li>
				<li <?php print ((uri_string() === "groupserv/listchans") ? 'class="current"' : '') ?>><a href="<?php print site_url('groupserv/listchans'); ?>"><?php _t('gs_listchans'); ?></a></li>
				<li <?php print ((uri_string() === "groupserv/register") ? 'class="current"' : '') ?>><a href="<?php print site_url('groupserv/register'); ?>"><?php _t('gs_register'); ?></a></li>
				<li <?php print ((uri_string() === "groupserv/set") ? 'class="current"' : '') ?>><a href="<?php print site_url('groupserv/set'); ?>"><?php _t('gs_set'); ?></a></li>
			</ul>
			
		<?php elseif (stristr(uri_string(), "operserv")) : ?>
			<ul>
				<li <?php print ((uri_string() === "operserv") ? 'class="current"' : '') ?>><a href="<?php print site_url('operserv'); ?>"><?php _t('os_dashboard'); ?></a></li>
				<li <?php print ((uri_string() === "operserv/akill") ? 'class="current"' : '') ?>><a href="<?php print site_url('operserv/akill'); ?>"><?php _t('os_akill'); ?></a></li>
			<?php if ($this->config->item('atheme_waitings')) : ?>
				<li <?php print ((uri_string() === "operserv/waitinglists") ? 'class="current"' : '') ?>><a href="<?php print site_url('operserv/waitinglists'); ?>"><?php _t('os_waitinglists'); ?></a></li>
			<?php endif; ?>
			<?php if ($this->config->item('atheme_soper')) : ?>
				<li <?php print ((uri_string() === "operserv/soper") ? 'class="current"' : '') ?>><a href="<?php print site_url('operserv/soper'); ?>"><?php _t('os_soper'); ?></a></li>
			<?php endif; ?>
				<li <?php print ((uri_string() === "operserv/modules") ? 'class="current"' : '') ?>><a href="<?php print site_url('operserv/modules'); ?>"><?php _t('os_modules'); ?></a></li>
				<li <?php print ((uri_string() === "operserv/rehash") ? 'class="current"' : '') ?>><a href="<?php print site_url('operserv/rehash'); ?>"><?php _t('os_rehash'); ?></a></li>
				<li <?php print ((uri_string() === "operserv/hash") ? 'class="current"' : '') ?>><a href="<?php print site_url('operserv/hash'); ?>"><?php _t('os_passhash'); ?></a></li>
			</ul>
		<?php endif; ?>
		</nav>
            
		<?php endif; ?>
