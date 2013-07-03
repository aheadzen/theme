<?php get_header();
do_action( 'yit_before_primary' ) ?>
<!-- START PRIMARY -->

<div id="primary" class="<?php yit_sidebar_layout() ?>">
  <div class="container group">
    <div class="row">
      <?php //do_action( 'yit_before_content' ) ?>
      <!-- START CONTENT -->
      <div id="content-page" class="span12 content group">
	  	
        <form action="<?php bp_group_creation_form_action() ?>" method="post" id="create-group-form" class="standard-form" enctype="multipart/form-data">
            <div class="slogan">
              <h2>
                <?php _e( 'Create a Group', 'buddypress' ) ?>
                &nbsp;<a class="button" href="<?php echo bp_get_root_domain() . '/' . BP_GROUPS_SLUG . '/' ?>">
                <?php _e( 'Groups Directory', 'buddypress' ) ?>
                </a></h2>
              <div class="border margin-top"></div>
              <div class="border"></div>
              <div class="border"></div>
            </div>
            <?php //do_action( 'bp_before_create_group' ) ?>
            
			
			<div class="item-list-tabs no-ajax" id="group-create-tabs">
		  <ul>
			<?php /*?><li class="current">
			<a href="<?php echo site_url('groups/create/step/group-details/');?>">
			<big>1</big> Details</a>
			</li>
			<li>
			<a href="<?php echo site_url('groups/create/step/group-settings/');?>">
			<span><big>2</big> Settings</span>
			</a>
			</li>
			<li><span><big>3</big> Forum</span></li>
			<li><span><big>4</big> Avatar</span></li><?php */?>
			<?php
			global $bp;

			if ( !is_array( $bp->groups->group_creation_steps ) )
				return false;
		
			if ( !bp_get_groups_current_create_step() )
				$bp->groups->current_create_step = array_shift( array_keys( $bp->groups->group_creation_steps ) );
		
			$counter = 1;
			$current_counter = 0;
			foreach ( (array) $bp->groups->group_creation_steps as $slug => $step ) {
				$is_enabled = bp_are_previous_group_creation_steps_complete( $slug );
				
				if ( bp_get_groups_current_create_step() == $slug )
				{
					$current_counter = $counter*25;
				}
				?>
				
				<li<?php if ( bp_get_groups_current_create_step() == $slug ) : ?> class="current"<?php endif; ?>><?php if ( $is_enabled ) : ?><a href="<?php echo bp_get_root_domain() . '/' . bp_get_groups_root_slug() ?>/create/step/<?php echo $slug ?>/"><?php else: ?><span><?php endif; ?>
				<big><?php echo $counter ?></big>
				<?php echo $step['name'] ?><?php if ( $is_enabled ) : ?></a><?php else: ?></span><?php endif ?></li><?php
				$counter++;
			}
			?>
			
		  </ul>
		  <div style="width:100%; clear:both;"></div>
		<div class="span12 progress progress-striped" id="multistep_progress">
			<div style="width: <?php echo $current_counter;?>%;" class="bar"></div>
		</div>
		<div style="width:100%; clear:both;"></div>
		</div>
		
			
            <?php do_action( 'template_notices' ) ?>
            <div class="item-body" id="group-create-body"> <br />
              <?php /* Group creation step 1: Basic group details */ ?>
              <?php if ( bp_is_group_creation_step( 'group-details' ) ) : ?>
              <?php do_action( 'bp_before_group_details_creation_step' ); ?>
              <label for="group-name">
              <?php _e('* Group Name', 'buddypress') ?>
              <?php _e( '(required)', 'buddypress' )?>
              </label>
              <input type="text" name="group-name" id="group-name" value="<?php bp_new_group_name() ?>" />
              <label for="group-desc">
              <?php _e('* Group Description', 'buddypress') ?>
              <?php _e( '(required)', 'buddypress' )?>
              </label>
              <textarea name="group-desc" id="group-desc"><?php bp_new_group_description() ?>
</textarea>
              <?php do_action( 'bp_after_group_details_creation_step' ); /* Deprecated -> */ do_action( 'groups_custom_group_fields_editable' ); ?>
              <?php wp_nonce_field( 'groups_create_save_group-details' ) ?>
              <?php endif; ?>
              <?php /* Group creation step 2: Group settings */ ?>
              <?php if ( bp_is_group_creation_step( 'group-settings' ) ) : ?>
              <?php do_action( 'bp_before_group_settings_creation_step' ); ?>
              <?php if ( function_exists('bp_wire_install') ) : ?>
              <div class="checkbox">
                <label>
                <input type="checkbox" name="group-show-wire" id="group-show-wire" value="1"<?php if ( bp_get_new_group_enable_wire() ) { ?> checked="checked"<?php } ?> />
                <?php _e('Enable comment wire', 'buddypress') ?>
                </label>
              </div>
              <?php endif; ?>
              <?php if ( function_exists('bp_forums_is_installed_correctly') ) : ?>
              <?php if ( bp_forums_is_installed_correctly() ) : ?>
              <div class="checkbox">
                <label>
                <input type="checkbox" name="group-show-forum" id="group-show-forum" value="1"<?php if ( bp_get_new_group_enable_forum() ) { ?> checked="checked"<?php } ?> />
                <?php _e('Enable discussion forum', 'buddypress') ?>
                </label>
              </div>
              <?php else : ?>
              <?php if ( is_site_admin() ) : ?>
              <div class="checkbox">
                <label>
                <input type="checkbox" disabled="disabled" name="disabled" id="disabled" value="0" />
                <?php printf( __('<strong>Attention Site Admin:</strong> Group forums require the <a href="%s">correct setup and configuration</a> of a bbPress installation.', 'buddypress' ), bp_get_root_domain() . '/wp-admin/admin.php?page=bb-forums-setup' ) ?></label>
              </div>
              <?php endif; ?>
              <?php endif; ?>
              <?php endif; ?>
              
              <h4>
                <?php _e( 'Privacy Options', 'buddypress' ); ?>
              </h4>
              <div class="radio">
                <label>
                <input type="radio" name="group-status" value="public"<?php if ( 'public' == bp_get_new_group_status() || !bp_get_new_group_status() ) { ?> checked="checked"<?php } ?> />
                <strong>
                <?php _e( 'This is a public group', 'buddypress' ) ?>
                </strong>
                <ul>
                  <li>
                    <?php _e( 'Any site member can join this group.', 'buddypress' ) ?>
                  </li>
                  <li>
                    <?php _e( 'This group will be listed in the groups directory and in search results.', 'buddypress' ) ?>
                  </li>
                  <li>
                    <?php _e( 'Group content and activity will be visible to any site member.', 'buddypress' ) ?>
                  </li>
                </ul>
                </label>
                <label>
                <input type="radio" name="group-status" value="private"<?php if ( 'private' == bp_get_new_group_status() ) { ?> checked="checked"<?php } ?> />
                <strong>
                <?php _e( 'This is a private group', 'buddypress' ) ?>
                </strong>
                <ul>
                  <li>
                    <?php _e( 'Only users who request membership and are accepted can join the group.', 'buddypress' ) ?>
                  </li>
                  <li>
                    <?php _e( 'This group will be listed in the groups directory and in search results.', 'buddypress' ) ?>
                  </li>
                  <li>
                    <?php _e( 'Group content and activity will only be visible to members of the group.', 'buddypress' ) ?>
                  </li>
                </ul>
                </label>
                <label>
                <input type="radio" name="group-status" value="hidden"<?php if ( 'hidden' == bp_get_new_group_status() ) { ?> checked="checked"<?php } ?> />
                <strong>
                <?php _e('This is a hidden group', 'buddypress') ?>
                </strong>
                <ul>
                  <li>
                    <?php _e( 'Only users who are invited can join the group.', 'buddypress' ) ?>
                  </li>
                  <li>
                    <?php _e( 'This group will not be listed in the groups directory or search results.', 'buddypress' ) ?>
                  </li>
                  <li>
                    <?php _e( 'Group content and activity will only be visible to members of the group.', 'buddypress' ) ?>
                  </li>
                </ul>
                </label>
              </div>
              <?php do_action( 'bp_after_group_settings_creation_step' ); ?>
              <?php wp_nonce_field( 'groups_create_save_group-settings' ) ?>
              <?php endif; ?>
              <?php /* Group creation step 3: Avatar Uploads */ ?>
              <?php if ( bp_is_group_creation_step( 'group-avatar' ) ) : ?>
              <?php do_action( 'bp_before_group_avatar_creation_step' ); ?>
              <?php if ( !bp_get_avatar_admin_step() ) : ?>
              <div class="left-menu">
                <?php bp_new_group_avatar() ?>
              </div>
              <!-- .left-menu -->
              <div class="main-column">
                <p>
                  <?php _e("Upload an image to use as an avatar for this group. The image will be shown on the main group page, and in search results.", 'buddypress') ?>
                </p>
                <p>
                  <input type="file" name="file" id="file" />
                  <input type="submit" name="upload" id="upload" value="<?php _e( 'Upload Image', 'buddypress' ) ?>" />
                  <input type="hidden" name="action" id="action" value="bp_avatar_upload" />
                </p>
                <p>
                  <?php _e( 'To skip the avatar upload process, hit the "Next Step" button.', 'buddypress' ) ?>
                </p>
              </div>
              <!-- .main-column -->
              <?php endif; ?>
              <?php if ( 'crop-image' == bp_get_avatar_admin_step() ) : ?>
              <h3>
                <?php _e( 'Crop Group Avatar', 'buddypress' ) ?>
              </h3>
              <img src="<?php bp_avatar_to_crop() ?>" id="avatar-to-crop" class="avatar" alt="<?php _e( 'Avatar to crop', 'buddypress' ) ?>" />
              <div id="avatar-crop-pane"> <img src="<?php bp_avatar_to_crop() ?>" id="avatar-crop-preview" class="avatar" alt="<?php _e( 'Avatar preview', 'buddypress' ) ?>" /> </div>
              <input type="submit" name="avatar-crop-submit" id="avatar-crop-submit" value="<?php _e( 'Crop Image', 'buddypress' ) ?>" />
              <input type="hidden" name="image_src" id="image_src" value="<?php bp_avatar_to_crop_src() ?>" />
              <input type="hidden" name="upload" id="upload" />
              <input type="hidden" id="x" name="x" />
              <input type="hidden" id="y" name="y" />
              <input type="hidden" id="w" name="w" />
              <input type="hidden" id="h" name="h" />
              <?php endif; ?>
              <?php do_action( 'bp_after_group_avatar_creation_step' ); ?>
              <?php wp_nonce_field( 'groups_create_save_group-avatar' ) ?>
              <?php endif; ?>
              <?php /* Group creation step 4: Invite friends to group */ ?>
              <?php if ( bp_is_group_creation_step( 'group-invites' ) ) : ?>
              <?php do_action( 'bp_before_group_invites_creation_step' ); ?>
              <?php if ( function_exists( 'bp_get_total_friend_count' ) && bp_get_total_friend_count( bp_loggedin_user_id() ) ) : ?>
              <div class="left-menu">
                <div id="invite-list">
                  <ul>
                    <?php bp_new_group_invite_friend_list() ?>
                  </ul>
                  <?php wp_nonce_field( 'groups_invite_uninvite_user', '_wpnonce_invite_uninvite_user' ) ?>
                </div>
              </div>
              <!-- .left-menu -->
              <div class="main-column">
                <div id="message" class="info">
                  <p>
                    <?php _e('Select people to invite from your friends list.', 'buddypress'); ?>
                  </p>
                </div>
                <?php /* The ID 'friend-list' is important for AJAX support. */ ?>
                <ul id="friend-list" class="item-list">
                  <?php if ( bp_group_has_invites() ) : ?>
                  <?php while ( bp_group_invites() ) : bp_group_the_invite(); ?>
                  <li id="<?php bp_group_invite_item_id() ?>">
                    <?php bp_group_invite_user_avatar() ?>
                    <h4>
                      <?php bp_group_invite_user_link() ?>
                    </h4>
                    <span class="activity">
                    <?php bp_group_invite_user_last_active() ?>
                    </span>
                    <div class="action"> <a class="remove" href="<?php bp_group_invite_user_remove_invite_url() ?>" id="<?php bp_group_invite_item_id() ?>">
                      <?php _e( 'Remove Invite', 'buddypress' ) ?>
                      </a> </div>
                  </li>
                  <?php endwhile; ?>
                  <?php wp_nonce_field( 'groups_send_invites', '_wpnonce_send_invites' ) ?>
                  <?php endif; ?>
                </ul>
              </div>
              <!-- .main-column -->
              <?php else : ?>
              <div id="message" class="info">
                <p>
                  <?php _e( 'Once you have built up friend connections you will be able to invite others to your group. You can send invites any time in the future by selecting the "Send Invites" option when viewing your new group.', 'buddypress' ); ?>
                </p>
              </div>
              <?php endif; ?>
              <?php wp_nonce_field( 'groups_create_save_group-invites' ) ?>
              <?php do_action( 'bp_after_group_invites_creation_step' ); ?>
              <?php endif; ?>
              <?php do_action( 'groups_custom_create_steps' ) // Allow plugins to add custom group creation steps ?>
              <?php do_action( 'bp_before_group_creation_step_buttons' ); ?>
              <?php if ( 'crop-image' != bp_get_avatar_admin_step() ) : ?>
              <div class="submit" id="previous-next">
                <?php /* Previous Button */ ?>
                <?php if ( !bp_is_first_group_creation_step() ) : ?>
                <input type="button" value="&larr; <?php _e('Previous Step', 'buddypress') ?>" id="group-creation-previous" name="previous" onclick="location.href='<?php bp_group_creation_previous_link() ?>'" />
                <?php endif; ?>
                <?php /* Next Button */ ?>
                <?php if ( !bp_is_last_group_creation_step() && !bp_is_first_group_creation_step() ) : ?>
                <input type="submit" value="<?php _e('Next Step', 'buddypress') ?> &rarr;" id="group-creation-next" name="save" />
                <?php endif;?>
                <?php /* Create Button */ ?>
                <?php if ( bp_is_first_group_creation_step() ) : ?>
                <input type="submit" value="<?php _e('Create Group and Continue', 'buddypress') ?> &rarr;" id="group-creation-create" name="save" />
                <?php endif; ?>
                <?php /* Finish Button */ ?>
                <?php if ( bp_is_last_group_creation_step() ) : ?>
                <input type="submit" value="<?php _e('Finish', 'buddypress') ?> &rarr;" id="group-creation-finish" name="save" />
                <?php endif; ?>
              </div>
              <?php endif;?>
              <?php do_action( 'bp_after_group_creation_step_buttons' ); ?>
              <?php /* Don't leave out this hidden field */ ?>
              <input type="hidden" name="group_id" id="group_id" value="<?php bp_new_group_id() ?>" />
              <?php do_action( 'bp_directory_groups_content' ) ?>
            </div>
            <!-- .item-body -->
            <?php do_action( 'bp_after_create_group' ) ?>
          </form>
		  <div style="width:100%; clear:both; padding:30px;"></div>
      </div>
      <!-- END CONTENT -->
      <?php do_action( 'yit_after_content' ) ?>
      <?php //get_sidebar() ?>
      <?php //do_action( 'yit_after_sidebar' ) ?>
      <!-- START EXTRA CONTENT -->
      <?php do_action( 'yit_extra_content' ) ?>
      <!-- END EXTRA CONTENT -->
    </div>
  </div>
</div>
<!-- END PRIMARY -->
<style type="text/css">
#footer{display:none !important;}
</style>
<?php
do_action( 'yit_after_primary' );
get_footer() ?>
