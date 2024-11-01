<?php
add_action('admin_menu', 'snm_register_responsive_gallery_submenu_page');
function snm_register_responsive_gallery_submenu_page() {
	add_submenu_page( 'edit.php?post_type=snm_gallery_slider', 'Gallery Templates page', 'Gallery showcases', 'manage_options', 'responsive_gallery-snm-bar-submenu-page', 'snm_register_responsive_gallery_page_callback' );

}
function snm_register_responsive_gallery_page_callback() {

	$result ='<div class="wrap"><div id="icon-tools" class="icon32"></div><h2 style="padding:15px 0">Gallery Slider Designs</h2></div>
			<div class="medium-6 columns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'images/design-1.jpg"></div></div>
			<div class="medium-6 columns"><div class="postdesigns"><strong> Complete shortcode is: </strong><p><code>[snm_gallery.slider cat_id="9" items="3" autoplay_interval="3000" width="600" height="245"]</code></p></div></div>';

	echo $result;

}

function snm_register_responsive_gallery_admin_style(){
	?>
	<style type="text/css">
	.postdesigns{-moz-box-shadow: 0 0 5px #ddd;-webkit-box-shadow: 0 0 5px#ddd;box-shadow: 0 0 5px #ddd; background:#fff; padding:10px;  margin-bottom:15px;}
	.column, .columns {-webkit-box-sizing: border-box;-moz-box-sizing: border-box;  box-sizing: border-box;}
.postdesigns img{width:100%; height:auto;}
@media only screen and (min-width: 40.0625em) {  
  .column,
  .columns {position: relative;padding-left:10px;padding-right:10px;float: left; }
  .medium-1 {    width: 8.33333%; }
  .medium-2 {    width: 16.66667%; }
  .medium-3 {    width: 25%; }
  .medium-4 {    width: 33.33333%; }
  .medium-5 {    width: 41.66667%; }
  .medium-6 {    width: 50%; }
  .medium-7 {    width: 58.33333%; }
  .medium-8 {    width: 66.66667%; }
  .medium-9 {    width: 75%; }
  .medium-10 {    width: 83.33333%; }
  .medium-11 {    width: 91.66667%; }
  .medium-12 {    width: 100%; } 
   }
	</style>

<?php }

add_action('admin_head', 'snm_register_responsive_gallery_admin_style');

