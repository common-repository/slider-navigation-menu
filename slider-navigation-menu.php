<?php
/*
Plugin Name: Slider Navigation Menu
Plugin URL: http://beautiful-module.com/demo/slider-navigation-menu/
Description: A simple Responsive Slider Navigation Menu
Version: 1.0
Author: Module Express
Author URI: http://beautiful-module.com
Contributors: Module Express
*/
/*
 * Register CPT snm_gallery.slider
 *
 */
if(!class_exists('Slider_Navigation_Menu')) {
	class Slider_Navigation_Menu {

		function __construct() {
		    if(!function_exists('add_shortcode')) {
		            return;
		    }
			add_action ( 'init' , array( $this , 'snm_responsive_gallery_setup_post_types' ));

			/* Include style and script */
			add_action ( 'wp_enqueue_scripts' , array( $this , 'snm_register_style_script' ));
			
			/* Register Taxonomy */
			add_action ( 'init' , array( $this , 'snm_responsive_gallery_taxonomies' ));
			add_action ( 'add_meta_boxes' , array( $this , 'snm_rsris_add_meta_box_gallery' ));
			add_action ( 'save_post' , array( $this , 'snm_rsris_save_meta_box_data_gallery' ));
			register_activation_hook( __FILE__, 'snm_responsive_gallery_rewrite_flush' );


			// Manage Category Shortcode Columns
			add_filter ( 'manage_responsive_snm_slider-category_custom_column' , array( $this , 'snm_responsive_gallery_category_columns' ), 10, 3);
			add_filter ( 'manage_edit-responsive_snm_slider-category_columns' , array( $this , 'snm_responsive_gallery_category_manage_columns' ));
			require_once( 'snm_gallery_admin_settings_center.php' );
		    add_shortcode ( 'snm_gallery.slider' , array( $this , 'snm_responsivegallery_shortcode' ));
		}


		function snm_responsive_gallery_setup_post_types() {

			$responsive_gallery_labels =  apply_filters( 'snm_gallery_slider_labels', array(
				'name'                => 'Slider Navigation Menu',
				'singular_name'       => 'Slider Navigation Menu',
				'add_new'             => __('Add New', 'snm_gallery_slider'),
				'add_new_item'        => __('Add New Image', 'snm_gallery_slider'),
				'edit_item'           => __('Edit Image', 'snm_gallery_slider'),
				'new_item'            => __('New Image', 'snm_gallery_slider'),
				'all_items'           => __('All Images', 'snm_gallery_slider'),
				'view_item'           => __('View Image', 'snm_gallery_slider'),
				'search_items'        => __('Search Image', 'snm_gallery_slider'),
				'not_found'           => __('No Image found', 'snm_gallery_slider'),
				'not_found_in_trash'  => __('No Image found in Trash', 'snm_gallery_slider'),
				'parent_item_colon'   => '',
				'menu_name'           => __('Slider Navigation Menu', 'snm_gallery_slider'),
				'exclude_from_search' => true
			) );


			$responsiveslider_args = array(
				'labels' 			=> $responsive_gallery_labels,
				'public' 			=> true,
				'publicly_queryable'		=> true,
				'show_ui' 			=> true,
				'show_in_menu' 		=> true,
				'query_var' 		=> true,
				'capability_type' 	=> 'post',
				'has_archive' 		=> true,
				'hierarchical' 		=> false,
				'menu_icon'   => 'dashicons-format-gallery',
				'supports' => array('title','editor','thumbnail')
				
			);
			register_post_type( 'snm_gallery_slider', apply_filters( 'sp_faq_post_type_args', $responsiveslider_args ) );

		}
		
		function snm_register_style_script() {
		    wp_enqueue_style( 'snm_responsiveimgslider',  plugin_dir_url( __FILE__ ). 'css/responsiveimgslider.css' );
			/*   REGISTER ALL CSS FOR SITE */
			wp_enqueue_style( 'snm_main',  plugin_dir_url( __FILE__ ). 'css/font-awesome.css' );			
			wp_enqueue_style( 'snm_style',  plugin_dir_url( __FILE__ ). 'css/owl.carousel.css' );	
			wp_enqueue_style( 'snm_theme',  plugin_dir_url( __FILE__ ). 'css/owl.theme.css' );				
			wp_enqueue_style( 'snm_slider',  plugin_dir_url( __FILE__ ). 'css/slider-navigation-menu.css' );			

			/*   REGISTER ALL JS FOR SITE */	
			wp_enqueue_script( 'snm_carousel', plugin_dir_url( __FILE__ ) . 'js/owl.carousel.js', array( 'jquery' ));
		}
		
		
		function snm_responsive_gallery_taxonomies() {
		    $labels = array(
		        'name'              => _x( 'Category', 'taxonomy general name' ),
		        'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
		        'search_items'      => __( 'Search Category' ),
		        'all_items'         => __( 'All Category' ),
		        'parent_item'       => __( 'Parent Category' ),
		        'parent_item_colon' => __( 'Parent Category:' ),
		        'edit_item'         => __( 'Edit Category' ),
		        'update_item'       => __( 'Update Category' ),
		        'add_new_item'      => __( 'Add New Category' ),
		        'new_item_name'     => __( 'New Category Name' ),
		        'menu_name'         => __( 'Gallery Category' ),
		    );

		    $args = array(
		        'hierarchical'      => true,
		        'labels'            => $labels,
		        'show_ui'           => true,
		        'show_admin_column' => true,
		        'query_var'         => true,
		        'rewrite'           => array( 'slug' => 'responsive_snm_slider-category' ),
		    );

		    register_taxonomy( 'responsive_snm_slider-category', array( 'snm_gallery_slider' ), $args );
		}

		function snm_responsive_gallery_rewrite_flush() {  
				snm_responsive_gallery_setup_post_types();
		    flush_rewrite_rules();
		}


		function snm_responsive_gallery_category_manage_columns($theme_columns) {
		    $new_columns = array(
		            'cb' => '<input type="checkbox" />',
		            'name' => __('Name'),
		            'gallery_snm_shortcode' => __( 'Gallery Category Shortcode', 'snm_slick_slider' ),
		            'slug' => __('Slug'),
		            'posts' => __('Posts')
					);

		    return $new_columns;
		}

		function snm_responsive_gallery_category_columns($out, $column_name, $theme_id) {
		    $theme = get_term($theme_id, 'responsive_snm_slider-category');

		    switch ($column_name) {      
		        case 'title':
		            echo get_the_title();
		        break;
		        case 'gallery_snm_shortcode':
					echo '[snm_gallery.slider cat_id="' . $theme_id. '"]';			  	  

		        break;
		        default:
		            break;
		    }
		    return $out;   

		}

		/* Custom meta box for slider link */
		function snm_rsris_add_meta_box_gallery() {
			add_meta_box('custom-metabox',__( 'LINK URL', 'link_textdomain' ),array( $this , 'snm_rsris_gallery_box_callback' ),'snm_gallery_slider');			
		}
		
		function snm_rsris_gallery_box_callback( $post ) {
			wp_nonce_field( 'snm_rsris_save_meta_box_data_gallery', 'rsris_meta_box_nonce' );
			$value = get_post_meta( $post->ID, 'rsris_snm_link', true );
			echo '<input type="url" id="rsris_snm_link" name="rsris_snm_link" value="' . esc_attr( $value ) . '" size="80" /><br />';
			echo 'ie http://www.google.com';
		}
		
		function snm_truncate($string, $length = 100, $append = "&hellip;")
		{
			$string = trim($string);
			if (strlen($string) > $length)
			{
				$string = wordwrap($string, $length);
				$string = explode("\n", $string, 2);
				$string = $string[0] . $append;
			}

			return $string;
		}
			
		function snm_rsris_save_meta_box_data_gallery( $post_id ) {
			if ( ! isset( $_POST['rsris_meta_box_nonce'] ) ) {
				return;
			}
			if ( ! wp_verify_nonce( $_POST['rsris_meta_box_nonce'], 'snm_rsris_save_meta_box_data_gallery' ) ) {
				return;
			}
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}
			if ( isset( $_POST['post_type'] ) && 'snm_gallery_slider' == $_POST['post_type'] ) {

				if ( ! current_user_can( 'edit_page', $post_id ) ) {
					return;
				}
			} else {

				if ( ! current_user_can( 'edit_post', $post_id ) ) {
					return;
				}
			}
			if ( ! isset( $_POST['rsris_snm_link'] ) ) {
				return;
			}
			$link_data = sanitize_text_field( $_POST['rsris_snm_link'] );
			update_post_meta( $post_id, 'rsris_snm_link', $link_data );
		}
		
		/*
		 * Add [snm_gallery.slider] shortcode
		 *
		 */
		function snm_responsivegallery_shortcode( $atts, $content = null ) {
			
			extract(shortcode_atts(array(
				"limit"  => '',
				"cat_id" => '',
				"autoplay_interval" => '',
				"items" => '',
				"width" => ''
			), $atts));
			
			if( $limit ) { 
				$posts_per_page = $limit; 
			} else {
				$posts_per_page = '-1';
			}
			if( $cat_id ) { 
				$cat = $cat_id; 
			} else {
				$cat = '';
			}
			
			if( $autoplay_interval ) { 
				$autoplay_slider = $autoplay_interval; 
			} else {
				$autoplay_slider = '3000';
			}
			
			if( $width ) { 
				$width_slider = $width. "px"; 
			} else {
				$width_slider = '100%';
			}
			
			if( $items ) { 
				$items_slider = $items; 
			} else {
				$items_slider = '3';
			}				

			ob_start();
			// Create the Query
			$post_type 		= 'snm_gallery_slider';
			$orderby 		= 'post_date';
			$order 			= 'DESC';
						
			 $args = array ( 
		            'post_type'      => $post_type, 
		            'orderby'        => $orderby, 
		            'order'          => $order,
		            'posts_per_page' => $posts_per_page,  
		           
		            );
			if($cat != ""){
		            	$args['tax_query'] = array( array( 'taxonomy' => 'responsive_snm_slider-category', 'field' => 'id', 'terms' => $cat) );
		            }        
		      $query = new WP_Query($args);

			$post_count = $query->post_count;
			$i = 0;

			if( $post_count > 0) :
			
			$list_collection = array(); 
			?>
			
			<div style="width:<?php echo $width_slider; ?>">
			  <div class="snm_gallery_slider">
				 <a class="prev" title="Prev" id="prev-1"><i class="fa fa-caret-left"></i></a>
				 <a class="next" title="Next" id="next-1"><i class="fa fa-caret-right"></i></a>
				 <div id="snm-slider-navigation" class="owl-carousel owl-theme">
					<?php			
						  while ($query->have_posts()) : $query->the_post();
								include('designs/template.php');
						  $i++;
						  endwhile;	

					  ?>
				 </div>
			  </div>
			</div>		
			<?php
				endif;
				// Reset query to prevent conflicts
				wp_reset_query();
			?>							
			<script type="text/javascript">
			jQuery(document).ready(function($) {
				var prodhome = $('#snm-slider-navigation');
				prodhome.owlCarousel({
					autoPlay: <?php echo $autoplay_slider; ?>, //Set AutoPlay to 3 seconds
					items: <?php echo $items_slider; ?>,
					itemsDesktop: [1024, 3],
					itemsDesktopSmall: [960, 3],
					itemsTablet: [640, 2],
					pagination: false
				});
				$("#next-1").click(function () {

					prodhome.trigger('owl.next');
				});
				$("#prev-1").click(function () {

					prodhome.trigger('owl.prev');
				});
			});
		</script>
			<?php
			return ob_get_clean();
		}		
	}
}
	
function snm_master_gallery_images_load() {
        global $mfpd;
        $mfpd = new Slider_Navigation_Menu();
}
add_action( 'plugins_loaded', 'snm_master_gallery_images_load' );
?>