<?php if(is_active_sidebar('additional_sidebar')){?>
<div class="leftmenuicon">
<img id="showhideleftmenu" src="<?php echo get_stylesheet_directory_uri();?>/images/leftmenu.png" alt=""  />
</div>
<div id="sidebar_add" class="span3 sidebar group sidebar_add">
<?php dynamic_sidebar('additional_sidebar');?>
</div>
<script type="text/javascript">
$lmenu = jQuery.noConflict();
$lmenu("#showhideleftmenu").click(function () {
$lmenu(".sidebar_add").toggle("slow");
});
</script>
<?php }?>
