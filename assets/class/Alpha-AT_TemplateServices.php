<?php
namespace Alpha {
	/**
	 * Prepares data used in front end pages.
	 *
	 * @package ThemeMountain
	 * @subpackage Core/marquez-by-thememountain
	 * @since 1.0
	 * @uses       TM_Customizer::tm_get_theme_mod(), TM_PageOptions::get_page_options()
	 */
	class AT_TemplateServices extends AT_AlphaThemes {
		/**
		 * Protected run time properties
		 */

		/**
		 * Used for storing the current template loaded such as page options and other post information.
		 *
		 * It holds post data values of initially loaded page.
		 *
		 * @since 1.0
		 * @access protected
		 * @uses       TM_TemplateServices::set_current_template_data() $current_page_data is supposed to be written only within the function
		 * @see        TM_TemplateServices::on_template_include()
		 * @see        TM_TemplateServices::preprocess_custom_options_for_header()
		 * @see        TM_TemplateServices::tm_page_head_title_animate_in_attribute()
		 *
		 * @var        array $current_page_data
		 *
		 */
		protected static $current_page_data = array();

		/**
		 * Private Run time properties
		 */

		/**
		 * Primary template filename currently loaded.
		 *
		 * @since 1.0
		 * @access private
		 * @see        TM_TemplateServices::on_template_include() The value is set in the filter function.
		 * @see        https://wphierarchy.com/ See The WordPress Template Hierarchy for details.
		 *
		 * @var        string Template file name e.g. 'single.php', 'home.php', 'archive.php' etc.
		 */
		// private static $current_template_filename = '';

		/**
		 * Used for storing runtime post data such as page options and other post information.
		 *
		 * @since 1.0
		 * @access private
		 * @uses       TM_TemplateServices::set_current_template_data() $current_page_data is supposed to be written only within the function
		 *
		 * @var        array $current_page_data
		 *
		 */
		private static $runtime_post_data_cache = array();

		/**
		 * Holds custom srcset mode.
		 *
		 * @since 1.0.1
		 * @access private
		 * @uses       TM_TemplateServices::tm_custom_image_sizes()
		 * @see        TM_TemplateServices::tm_custom_image_sizes()
		 *
		 * @var        string
		 */
		private static $tm_custom_image_sizes_mode = '';

		/**
		 * End Properties
		 *
		 * Begin Method
		 */

		/**
		 * Class Constructor Magic Method.
		 *
		 * @since 1.0
		 * @access public
		 */
		public function __construct() {
			/** Main reason for this is being able to remove the class when needed i.e. child themes. */
			add_filter( 'body_class',['ThemeMountain\\TM_TemplateServices','tm_custom_body_class']);
			/** custom srcset size */
			add_filter( 'wp_calculate_image_sizes', ['ThemeMountain\\TM_TemplateServices','tm_custom_image_sizes'], 10 , 2 );
			add_filter( 'template_include', ['ThemeMountain\\TM_TemplateServices','on_template_include'] , 1000 );
		}

		/**
		 * Public Methods for hooks
		 */

		/**
		 * Filter hook function for template_include.
		 *
		 * @since 1.0
		 * @access public
		 *
		 * @uses       TM_TemplateServices::$current_template_filename
		 * @uses       TM_TemplateServices::set_current_template_data()
		 * @uses       TM_ThemeServices::get_current_theme_style_properties()
		 * @uses       TM_StyleAndScripts::enqueueInlineCustomizerCss()
		 * @uses       TM_ThemeServices::get_current_theme_style_id()
		 * @uses       TM_TemplateServices::$current_page_data The variable should have been populated by the time Wordpress executes this function.
		 * @uses       TM_MastheadServices::preprocess_custom_options_for_masthead()
		 * @uses       TM_NavMenuServices::preprocess_custom_options_for_nav_menu()
		 *
		 * @param string $template_path The path of the template to include.
		 *
		 * @return string $template_path The path of the template to include. The function does not make any modification to the variable
		 */
		public static function on_template_include ($template_path) {
			/**
			 * Set current template filename <unused for now>
			 */
			// self::$current_template_filename = str_replace( '.php','', basename($template_path) );

			/**
			 * set template data here. the following functions are private (not accessible from elsewhere)
			 */
			self::set_current_template_data();

			/**
			 * enqueue custom options (CSS)
			 */
			$_current_theme_style_settings = TM_ThemeServices::get_current_theme_style_properties('settings');
			foreach ($_current_theme_style_settings as $_key => $_value) {
				/** set the 3rd parameter to TRUE to print settings ID */
				TM_StyleAndScripts::enqueueInlineCustomizerCss($_key);
			}

			/**
			 * Preprocesses custom options
			 * @since 1.0
			 * @see        TM_NavMenuServices::preprocess_custom_options_for_nav_menu()
			 */
			do_action('tm_preprocess_custom_options');

			/**
			 * Theme Style Custom Action hook.
			 */
			do_action('tm_theme_style_custom_action_'.TM_ThemeServices::get_current_theme_style_id());

			/**
			 * Resume
			 */
			return $template_path;
		}

		/**
		 * Filter hook function for custom body_class.
		 * Adds theme style id and rtl class if necessary.
		 *
		 * @since 1.0.1
		 * @access public
		 *
		 * @uses       body_class filter hook
		 *
		 * @see        header.php
		 *
		 * @return     array  classes
		 */
		public static function tm_custom_body_class($classes) {
			/** Adds theme style to the body class*/
			array_push($classes, 'tm-themestyle-'.TM_ThemeStrings::$theme_id.'_'.TM_ThemeServices::get_current_theme_style_id());
			/** Global Button Color Settings */
			if(TM_Customizer::tm_get_theme_mod('tm_button_set_global_color') === TRUE) {
				if($_tm_button_size = TM_Customizer::tm_get_theme_mod('tm_button_size')){
					array_push($classes, $_tm_button_size);
				}
				if($_tm_button_style = TM_Customizer::tm_get_theme_mod('tm_button_style')){
					array_push($classes, $_tm_button_style);
				}
			}
			/** Adds RTL body class if tm_language_direction is set to rtl */
			if(is_rtl()) {
				array_push($classes, 'rtl');
			}
			return $classes;
		}

		/**
		 * Filter hook function for custom srcset.
		 *
		 * @since 1.0.1
		 * @access public
		 *
		 * @uses       wp_calculate_image_sizes filter hook
		 * @uses       TM_TemplateServices::$tm_custom_image_sizes_mode
		 *
		 * @see        TM_TemplateServices::generate_image_tag_from_id()
		 *
		 * @return     string  ( data attribute declaration )
		 */
		public static function tm_custom_image_sizes ($sizes, $size) {
			$_srcset_size_presets = array(
				'grid-3' => '(min-width: 1025px) 33.3vw, (min-width: 601px) 50vw, (min-width: 481px) 100vw, 100vw',
				'grid-4' => '(min-width: 1141px) 25vw, (min-width: 1025px) 33.3vw, (min-width: 601px) 50vw, (min-width: 481px) 100vw, 100vw',
				);
			if(!empty(self::$tm_custom_image_sizes_mode) && isset($_srcset_size_presets[self::$tm_custom_image_sizes_mode])) {
				return $_srcset_size_presets[self::$tm_custom_image_sizes_mode];
			} else {
				return $sizes;
			}
		}

		/**
		 * General Page Services
		 */

		/**
		 * Public Methods accessible from anywhere
		 */

		/**
		 * Returns data attribute of setting field by key.
		 *
		 * @param      <type>  $key        		The setting item key
		 * @param      <type>  $setting_value	The setting item value
		 * @param      <type>  $_add_space  	The add space if set to true
		 *
		 * @return     string  ( data attribute declaration )
		 */
		public static function tm_return_field_data_attribute ( $key , $setting_value = '', $ignore_dependency = FALSE, $add_space = TRUE ) {

			/**
			 * read properties
			 */
			$_data_attribute = TM_Customizer::get_theme_mod_field_property($key,'data_attribute');

			/**
			 * Error handling: does the field exist?
			 */
			if(!isset($_data_attribute)) {
				return "Key or property not found @ tm_return_field_data_attribute(): $key\n";
			}

			/**
			 * Check up dependency and output values with data attribute
			 */
			if(!empty($setting_value)) {
				/** Check for active_callback dependency */
				if(
					TM_Customizer::evaluate_active_callback($key) === FALSE &&
					$ignore_dependency == FALSE
				) {
					return '';
				}
				/** Generate data attribute and value */
				if(empty($_data_attribute)) {
					return '';
				} else if(is_array($_data_attribute)) {
					$_attribute_declaration = array();
					foreach ($_data_attribute as $_value) {
						array_push($_attribute_declaration, "{$_value}='{$setting_value}'");
					}
					$_attribute_declaration = implode(' ',$_attribute_declaration);
				} else {
					$_attribute_declaration = "{$_data_attribute}='{$setting_value}'";
				}
				/** Add space in front if $add_space is set to true. */
				if($add_space === TRUE) {
					$_attribute_declaration = ' '.$_attribute_declaration;
				}
				return $_attribute_declaration;
			} else {
				return '';
			}
		}

		/**
		 * Wordpress Responsive Image (since Wordpress 4.4) related functions
		 */
		/**
		 * Generate img tag from id or url.
		 *
		 * @param      <string>  $image_id         The image identifier
		 * @param      boolean $echo echo or not
		 * @param      integer $srcset_sizes_id The number of grids. Something to do with srcset.
		 *
		 * @return     <string>  ( returns img tag )
		 */
		public static function generate_image_tag_from_id ( $image_id = '', $alt = '', $echo = FALSE, $srcset_sizes_id= FALSE) {
			/** return if no id is set */
			if(empty($image_id)) return '';
			/** init local variable */
			$_result = '';
			/**
			 * try to see if the URL (in case of non numeric string)
			 * is available in the server.
			 */
			$_is_locally_avail = (is_numeric($image_id)) ? $image_id : attachment_url_to_postid($image_id);
			/** if locally avail, there should be id */
			if($_is_locally_avail !== 0) {
				if($srcset_sizes_id !== FALSE) {
					self::$tm_custom_image_sizes_mode = $srcset_sizes_id;
				}
				$_result = wp_get_attachment_image( $_is_locally_avail, 'full', false);
			} else {
				/** for all other cases when id is not avail, assume the image id as url */
				$image_id = esc_html($image_id);
				$_result = "<img src='{$image_id}' alt='".htmlspecialchars(esc_html($alt))."'>";
			}

			// reset once
			self::$tm_custom_image_sizes_mode = '';

			if($echo === TRUE) {
				// the content of variable $_result originates from Wordpress functions or any user inputs are made sure to be escaped within this function.
				echo ($_result);
			} else {
				return $_result;
			}
		}

		/**
		 * Apply the_content filter while the $enquque_deferred_style_in_footer flag is set to TRUE
		 * All the shortcode css enqueued in this function will be in the footer that uses javasctript deferred technique.
		 *
		 * @see        TM_StyleAndScripts::tm_enqueue_styles_in_footer()
		 * @uses       TM_Shortcodes::$enquque_deferred_style_in_footer
		 */
		public static function apply_content_filter_and_enqueue_deferred_css($raw_content){
			if(class_exists('\\ThemeMountain\\TM_Shortcodes') && isset(TM_Shortcodes::$enquque_deferred_style_in_footer)) {
				TM_Shortcodes::$enquque_deferred_style_in_footer = TRUE;
				$_filtered_content = apply_filters( 'the_content', $raw_content );
				TM_Shortcodes::$enquque_deferred_style_in_footer = FALSE;
				return $_filtered_content;
			} else {
				return apply_filters( 'the_content', $raw_content );
			}
		}


		/**
		 * Returns runtime current page data / options in cache for runtime posts.
		 *
		 * To be identified with TM_TemplateServices::get_runtime_page_data() and TM_TemplateServices::$current_page_data which holds post data values of initially loaded page.
		 *
		 * @since 1.0
		 * @access public
		 * @uses       TM_TemplateServices::$runtime_post_data_cache
		 * @uses       TM_TemplateServices::get_post_data_at_once()
		 * @see        Template files.
		 *
		 * @param      string|array $data_field_name The data field name. If it is an array, the 1st is for a field name and the 2nd value in array is the key for the array within. Returns as if if empty.
		 * @param      boolean $do_update_cache Update the cache of current post data if set to TRUE.
		 *
		 * @return     array  The current page options. Returns an empty array if there is no option available.
		 */
		public static function get_runtime_page_data( $data_field_name = '', $do_update_cache = FALSE ){
			// update if set to TRUE
			if($do_update_cache === TRUE){
				self::$runtime_post_data_cache = self::get_post_data_at_once(NULL,TRUE);
			}
			// $data_field_name
			if(empty($data_field_name)){
				return self::$runtime_post_data_cache;
			} else if (
				is_array($data_field_name) &&
				array_key_exists($data_field_name[0], self::$runtime_post_data_cache) &&
				array_key_exists($data_field_name[1], self::$runtime_post_data_cache[$data_field_name[0]])
			) {
				return self::$runtime_post_data_cache[$data_field_name[0]][$data_field_name[1]];
			} else if (is_array($data_field_name)) {
				// No results
				return array();
			} else if( isset(self::$runtime_post_data_cache[$data_field_name]) ) {
				return self::$runtime_post_data_cache[$data_field_name];
			}
			// No results
			return array();
		}

		/**
		 * Returns current page data / options in cache.
		 *
		 * @since 1.0
		 * @access public
		 * @uses       TM_TemplateServices::$current_page_data This variable is cached once at TM_TemplateServices::set_current_template_data().
		 * @see        TM_TemplateServices::set_current_template_data()
		 * @see        Template files.
		 *
		 * @param      string|array $data_field_name The data field name. If it is an array, the 1st is for a field name and the 2nd value in array is the key for the array within. Returns as if if empty.
		 *
		 * @return     array  The current page options. Returns an empty array if there is no option available.
		 */
		public static function get_current_page_data( $data_field_name = ''){
			// $data_field_name
			if(empty($data_field_name)){
				return self::$current_page_data;
			} else if (
				is_array($data_field_name) &&
				array_key_exists($data_field_name[0], self::$current_page_data) &&
				array_key_exists($data_field_name[1], self::$current_page_data[$data_field_name[0]])
			) {
				return self::$current_page_data[$data_field_name[0]][$data_field_name[1]];
			} else if (is_array($data_field_name)) {
				// No results
				return FALSE;
			} else if( isset(self::$current_page_data[$data_field_name]) ) {
				return self::$current_page_data[$data_field_name];
			}
			// No results
			return array();
		}

		/**
		 * Protected Methods
		 */

		/**
		 * Private Methods
		 */

		/**
		 * Storing the current template loaded such as page options and other post information.
		 *
		 * It holds post data values of initially loaded page. $current_page_data is supposed to be written only within the function which is involved in TM_TemplateServices::on_template_include().
		 *
		 * Also supports page options set in the homepage_with_posts.php custom page template
		 *
		 * @since 1.0
		 * @access private
		 * @uses       TM_TemplateServices::$current_page_data
		 * @uses       TM_CustomCategoryPage::get_custom_category_page_id()
		 * @see        TM_TemplateServices::on_template_include()
		 */
		private static function set_current_template_data () {
			/** init varisbales */
			$_page_head_title_caption = '';
			$_page_template_slug = '';
			$_template_type = '';
			$_custom_category_page = FALSE;
			$_is_custom_404 = NULL;

			/**
			 * Detect loop type (post type) and set masthead title caption.
			 */
			$_is_shop = FALSE;

			/**
			 * For woocommerce tags, see https://docs.woocommerce.com/document/conditional-tags/
			 */
			if(function_exists('is_shop') && is_shop()) {
				$_template_type = 'shop';
				$_is_shop = TRUE;
				$_is_shop_page_installed = get_option( 'woocommerce_shop_page_id' );
				if(empty($_is_shop_page_installed) || get_post_status($_is_shop_page_installed) == FALSE) {
					$_page_head_title_caption = woocommerce_page_title(false);
				} else {
					$_page_head_title_caption = get_the_title($_is_shop_page_installed);
					/** Get all the settings and page options for the current page */
					self::$current_page_data = self::get_post_data_at_once($_is_shop_page_installed,TRUE);
				}
			} else if ( is_category () || is_tax() ) {
				$_template_type = 'category';
				$_page_head_title_caption = TM_ThemeStrings::$text_strings['TM_TemplateServices']['category_archives'];
				$_page_title_from_wordpress = single_cat_title( '', false );
				$_queried_object = get_queried_object();
				$_custom_category_page = TM_CustomCategoryPage::get_custom_category_page_id($_queried_object->taxonomy,$_queried_object->slug);
			} else if (is_search()) {
				$_template_type = 'search';
				$_page_head_title_caption = TM_ThemeStrings::$text_strings['TM_TemplateServices']['search_results_for'];
				$_page_title_from_wordpress = esc_html( get_search_query() );
				$_search_message = TM_ThemeStrings::$text_strings['TM_TemplateServices']['search_more'];
			} else if (is_author () ) {
				$_template_type = 'author';
				$_page_head_title_caption = TM_ThemeStrings::$text_strings['TM_TemplateServices']['all_posts_by'];
				$_page_title_from_wordpress = get_the_author();
			} else if ( is_404 () ) {
				$_template_type = '404';
				// find out if this is a custom 404 page
				$_tm_error_page_type =  TM_Customizer::tm_get_theme_mod('tm_error_page_type');
				$_tm_error_page_id_to_show =  TM_Customizer::tm_get_theme_mod('tm_error_page_id_to_show');
				if($_tm_error_page_type === 'error_page' && get_post_status($_tm_error_page_id_to_show) === 'publish') {
					// use tm_error_page
					$_is_custom_404 = TRUE;
					$_page_head_title_caption = get_the_title($_tm_error_page_id_to_show);
					/** Get all the settings and page options for the current page */
					self::$current_page_data = self::get_post_data_at_once($_tm_error_page_id_to_show,TRUE);
				} else {
					// use default
					$_is_custom_404 = FALSE;
					$_page_head_title_caption = TM_ThemeStrings::$text_strings['TM_TemplateServices']['not_found_title_caption'];
					$_search_message = TM_ThemeStrings::$text_strings['TM_TemplateServices']['results_not_found_message'];
				}
			} else if ( is_home() ) {
				$_template_type = 'home';
				$_page_head_title_caption = get_bloginfo('description');
			} else if (is_post_type_archive('tm_folio') === TRUE ) {
				$_template_type = 'tm_folio';
				$_page_head_title_caption = TM_ThemeStrings::$text_strings['TM_TemplateServices']['portfolio'];
			} else if (!is_singular()) {
				$_template_type = 'archive';
				$_page_head_title_caption = get_the_archive_title( '' , FALSE );

			}

			/**
			 * Handling for singular Or others.
			 */
			if ( is_singular() || $_custom_category_page !== FALSE) {
				/** get the current id **/
				$_current_page_id = (empty($_custom_category_page)) ? get_the_ID() : $_custom_category_page;
				/** Get all the settings and page options for the current page */
				self::$current_page_data = self::get_post_data_at_once($_current_page_id,TRUE);
				/* find post type for the singular page */
				$_template_type = self::$current_page_data['post_type'];

				/**
				 * Find page template slug. usually blank
				 * Used for homepage_with_posts page tempalte
				 */
				$_page_template_slug = get_page_template_slug();

				/** For Masthead settings, see TM_MastheadServices */
				/** For Footer settings, see TM_PageFooterServices */
				/* May use the customizer settings (overwrite) of the page title settings */
			} else {
				/** Set value or to default for the page head title */
				if( !isset($_page_title_from_wordpress) ) {
					$_page_title_from_wordpress = '';
				}

				/* page head title caption */
				$_page_head_title_caption = self::handle_loop_template_title($_template_type, $_page_head_title_caption, $_page_title_from_wordpress );

				/**  Set page title caption */
				self::$current_page_data['title'] = $_page_head_title_caption;

				/** And that for search if necessary */
				if( isset($_search_message) ) {
					$_search_message = self::handle_loop_template_title($_template_type, $_search_message, '' , TRUE );
					self::$current_page_data['options']['search_message'] = $_search_message;
				}

				/**  Set Post type */
				self::$current_page_data['post_type'] = $_template_type;
			}

			/**
			 * Use the global option (home) if use_custom_settings is false
			 */
			if( TM_Customizer::tm_get_theme_mod('tm_use_custom_settings_'.$_template_type) == FALSE ) {
				$_template_type = 'home';
			}

			/**
			 * The following applies to all the looop pages except for the custom home page tempalte, homepage_with_posts.php.
			 */
			if( !is_singular() ) {
				/**
				 * tm_loop_style
				 */
				self::$current_page_data['options']['tm_loop_style'] = TM_Customizer::tm_get_theme_mod('tm_loop_style_'.$_template_type);

				/**
				 * tm_excerpt_grid_layout_columns
				 */
				self::$current_page_data['options']['tm_excerpt_grid_layout_columns'] = TM_Customizer::tm_get_theme_mod('tm_excerpt_grid_layout_columns_'.$_template_type);

				/**
				 * tm_column_gutters
				 */
				self::$current_page_data['options']['tm_column_gutters'] = TM_Customizer::tm_get_theme_mod('tm_column_gutters_'.$_template_type);

				/**
				 * tm_loop_thumbnail_ratio
				 */
				self::$current_page_data['options']['tm_loop_thumbnail_ratio'] = TM_Customizer::tm_get_theme_mod('tm_loop_thumbnail_ratio_'.$_template_type);

				/**
				 * Grid Layout Width
				 */
				self::$current_page_data['options']['tm_grid_layout_width'] = TM_Customizer::tm_get_theme_mod('tm_grid_layout_width_'.$_template_type);

				/**
				 * Grid Box Article Background Color (colorpicker)
				 */
				self::$current_page_data['options']['tm_grid_layout_box_article_background_color'] = TM_Customizer::tm_get_theme_mod('tm_grid_layout_box_article_background_color_'.$_template_type);

				/**
				 * Grid Box Article Color (colorpicker)
				 */
				self::$current_page_data['options']['tm_grid_layout_box_article_color'] = TM_Customizer::tm_get_theme_mod('tm_grid_layout_box_article_color_'.$_template_type);

				/**
				 * Grid Box Article Title Color (colorpicker)
				 */
				self::$current_page_data['options']['tm_grid_layout_box_article_title_color'] = TM_Customizer::tm_get_theme_mod('tm_grid_layout_box_article_title_color_'.$_template_type);

				/**
				 * Grid Box Article Title Hover Color (colorpicker)
				 */
				self::$current_page_data['options']['tm_grid_layout_box_article_title_color_hover'] = TM_Customizer::tm_get_theme_mod('tm_grid_layout_box_article_title_color_hover_'.$_template_type);

				/**
				 * Grid Box Article Link Color (colorpicker)
				 */
				self::$current_page_data['options']['tm_grid_layout_box_article_link_color'] = TM_Customizer::tm_get_theme_mod('tm_grid_layout_box_article_link_color_'.$_template_type);

				/**
				 * Grid Box Article Link Hover Color (colorpicker)
				 */
				self::$current_page_data['options']['tm_grid_layout_box_article_link_color_hover'] = TM_Customizer::tm_get_theme_mod('tm_grid_layout_box_article_link_color_hover_'.$_template_type);

				/**
				 * Article Post Meta Color (colorpicker) (#226)
				 */
				self::$current_page_data['options']['tm_grid_layout_box_article_post_meta_color'] = TM_Customizer::tm_get_theme_mod('tm_grid_layout_box_article_post_meta_color_'.$_template_type);

				/**
				 * Post Rollover Background Color (Wide or Grids layout)
				 */
				self::$current_page_data['options']['tm_post_rollover_background_color_wide_grids'] = TM_Customizer::tm_get_theme_mod('tm_post_rollover_background_color_wide_grids_'.$_template_type);

				/**
				 * Post Rollover Background Color (Creative layout)
				 */
				self::$current_page_data['options']['tm_post_rollover_background_color_creative'] = TM_Customizer::tm_get_theme_mod('tm_post_rollover_background_color_creative_'.$_template_type);

				/**
				 * Post Rollover Color (Wide or Grids layout)
				 */
				self::$current_page_data['options']['tm_post_rollover_color_wide_grids_home'] = TM_Customizer::tm_get_theme_mod('tm_post_rollover_color_wide_grids_home');

				/**
				 * Post Rollover Color (Creative layout)
				 */
				self::$current_page_data['options']['tm_post_rollover_color_creative_home'] = TM_Customizer::tm_get_theme_mod('tm_post_rollover_color_creative_home');
			} else if($_page_template_slug === 'homepage_with_posts.php') {
				/**
				 * Grid Box Article Background Color (colorpicker)
				 */
				self::$current_page_data['options']['tm_grid_layout_box_article_background_color'] = TM_Customizer::tm_get_theme_mod('tm_grid_layout_box_article_background_color_'.$_template_type);

				/**
				 * Grid Box Article Color (colorpicker)
				 */
				self::$current_page_data['options']['tm_grid_layout_box_article_color'] = TM_Customizer::tm_get_theme_mod('tm_grid_layout_box_article_color_'.$_template_type);

				/**
				 * Grid Box Article Title Color (colorpicker)
				 */
				self::$current_page_data['options']['tm_grid_layout_box_article_title_color'] = TM_Customizer::tm_get_theme_mod('tm_grid_layout_box_article_title_color_'.$_template_type);

				/**
				 * Grid Box Article Title Hover Color (colorpicker)
				 */
				self::$current_page_data['options']['tm_grid_layout_box_article_title_color_hover'] = TM_Customizer::tm_get_theme_mod('tm_grid_layout_box_article_title_color_hover_'.$_template_type);

				/**
				 * Grid Box Article Link Color (colorpicker)
				 */
				self::$current_page_data['options']['tm_grid_layout_box_article_link_color'] = TM_Customizer::tm_get_theme_mod('tm_grid_layout_box_article_link_color_'.$_template_type);

				/**
				 * Grid Box Article Link Hover Color (colorpicker)
				 */
				self::$current_page_data['options']['tm_grid_layout_box_article_link_color_hover'] = TM_Customizer::tm_get_theme_mod('tm_grid_layout_box_article_link_color_hover_'.$_template_type);

				/**
				 * Article Post Meta Color (colorpicker) (#226)
				 */
				self::$current_page_data['options']['tm_grid_layout_box_article_post_meta_color'] = TM_Customizer::tm_get_theme_mod('tm_grid_layout_box_article_post_meta_color_'.$_template_type);
			}

			/**
			 * Blog grid item background color and post color needs color options #192
			 *
			 * @since      14 APR 2018
			 */
			if(
				!is_singular() || $_page_template_slug === 'homepage_with_posts.php'
			) {
				// Grid Box Article Background Color (colorpicker)
				TM_StyleAndScripts::process_and_enqueue_inline_customizer_css_settings('tm_grid_layout_box_article_background_color_home',self::$current_page_data['options']['tm_grid_layout_box_article_background_color'],TRUE);
				// Grid Box Color (colorpicker)
				TM_StyleAndScripts::process_and_enqueue_inline_customizer_css_settings('tm_grid_layout_box_article_color_home',self::$current_page_data['options']['tm_grid_layout_box_article_color'],TRUE);
				/**
				 * Grid Box Article Title Color (colorpicker)
				 */
				TM_StyleAndScripts::process_and_enqueue_inline_customizer_css_settings('tm_grid_layout_box_article_title_color_home',self::$current_page_data['options']['tm_grid_layout_box_article_title_color'],TRUE);
				/**
				 * Grid Box Article Title Hover Color (colorpicker)
				 */
				TM_StyleAndScripts::process_and_enqueue_inline_customizer_css_settings('tm_grid_layout_box_article_title_color_hover_home',self::$current_page_data['options']['tm_grid_layout_box_article_title_color_hover'],TRUE);
				/**
				 * Grid Box Article Link Color (colorpicker)
				 */
				TM_StyleAndScripts::process_and_enqueue_inline_customizer_css_settings('tm_grid_layout_box_article_link_color_home',self::$current_page_data['options']['tm_grid_layout_box_article_link_color'],TRUE);
				/**
				 * Grid Box Article Link Hover Color (colorpicker)
				 */
				TM_StyleAndScripts::process_and_enqueue_inline_customizer_css_settings('tm_grid_layout_box_article_link_color_hover_home',self::$current_page_data['options']['tm_grid_layout_box_article_link_color_hover'],TRUE);
				/**
				 * Article Post Meta Color (colorpicker) (#226)
				 */
				TM_StyleAndScripts::process_and_enqueue_inline_customizer_css_settings('tm_grid_layout_box_article_post_meta_color_home',self::$current_page_data['options']['tm_grid_layout_box_article_post_meta_color'],TRUE);
			}

			/**
			 * Pagination Options
			 *
			 * Applicable for all but page post type , shop.
			 */
			if( !is_page() && $_is_shop !== TRUE && $_is_custom_404 !== TRUE) {
				// tm_pagination_*_color_* settings are all to be taken care within the ThemeMountain::TM_StyleAndScripts class
				/**
				 * @see        block-parts/pagination_arrows_return_to_index.php
				 */
				// tm_pagination_return_to_index
				self::$current_page_data['options']['tm_pagination_return_to_index'] = TM_Customizer::tm_get_theme_mod('tm_pagination_return_to_index_'.$_template_type);
				// tm_pagination_return_to_index_label
				self::$current_page_data['options']['tm_pagination_return_to_index_label'] = TM_Customizer::tm_get_theme_mod('tm_pagination_return_to_index_label_'.$_template_type);
			}

			/**
			 * CSS color options for Pagination
			 */
			if($_is_custom_404 !== FALSE){
				TM_StyleAndScripts::process_and_enqueue_inline_customizer_css_settings('tm_pagination_background_color_'.$_template_type,TM_Customizer::tm_get_theme_mod('tm_pagination_background_color_'.$_template_type), FALSE);
				TM_StyleAndScripts::process_and_enqueue_inline_customizer_css_settings('tm_pagination_background_color_hover_'.$_template_type,TM_Customizer::tm_get_theme_mod('tm_pagination_background_color_hover_'.$_template_type), FALSE);
				TM_StyleAndScripts::process_and_enqueue_inline_customizer_css_settings('tm_pagination_background_color_active_'.$_template_type,TM_Customizer::tm_get_theme_mod('tm_pagination_background_color_active_'.$_template_type), FALSE);
				TM_StyleAndScripts::process_and_enqueue_inline_customizer_css_settings('tm_pagination_border_color_'.$_template_type,TM_Customizer::tm_get_theme_mod('tm_pagination_border_color_'.$_template_type), FALSE);
				TM_StyleAndScripts::process_and_enqueue_inline_customizer_css_settings('tm_pagination_border_color_hover_'.$_template_type,TM_Customizer::tm_get_theme_mod('tm_pagination_border_color_hover_'.$_template_type), FALSE);
				TM_StyleAndScripts::process_and_enqueue_inline_customizer_css_settings('tm_pagination_border_color_active_'.$_template_type,TM_Customizer::tm_get_theme_mod('tm_pagination_border_color_active_'.$_template_type), FALSE);
				TM_StyleAndScripts::process_and_enqueue_inline_customizer_css_settings('tm_pagination_link_color_hover_'.$_template_type,TM_Customizer::tm_get_theme_mod('tm_pagination_link_color_hover_'.$_template_type), FALSE);
				TM_StyleAndScripts::process_and_enqueue_inline_customizer_css_settings('tm_pagination_link_color_active_'.$_template_type,TM_Customizer::tm_get_theme_mod('tm_pagination_link_color_active_'.$_template_type), FALSE);
			}

			/**
			 * Set show_recent_post_title if not homepage template
			 * show_recent_post_title
			 * recent_post_title
			 * recent_post_title_alignment
			 * recent_post_title_bottom_padding
			 */
			if(
				$_page_template_slug !== 'homepage_with_posts.php' &&
				$_is_shop !== TRUE &&
				$_is_custom_404 !== TRUE &&
				(self::$current_page_data['options']['show_recent_post_title'] = TM_Customizer::tm_get_theme_mod('show_recent_post_title_'.$_template_type)) !== '0'
			) {
				self::$current_page_data['options']['recent_post_title'] = TM_Customizer::tm_get_theme_mod('recent_post_title_'.$_template_type);
				self::$current_page_data['options']['recent_post_title_alignment'] = TM_Customizer::tm_get_theme_mod('recent_post_title_alignment_'.$_template_type);
				self::$current_page_data['options']['recent_post_title_bottom_padding'] = TM_Customizer::tm_get_theme_mod('recent_post_title_bottom_padding_'.$_template_type);
			}

			/**
			 * tm_use_sidebar
			 */
			if(
				$_page_template_slug !== 'homepage_with_posts.php' &&
				!is_page() &&
				(
					!isset(self::$current_page_data['options']['tm_use_sidebar']) ||
					empty(self::$current_page_data['options']['tm_use_sidebar'])
				)
			) {
				// template is not homepage_with_posts AND tm_use_sidebar is not set. Use the Customizer option.
				self::$current_page_data['options']['tm_use_sidebar'] = TM_Customizer::tm_get_theme_mod('tm_use_sidebar_'.$_template_type);
			} else if (
				$_page_template_slug !== 'homepage_with_posts.php' &&
				!is_page() &&
				(
					isset(self::$current_page_data['options']['tm_use_sidebar']) &&
					self::$current_page_data['options']['tm_use_sidebar'] == 'customizer'
				)
			) {
				// template is not homepage_with_posts AND tm_use_sidebar is set to custom. Use the Customizer option.
				self::$current_page_data['options']['tm_use_sidebar'] = TM_Customizer::tm_get_theme_mod('tm_use_sidebar_'.$_template_type);
			}

			/** For Footer settings, see TM_PageFooterServices */
			/** For Masthead settings, see TM_MastheadServices::preprocess_custom_options_for_masthead() */
		}

		/**
		 * Get current post data. Used for single post and column tempalte.
		 *
		 * @since 1.0
		 * @access private
		 *
		 * @uses       WP Core get_post_type(), get_the_ID(), get_the_title(), get_post_field(), get_post_thumbnail_id(), get_the_category()
		 * @uses       TM_PageOptions::get_page_options()
		 *
		 * @param      integer  $postID   The post id
		 * @param      boolean  $options  Output options or not.
		 *
		 * @return     array   The post data
		 */
		public static function get_post_data_at_once ($postID = NULL, $options = FALSE) {
			if(!isset($postID)) $postID = get_the_ID();
			$_post_data = array();
			$_post_data['id'] = $postID;
			$_post_data['post_type'] = get_post_type($postID);
			$_post_data['title'] = get_the_title($postID);
			$_post_data['post_date'] = get_the_date(); // get_the_date('d').' '.get_the_date('F').' '.get_the_date('Y');
			// author
			$_post_author_id = get_post_field( 'post_author', $postID );
			$_post_data['nickname'] = get_the_author_meta('nickname',$_post_author_id);
			$_post_data['user_url'] = get_the_author_meta('user_url',$_post_author_id);
			$_post_data['author_posts_url'] = get_author_posts_url($_post_author_id);

			// thumbnail
			if( has_post_thumbnail($postID) === TRUE ) {
				$_post_thumbnail_id = get_post_thumbnail_id($postID);
				$_post_data['thumbnail_image_id'] = $_post_thumbnail_id;
				$_post_data['thumbnail_image_src'] = wp_get_attachment_image_src($_post_thumbnail_id, 'full');
				// $thumbnail_image_info = wp_get_attachment_metadata($_post_data['post_thumbnail_id']);
				$_post_data['thumbnail_image_title'] = get_the_title($_post_thumbnail_id);
			}
			$_category = get_the_category($postID);
			if($_category) {
				$_post_data['category_nicename'] = $_category[0]->category_nicename;
				$_post_data['cat_name'] = $_category[0]->cat_name;
				$_post_data['cat_ID'] = $_category[0]->cat_ID;
			}
			/**
			 * Add Page Options
			 */
			if( $options === TRUE ) {
				$_post_data['options'] = TM_PageOptions::get_page_options($postID, $_post_data['post_type']);
				if($_post_data['options'] === FALSE) $_post_data['options'] = array();
			}

			/**
			 * return data
			 */
			return $_post_data;
		}

		/**
		 * Returns Page head title caption accodding to the current Customizer settings.
		 *
		 * @since 1.0
		 * @access private
		 * @see        TM_TemplateServices::set_current_template_data()
		 * @uses       TM_Customizer::tm_get_theme_mod()
		 *
		 * @param      string  $templateType    The template type
		 * @param      string  $defaultMessage  The default message
		 * @param      string  $formatedString  The formated string
		 *
		 * @return     string  Page head title caption
		 */
		private static function handle_loop_template_title ($templateType = '', $defaultMessage = '', $formatedString = '', $is_search = FALSE) {
			$_baseKey = ($is_search == FALSE) ?  'tm_page_header_title_' : 'tm_search_message_';
			$_page_head_title_caption = TM_Customizer::tm_get_theme_mod($_baseKey.$templateType);
			if($_page_head_title_caption == '') {
				$_page_head_title_caption = sprintf( $defaultMessage , $formatedString );
			} else {
				$_page_head_title_caption = sprintf( $_page_head_title_caption, $formatedString);
			}
			return $_page_head_title_caption;
		}

		/**
		 * Template file utilities
		 */

		/**
		 * Wrapper of wp_kses with allowed_html prefined.
		 *
		 * @since      1.1
		 * @access     public
		 *
		 * @example    TM_TemplateServices::tm_wp_kses()
		 *
		 * @uses       wp_kses()
		 *
		 * @param      string  $text_string  The text string
		 * @return     string  Text string treated with TM_TemplateServices::tm_wp_kses().
		 */
		public static function tm_wp_kses($text_string) {
			$allowed_html = array(
				'a' => array(
					'href' => array(),
					'title' => array()
					),
				'span' => array(
					'style' => array(),
					'class' => array(),
					),
				'br' => array(),
				'em' => array(),
				'strong' => array(),
				'b' => array(),
				);
			return wp_kses($text_string,$allowed_html);
		}

		/**
		 * Removes http: and https: from link
		 *
		 * @since 1.0
		 *
		 * @param      string $linkURL The original link URL
		 *
		 * @return     string Link url with http: or https: striped.
		 */
		public static function strip_http_and_https_from_link ($linkURL) {
			$linkURL = ltrim($linkURL, 'http:');
			$linkURL = ltrim($linkURL, 'https:');
			return $linkURL;
		}


		/**
		 * Get Privacy and terms link
		 * @param  string $text_template
		 * @param  string $privacy
		 * @param  string $cookie
		 * @return string View Privacy Policy and Cookie Policy.
		 */
		public static function get_privacy_and_terms_link($text_template = 'View [privacy_policy] and [cookie_policy].',$privacy = 'Privacy Policy', $cookie = 'Cookie Policy'){
			// settings
			$_tm_privacy_policy_link = TM_Customizer::tm_get_theme_mod('tm_privacy_policy_link');
			$_tm_cookie_policy_link = TM_Customizer::tm_get_theme_mod('tm_cookie_policy_link');

			if(empty($_tm_privacy_policy_link) && empty($_tm_cookie_policy_link)) return;

			if(!empty($_tm_privacy_policy_link)) {
				$text_template = str_replace('[privacy_policy]','<a href="'.esc_url($_tm_privacy_policy_link).'">'.$privacy.'</a>',$text_template);
			} else {
				$text_template = str_replace('[privacy_policy]',$privacy,$text_template);
			}

			if(!empty($_tm_cookie_policy_link)) {
				$text_template = str_replace('[cookie_policy]','<a href="'.esc_url($_tm_cookie_policy_link).'">'.$cookie.'</a>',$text_template);
			} else {
				$text_template = str_replace('[cookie_policy]',$cookie,$text_template);
			}

			return ' '.$text_template;
		}

		/**
		 * Convert RGB to hex
		 *
		 * @since 1.0
		 * @access public
		 *
		 * @see        block-parts/page_header-slider.php
		 *
		 * @param      string  rgb/a OR hex color code
		 *
		 * @return     array   hex color code
		 */
		public static function tm_fromRGBtoHEX ($_input_value) {
			$_result = array ('#000000', 1);
			$_input_value = trim(str_replace(' ', '', $_input_value));
			if(strpos($_input_value,'rgba') === 0 ) {
				$rgba = sscanf($_input_value, "rgba(%d, %d, %d, %f)");
				$R = $rgba[0];
				$G = $rgba[1];
				$B = $rgba[2];
				$_alpha = $rgba[3];
				$R = dechex($R);
				if (strlen($R)<2)
					$R = '0'.$R;

				$G = dechex($G);
				if (strlen($G)<2)
					$G = '0'.$G;

				$B = dechex($B);
				if (strlen($B)<2)
					$B = '0'.$B;
				if($_alpha == 0) $_alpha = '0.01';
				$_result = array('#' . $R . $G . $B, $_alpha);
			} else if(strpos($_input_value,'#') === 0 ) {
				$_result = array ($_input_value, 1);
			}
			return $_result;
		}

		/**
		 * Gets the time folio pagination exclusion category.
		 *
		 * @since 26 October 2017
		 *
		 * @uses       tm-plugin/option_menu_fields.php, tm_folio_pagination_exclusion_category
		 * @see        block-parts/pagination-*.php theme templats
		 *
		 * @return     boolean|string  Returns the tm folio category id or blank string when there is none.
		 */
		public static function get_tm_folio_pagination_exclusion_category () {
			$_tm_folio_settings = get_option('tm_folio_settings');
			if(is_array($_tm_folio_settings) && array_key_exists('tm_folio_pagination_exclusion_category', $_tm_folio_settings)) {
				return $_tm_folio_settings['tm_folio_pagination_exclusion_category'];
			} else {
				return "";
			}
		}

		/**
		 * Get category name and links
		 * @return string Categories with links
		 */
		public static function get_category_name_and_links($categories_limit_number = 5){
			$_categories = get_the_category();
			$_output_html = [];
			$_categories_counter = 0;
			foreach($_categories as $_category) {
				if($categories_limit_number <= $_categories_counter) {
					break;
				}
				$_categories_counter ++;
				array_push($_output_html, '<a href="' . get_category_link( $_category->term_id ) . '" title="' . sprintf( esc_attr__( "View all posts in %s" ,"thememountain-kant" ), $_category->name ) . '" ' . '>' . $_category->name.'</a>');
			}
			return implode(', ',$_output_html);
		}

		/**
		 * End
		 */
	}
	/**
	 * End namespace
	 */
}