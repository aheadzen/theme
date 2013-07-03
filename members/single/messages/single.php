<div id="message-thread">

	<?php do_action( 'bp_before_message_thread_content' ) ?>

	<?php if ( bp_thread_has_messages() ) : ?>

		<h3 id="message-subject"><?php bp_the_thread_subject() ?></h3>

<!--		<p id="message-recipients">
			<span class="highlight">
				<?php printf( __('Sent between %s and %s', 'buddypress'), bp_get_the_thread_recipients(), '<a href="' . bp_get_loggedin_user_link() . '" title="' . bp_get_loggedin_user_fullname() . '">' . bp_get_loggedin_user_fullname() . '</a>' ) ?>
			</span>
		</p>
-->

		<?php do_action( 'bp_before_message_thread_list' ) ?>
		<?php $sender_arr = array();
		$counter = 0;
		?>
		<?php while ( bp_thread_messages() ) : bp_thread_the_message(); ?>

			<?php
			$sender_name = '';
			ob_start();
			bp_the_thread_message_sender_name();
			$sender_name = ob_get_contents();
			ob_end_clean();
			if(!$sender_arr[$sender_name]){
				$counter++;
				$sender_arr[$sender_name]=$counter;				
			}
			if($sender_arr[$sender_name]==1)
			{
				$messagetype = 'sender';
			}else{
				$messagetype = 'replyer';
			}
			?>
			<div id="commentlist" class="message-box <?php echo $messagetype;?>">

				<div class="message-metadata comment <?php if($messagetype=='replyer'){?>comment-author-admin<?php }?>">
					<div class="<?php if($messagetype=='replyer'){?>children<?php }?>">
					<?php do_action( 'bp_before_message_meta' ) ?>

					<div class="comment-wrap comment-author-admin">
					  <div class="avatar-wrap">
					  <a href="<?php bp_the_thread_message_sender_link() ?>" title="<?php bp_the_thread_message_sender_name() ?>"><?php bp_the_thread_message_sender_avatar( 'type=thumb&width=70&height=70' ) ?>
						</a>
						<div class="avatar-frame"></div>
					  </div>
					  <div class="comment-header">
						<div class="comment-author"> <cite class="fn"><a href="<?php bp_the_thread_message_sender_link() ?>" title="<?php bp_the_thread_message_sender_name() ?>"><?php bp_the_thread_message_sender_name() ?></a> <small>said</small>:</cite> </div>
						<!-- / comment-author -->
						<div class="comment-meta commentmetamessage"> <span class="activity"><?php bp_the_thread_message_time_since() ?></span></div>
						<!-- / comment-meta -->
					  </div>
					  <div class="comment-content">
						<?php do_action( 'bp_after_message_meta' ) ?>
						<?php bp_the_thread_message_content() ?>
					  </div>
					  <!-- .message-content -->
					  <?php do_action( 'bp_after_message_content' ) ?>
					</div>
					</div>
				</div>
				
				</div><!-- .message-metadata -->
				<div class="clear"></div>

		<?php endwhile; ?>
		
		<?php do_action( 'bp_after_message_thread_list' ) ?>

		<?php do_action( 'bp_before_message_thread_reply' ) ?>
<p></p>
		<form id="send-reply" action="<?php bp_messages_form_action() ?>" method="post" class="standard-form">

			<div class="message-box">

				<div class="avatar-box alignleft">
						<?php bp_loggedin_user_avatar( 'type=thumb' ) ?>

						
					</div>
				<div class="message-content alignright" style="width: 495px;">
					<div class="message-metadata">

						<?php do_action( 'bp_before_message_meta' ) ?>
						<h3><?php _e( 'Send a Reply', 'buddypress' ) ?></h3>
						<?php do_action( 'bp_after_message_meta' ) ?>

					</div><!-- .message-metadata -->
					<?php do_action( 'bp_before_message_reply_box' ) ?>

					<textarea name="content" id="message_content" rows="15" cols="40"></textarea>

					<?php do_action( 'bp_after_message_reply_box' ) ?>

					<div class="submit">
						<input type="submit" name="send" value="<?php _e( 'Send Reply', 'buddypress' ) ?> &rarr;" id="send_reply_button"/>
						<span class="ajax-loader"></span>
					</div>

					<input type="hidden" id="thread_id" name="thread_id" value="<?php bp_the_thread_id(); ?>" />
					<?php wp_nonce_field( 'messages_send_message', 'send_message_nonce' ) ?>

				</div><!-- .message-content -->
				<div class="clearboth"></div>
			</div><!-- .message-box -->

		</form><!-- #send-reply -->

		<?php do_action( 'bp_after_message_thread_reply' ) ?>

	<?php endif; ?>

	<?php do_action( 'bp_after_message_thread_content' ) ?>

</div>