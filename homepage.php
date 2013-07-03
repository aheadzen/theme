<?php
/*
Template Name: Home Page
*/
?>
<?php
get_header();
do_action( 'yit_before_primary' ) ?>
<!-- START PRIMARY -->
<div id="primary" class="<?php yit_sidebar_layout() ?>">

  <div class="container group">
    <div class="span12 content group" id="content-page">
      <div class="post-557 page type-page status-publish hentry group instock" id="post-557">
        <div class="row">
          <div class="features-tab-container  group span12 margin-bottom" id="features-tab-demo">
            <div class="row"><img class="shadow" src="http://demo.yithemes.com/bazar/wp-content/themes/bazar/theme/assets/images/features-tab-shadow.png">
              <ul class="features-tab-labels span3">
			  <?php
			  $title1 = wpw_get_option('wpw_slide_t1');
			  $icon1 = wpw_get_option('wpw_slide_i1');
			  $content1 = nl2br(wpw_get_option('wpw_slide_c1'));
			  if($title1){
			  ?>
			  <li class="features-tab-0 current-feature"><img src="<?php echo $icon1;?>" alt="" /> <?php echo $title1;?></li>
			  <?php
			  }
			  ?>
			  <?php
			  $title2 = wpw_get_option('wpw_slide_t2');
			  $icon2 = wpw_get_option('wpw_slide_i2');
			  $content2 = nl2br(wpw_get_option('wpw_slide_c2'));
			  if($title2){
			  ?>
			  <li class="features-tab-1"><img src="<?php echo $icon2;?>" alt="" /> <?php echo $title2;?></li>
			  <?php
			  }
			  ?>
			  <?php
			  $title3 = wpw_get_option('wpw_slide_t3');
			  $icon3 = wpw_get_option('wpw_slide_i3');
			  $content3 = nl2br(wpw_get_option('wpw_slide_c3'));
			  if($title3){
			  ?>
			  <li class="features-tab-2"><img src="<?php echo $icon3;?>" alt="" /> <?php echo $title3;?></li>
			  <?php
			  }
			  ?>
			  <?php
			  $title4 = wpw_get_option('wpw_slide_t4');
			  $icon4 = wpw_get_option('wpw_slide_i4');
			  $content4 = nl2br(wpw_get_option('wpw_slide_c4'));
			  if($title4){
			  ?>
			  <li class="features-tab-3"><img src="<?php echo $icon4;?>" alt="" /> <?php echo $title4;?></li>
			  <?php
			  }
			  ?>
			  <?php
			  $title5 = wpw_get_option('wpw_slide_t5');
			  $icon5 = wpw_get_option('wpw_slide_i5');
			  $content5 = nl2br(wpw_get_option('wpw_slide_c5'));
			  if($title5){
			  ?>
			  <li class="features-tab-4"><img src="<?php echo $icon5;?>" alt="" /> <?php echo $title5;?></li>
			  <?php
			  }
			  ?>
			  <?php
			  $title6 = wpw_get_option('wpw_slide_t6');
			  $icon6 = wpw_get_option('wpw_slide_i6');
			  $content6 = nl2br(wpw_get_option('wpw_slide_c6'));
			  if($title6){
			  ?>
			  <li class="features-tab-5"><img src="<?php echo $icon6;?>" alt="" /> <?php echo $title6;?></li>
			  <?php
			  }
			  ?>
			  <?php
			  $title7 = wpw_get_option('wpw_slide_t7');
			  $icon7 = wpw_get_option('wpw_slide_i7');
			  $content7 = nl2br(wpw_get_option('wpw_slide_c7'));
			  if($title7){
			  ?>
			  <li class="features-tab-6"><img src="<?php echo $icon7;?>" alt="" /> <?php echo $title7;?></li>
			  <?php
			  }
			  ?>
			  <?php
			  $title8 = wpw_get_option('wpw_slide_t8');
			  $icon8 = wpw_get_option('wpw_slide_i8');
			  $content8 = nl2br(wpw_get_option('wpw_slide_c8'));
			  if($title8){
			  ?>
			  <li class="features-tab-7"><img src="<?php echo $icon8;?>" alt="" /> <?php echo $title8;?></li>
			  <?php
			  }
			  ?>
			  <?php
			  $title9 = wpw_get_option('wpw_slide_t9');
			  $icon9 = wpw_get_option('wpw_slide_i9');
			  $content9 = nl2br(wpw_get_option('wpw_slide_c9'));
			  if($title9){
			  ?>
			  <li class="features-tab-8"><img src="<?php echo $icon9;?>" alt="" /> <?php echo $title9;?></li>
			  <?php
			  }
			  ?>
			  <?php
			  $title10 = wpw_get_option('wpw_slide_t10');
			  $icon10 = wpw_get_option('wpw_slide_i10');
			  $content10 = nl2br(wpw_get_option('wpw_slide_c10'));
			  if($title10){
			  ?>
			  <li class="features-tab-9"><img src="<?php echo $icon10;?>" alt="" /> <?php echo $title10;?></li>
			  <?php
			  }
			  ?>

              </ul>
              <div class="features-tab-wrapper span9">
			  <?php if($title1 && $content1){?>
                <div class="features-tab-content features-tab-0" style="display: block;">
                  <p><?php echo $content1;?></p>
                </div>
				<?php }?>
				<?php if($title2 && $content2){?>
               <div class="features-tab-content features-tab-1" style="display: none;">
                  <p><?php echo $content2;?></p>
                </div>
				<?php }?>
				<?php if($title3 && $content3){?>
               <div class="features-tab-content features-tab-2" style="display: none;">
                  <p><?php echo $content3;?></p>
                </div>
				<?php }?>
				<?php if($title4 && $content4){?>
               <div class="features-tab-content features-tab-3" style="display: none;">
                  <p><?php echo $content4;?></p>
                </div>
				<?php }?>
				<?php if($title5 && $content5){?>
               <div class="features-tab-content features-tab-4" style="display: none;">
                  <p><?php echo $content5;?></p>
                </div>
				<?php }?>
				<?php if($title6 && $content6){?>
               <div class="features-tab-content features-tab-5" style="display: none;">
                  <p><?php echo $content6;?></p>
                </div>
				<?php }?>
				<?php if($title7 && $content7){?>
               <div class="features-tab-content features-tab-6" style="display: none;">
                  <p><?php echo $content7;?></p>
                </div>
				<?php }?>
				<?php if($title8 && $content8){?>
               <div class="features-tab-content features-tab-7" style="display: none;">
                  <p><?php echo $content8;?></p>
                </div>
				<?php }?>
				<?php if($title9 && $content9){?>
               <div class="features-tab-content features-tab-8" style="display: none;">
                  <p><?php echo $content9;?></p>
                </div>
				<?php }?>
				<?php if($title10 && $content10){?>
               <div class="features-tab-content features-tab-9" style="display: none;">
                  <p><?php echo $content10;?></p>
                </div>
				<?php }?>
                
              </div>
            </div>
          </div>
        </div>
      </div>
      
	  <div class="row  home_banners">
	  <?php
	  $banner1 = wpw_get_option('wpw_banner1');
	  $url1 = wpw_get_option('wpw_banner1_url');
	  if(!$url1){$url1='#';}
	  if($banner1){
	  ?>
	  <div class="span3">
	  <a href="<?php echo $url1;?>"><img src="<?php echo $banner1;?>" alt="" /></a>
	  </div>
	  <?php }?>
	  
	  <?php
	  $banner2 = wpw_get_option('wpw_banner2');
	  $url2 = wpw_get_option('wpw_banner1_ur2');
	  if(!$url2){$url2='#';}
	  if($banner2){
	  ?>
	  <div class="span3">
	  <a href="<?php echo $url2;?>"><img src="<?php echo $banner2;?>" alt="" /></a>
	  </div>
	  <?php }?>
	  
	  <?php
	  $banner3 = wpw_get_option('wpw_banner3');
	  $url3 = wpw_get_option('wpw_banner1_ur3');
	  if(!$url3){$url3='#';}
	  if($banner3){
	  ?>
	  <div class="span3">
	  <a href="<?php echo $url3;?>"><img src="<?php echo $banner3;?>" alt="" /></a>
	  </div>
	  <?php }?>
	  </div>
    </div>
  </div>
</div>
<!-- END PRIMARY -->
<?php
do_action( 'yit_after_primary' );
get_footer() ?>
