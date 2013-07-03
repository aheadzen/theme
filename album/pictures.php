<?php get_header();
do_action( 'yit_before_primary' ) ?>
<!-- START PRIMARY -->
<div id="primary" class="<?php yit_sidebar_layout() ?>">
    <div class="container group">
	    <div class="row">
	        <?php do_action( 'yit_before_content' ) ?>
	        <!-- START CONTENT -->
	        <div id="content-page" class="span<?php echo yit_get_sidebar_layout() == 'sidebar-no' ? 12 : 9 ?> content group">

	<div id="content1" class="home">
		<div class="padder">

			<div id="item-header">
				<?php locate_template( array( 'members/single/member-header.php' ), true ) ?>
			</div>

			<div id="item-nav">
				<div class="item-list-tabs no-ajax" id="object-nav">
					<ul>
						<?php bp_get_displayed_user_nav() ?>
					</ul>
				</div>
			</div>

			<div id="item-body">

				<div class="item-list-tabs no-ajax" id="subnav">
					<ul>
						<?php bp_get_options_nav() ?>
					</ul>
				</div>

					<?php if ( bp_album_has_pictures() ) : ?>
					
				<div class="picture-pagination">
					<?php bp_album_picture_pagination(); ?>	
				</div>			
					
				<div class="picture-gallery">												
						<?php while ( bp_album_has_pictures() ) : bp_album_the_picture(); ?>

				<div class="picture-thumb-box">
	
	                <a href="<?php bp_album_picture_url() ?>" class="picture-thumb"><img src='<?php bp_album_picture_thumb_url() ?>' /></a>
	                <a href="<?php bp_album_picture_url() ?>"  class="picture-title"><?php bp_album_picture_title_truncate() ?></a>	
				</div>
					
						<?php endwhile; ?>
				</div>					
					<?php else : ?>
					
				<div id="message" class="info">
					<p><?php echo bp_word_or_name( __('No pics here, show something to the community!', 'bp-album' ), __( "Either %s hasn't uploaded any picture yet or they have restricted access", 'bp-album' )  ,false,false) ?></p>
				</div>
				
				<?php endif; ?>

			</div><!-- #item-body -->

		</div><!-- .padder -->
	</div><!-- #content -->

</div>
	        <!-- END CONTENT -->
	        <?php do_action( 'yit_after_content' ) ?>
	        
	        <?php get_sidebar() ?>
	        
	        <?php do_action( 'yit_after_sidebar' ) ?>
	        
	        <!-- START EXTRA CONTENT -->
	        <?php do_action( 'yit_extra_content' ) ?>
	        <!-- END EXTRA CONTENT -->
		</div>
    </div>
</div>
<!-- END PRIMARY -->
<?php
do_action( 'yit_after_primary' );
get_footer() ?>