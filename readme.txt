=== Slider Navigation Menu ===
Contributors: Module Express
Donate link: http://beautiful-module.com/
Tags: Slider Navigation Menu,Slider Navigation Menu,mobile touch Slider Menu,image slider,responsive header gallery slider,responsive banner slider,responsive header banner slider,header banner slider,responsive slideshow,header image slideshow
Requires at least: 3.5
Tested up to: 4.4
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A quick, easy way to add an Responsive header Slider Navigation Menu OR Responsive Slider Navigation Menu inside wordpress page OR Template. Also mobile touch Slider Navigation Menu

== Description ==

This plugin add a Responsive Slider Navigation Menu in your website. Also you can add Responsive Slider Navigation Menu page and mobile touch slider in to your wordpress website.

View [DEMO](http://beautiful-module.com/demo/slider-navigation-menu/) for additional information.

= Installation help and support =

The plugin adds a "Responsive Slider Navigation Menu" tab to your admin menu, which allows you to enter Image Title, Content, Link and image items just as you would regular posts.

To use this plugin just copy and past this code in to your header.php file or template file 
<code><div class="headerslider">
 <?php echo do_shortcode('[snm_gallery.slider]'); ?>
 </div></code>

You can also use this Slider Navigation Menu inside your page with following shortcode 
<code>[snm_gallery.slider] </code>

Display Slider Navigation Menu catagroies wise :
<code>[snm_gallery.slider cat_id="cat_id"]</code>
You can find this under  "Slider Navigation Menu-> Gallery Category".

= Complete shortcode is =
<code>[snm_gallery.slider cat_id="9" autoplay_interval="3000" width="600" height="245"]</code>
 
Parameters are :

* **limit** : [snm_gallery.slider limit="-1"] (Limit define the number of images to be display at a time. By default set to "-1" ie all images. eg. if you want to display only 5 images then set limit to limit="5")
* **cat_id** : [snm_gallery.slider cat_id="2"] (Display Image slider catagroies wise.) 
* **autoplay_interval** : [snm_gallery.slider autoplay_interval="3000"] (Set autoplay interval. default value is 3 seconds)
* **items** : [snm_gallery.gallery items="4"] (Set slider number that you want to display, default are 3 items)
* **width** : [snm_gallery.slider width="600"] (Set the width of slider that you want to display, default is "100%"))
* **height** : [snm_gallery.slider height="245"] (Set the height of slider that you want to display, default is "100%"))

= Features include: =
* Mobile touch slide
* Responsive
* Shortcode <code>[snm_gallery.slider]</code>
* Php code for place image slider into your website header  <code><div class="headerslider"> <?php echo do_shortcode('[snm_gallery.slider]'); ?></div></code>
* Slider Navigation Menu inside your page with following shortcode <code>[snm_gallery.slider] </code>
* Easy to configure
* Smoothly integrates into any theme
* CSS and JS file for custmization

== Installation ==

1. Upload the 'slider-navigation-menu' folder to the '/wp-content/plugins/' directory.
2. Activate the 'Slider Navigation Menu' list plugin through the 'Plugins' menu in WordPress.
3. If you want to place Slider Navigation Menu into your website header, please copy and paste following code in to your header.php file  <code><div class="headerslider"> <?php echo do_shortcode('[snm_gallery.slider limit="-1"]'); ?></div></code>
4. You can also display this Images slider inside your page with following shortcode <code>[snm_gallery.slider limit="-1"] </code>


== Frequently Asked Questions ==

= Are there shortcodes for Slider Navigation Menu items? =

If you want to place Slider Navigation Menu into your website header, please copy and paste following code in to your header.php file  <code><div class="headerslider"> <?php echo do_shortcode('[snm_gallery.slider limit="-1"]'); ?></div>  </code>

You can also display this Slider Navigation Menu inside your page with following shortcode <code>[snm_gallery.slider limit="-1"] </code>



== Screenshots ==
1. Designs Views from admin side
2. Catagroies shortcode

== Changelog ==

= 1.0 =
Initial release