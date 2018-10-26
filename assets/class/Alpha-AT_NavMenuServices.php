<?php
namespace Alpha {
	/**
	 * ThemeMountain Navigation Menu Services
	 *
	 * This class is extended from TM_TemplateServices but can still work as an independent class.
	 *
	 * @package ThemeMountain
	 * @subpackage Core
	 * @since 1.0
	 */
	class AT_NavMenuServices extends AT_TemplateServices {
		/**
		 * Public Run time properties that are used directly from theme template files.
		 */
			/**
			 * Caches current tm_header_navigation_type
			 *
			 * @since 1.0
			 * @access public
			 *
			 * @see       TM_NavMenuServices::preprocess_custom_options_for_nav_menu()
			 * @see        template files.
			 *
			 * @var        string
			 */
			public static $header_navigation_type = '';

			/**
			 * Caches current tm_header_navigation_alignment
			 *
			 * @since 1.0
			 * @access public
			 *
			 * @uses       TM_NavMenuServices::preprocess_custom_options_for_nav_menu()
			 * @see        template files.
			 *
			 * @var        string
			 */
			public static $header_navigation_alignment = '';

			/**
			 * Caches current tm_header_secondary_navigation_alignment
			 *
			 * @since 1.0
			 * @access public
			 *
			 * @uses       TM_NavMenuServices::preprocess_custom_options_for_nav_menu()
			 * @see        template files.
			 *
			 * @var        string
			 */
			public static $header_secondary_navigation_alignment = '';

			/**
			 * Register for tm modal html to be output at wp_footer
			 *
			 * @var        array $modal_html
			 */
			private static $modal_html = array();

			/**
			 * Caches misc settings for off-canvas and overlay menu
			 *
			 * @since 1.0.4
			 * @access public
			 *
			 * @uses       TM_NavMenuServices::preprocess_custom_options_for_nav_menu()
			 * @see        template files.
			 *
			 * @var        string
			 */
			// alignment
			private static $tm_header_navigation_alignment = '';
			private static $tm_header_secondary_navigation_alignment = '';
			private static $tm_overlay_nav_menu_alignment = '';
			private static $tm_off_canvas_nav_menu_width = '';
			private static $tm_off_canvas_nav_menu_alignment = '';
			// menu_title_display
			private static $tm_overlay_menu_title_display = '';
			private static $tm_secondary_overlay_title_display = '';
			private static $tm_off_canvas_title_display = '';
			private static $tm_secondary_off_canvas_title_display = '';
			// position
			private static $tm_off_canvas_nav_position = '';
			// animation
			private static $tm_overlay_nav_animation = '';
			private static $tm_off_canvas_nav_animation = '';

			/**
			 * Caches current tm_header_navigation_alignment
			 *
			 * @since 1.0
			 * @access public
			 *
			 * @uses       TM_NavMenuServices::preprocess_custom_options_for_nav_menu()
			 * @see        template files.
			 *
			 * @var        string
			 */
			public static $header_navigation_logo_alignment = '';

			/**
			 * Skip loading navigation entirely if this property is set to true
			 *
			 * @uses       TM_NavMenuServices::preprocess_custom_options_for_nav_menu()
			 * @see        template files.
			 *
			 * @var        string
			 */
			public static $skip_nav_menu = FALSE;

			/**
			 * Nav menu header classes to be output.
			 *
			 * @uses       TM_NavMenuServices::preprocess_custom_options_for_nav_menu()
			 * @see        template files.
			 *
			 * @var        string
			 */
			public static $nav_menu_header_classes = '';

			/**
			 * Nav menu header classes to be output.
			 *
			 * @uses       tm_header_width Customizer setting
			 * @uses       ThemeMountain\tm_nav_style_config()
			 * @uses       nav_menu_style-default.php
			 * @see        template files.
			 *
			 * @var        string
			 */
			public static $header_width = '';

			/**
			 * Nav menu header data attributes for nav menu header
			 *
			 * @uses       TM_NavMenuServices::preprocess_custom_options_for_nav_menu()
			 * @see        template files.
			 *
			 * @var        string
			 */
			public static $nav_menu_header_data_attrs = '';

		/**
		 * Private Run time properties for Nav Config files (assets/nav_styles/*.php)
		 *
		 * Nav config specs:
		 *
		 * - Menu Locations
		 * - Menu Style and slug (1 each nav menu style config file)
		 * - Menu Settings Processor Use filter hook, 'tm_preprocess_custom_options_' followed by the nav menu style slug.
		 * - Customizer settings in queue bufferred to filter out duplicates. Customizer config is initialized at the timing of init action hook in TM_Customizer::setup_kirki().
		 */
			/**
			 * Nav menu config
			 * @uses       TM_NavMenuServices::set_nav_menu_config()
			 * @see        TM_NavMenuServices::tm_register_nav_menus()
			 * @see        assets/nav_menu/nav_menu_locations.php   Config file for menu locations
			 */
			private static $nav_menu_config = array();

			/**
			 * Nav menu locations cache
			 * @see        TM_NavMenuServices::preprocess_custom_options_for_nav_menu()	     The property is initialized.
			 * @uses       assets/nav_menu/nav_menu_locations.php    The properties is modified according to the current settings.
			 * @see        TM_NavMenuServices::get_current_menu_item_by_menu_location()
			 */
			private static $nav_menu_locations_cache = array();

			/**
			 * Nav menu style names
			 * @see       TM_NavMenuServices::add_nav_menu_style_name()
			 */
			private static $nav_nav_menu_style_names = array();

			/**
			 * Caches menu items information such as names and slugs on each one of available nav menus.
			 *
			 * @since 1.0
			 * @access private
			 *
			 * @uses        TM_NavMenuServices::set_available_nav_menu_items_list_cache()
			 * @see         TM_NavMenuServices::get_available_nav_menu_items_list()
			 *
			 * @var        array
			 */
			private static $nav_menu_items_cache = array();

		/**
		 * End Properties
		 */

		/**
		 * Class Constructor Magic Method.
		 *
		 * @since 1.0
		 * @access public
		 *
		 * @uses       preprocess_custom_options_for_nav_menu action hook
		 * @see        TM_TemplateServices::on_template_include() preprocess_custom_options_for_nav_menu action hook is executed.
		 */
		public function __construct() {
			// add hooks
			add_action( 'init', ['ThemeMountain\\TM_NavMenuServices','tm_init_nav_menus']);
			add_filter( 'nav_menu_css_class', ['ThemeMountain\\TM_NavMenuServices','add_cutsom_active_classes'], 10, 2 );
			add_filter( 'tm_preprocess_custom_options', ['ThemeMountain\\TM_NavMenuServices','preprocess_custom_options_for_nav_menu'] );
			/** Loads nav menu style config files */
			parent::locate_template_in_dir('assets/nav_menu/*.php');
			/** Site Search button */
			if(TM_ThemeServices::tm_admin_option('tm_site_search_settings','tm_use_site_search','') === 'yes'){
				add_action( 'tm_nav_buttons_after', ['ThemeMountain\\TM_NavMenuServices','output_site_search_button']);
				add_action( 'tm_output_modal_HTML', ['ThemeMountain\\TM_NavMenuServices','output_site_search_modal']);
			}
		}

		/**
		 * Public Methods for hooks
		 */

		/**
		 * Registers menu and set cache.
		 *
		 * Nav menu config files are set at the after_setup_theme action hook.
		 *
		 * @since 1.0
		 * @access public
		 *
		 * @uses       init action hook triggered after after_setup_theme. init is used instead of after_setup_theme to allow nav config to be registered before initializing the nav menus.
		 * @uses       register_nav_menus()									Sets up menu.
		 * @uses       TM_NavMenuServices::$nav_menu_config 				Holds menu configs.
		 * @uses       TM_NavMenuServices::set_available_nav_menu_items_list_cache()
		 * @see        TM_NavMenuServices::$nav_menu_items_cache		The property to be cached.
		 */
		public static function tm_init_nav_menus () {
			register_nav_menus( self::$nav_menu_config );
			self::set_available_nav_menu_items_list_cache();
		}

		/**
		 * Make sure that the .current class is added to all li that have one of these classes:
		 *
		 * current-menu-ancestor
		 * current-menu-parent
		 * current_page_parent
		 * current_page_ancestor
		 * current_page_item
		 * current-menu-item
		 *
		 * @since 1.0
		 * @access public
		 *
		 * @uses       nav_menu_css_class filter hook
		 *
		 * @param      array    $classes    The classes
		 * @param      boolean  $menu_item  The menu item
		 *
		 * @return     array    class names in array
		 */
		public static function add_cutsom_active_classes ($classes = array(), $menu_item = false) {
			/* Remove current_page_parent class from Blog menu item when using custom post types and add class for the post type menu item. */
			switch ( get_query_var('post_type') ) {
				case 'tm_folio':
					/* Remove current_page_parent from Blog menu item */
					if( $menu_item->title == 'Blog' ) {
						$classes = array_diff( $classes, array( 'current_page_parent' ) );
					}
					break;
			}

			/* add current to items with the following classes */
			$_target_classes = array('current-menu-ancestor','current-menu-parent','current_page_parent','current_page_ancestor','current_page_item','current-menu-item');
			/* loop through each */
			foreach ( $_target_classes as $_class_name ) {
				if(in_array($_class_name, $classes) && !in_array('current', $classes)) {
					array_push($classes,'current');
					break;
				}
			}

			return $classes;
		}

		/**
		 * Set up custom options for header. Namely the nav menu.
		 *
		 * Add inline CSS into the header for custom settings. Selects correct classes.
		 *
		 * @since 1.0
		 * @access public
		 *
		 * @uses       TM_TemplateServices::get_current_page_data() Returns cached Data of currently displayed page in TM_TemplateServices::$current_page_data[].
		 * @uses       TM_NavMenuServices::$nav_menu_locations_cache
		 * @uses       assets/nav_menu/nav_menu_locations.php   Config file for menu locations
		 * @uses       assets/nav_menu/nav_menu_style-?.php     Config file for menu styles
		 *
		 * @see        TM_TemplateServices::on_template_include() This method is called by the tm_preprocess_custom_options action hook.
		 */
		public static function preprocess_custom_options_for_nav_menu () {
			/** Set the $nav_menu_locations_cache here so that any changes to Customizer / Menu location can be reflected. */
			self::$nav_menu_locations_cache = get_nav_menu_locations();
			/** Set nav menu style slug */
			$_page_options = TM_TemplateServices::get_current_page_data('options');
			/** Page option or customizer option*/
			if(
				$_page_options !== FALSE &&
				isset($_page_options['tm_navigation_menu_deviate']) &&
				$_page_options['tm_navigation_menu_deviate'] !== ''
			) {
				/** Take settings from Page Options settings */
				// Menu Style
				self::$header_navigation_type = $_page_options['tm_header_navigation_type'];
				// set nav style location. declared in a config file, assets/nav_menu/nav_menu_locations.php
				do_action('tm_nav_style_location_setup_page_option');
				do_action('tm_nav_behavior_settings_page_option');
				/** menu alignment tm_header_navigation_alignment */
				self::$header_navigation_alignment = $_page_options['tm_header_navigation_alignment'];
				// Secondary tm_header_secondary_navigation_alignment
				self::$header_secondary_navigation_alignment = $_page_options['tm_header_secondary_navigation_alignment'];
				// tm_overlay_nav_menu_alignment
				self::$tm_overlay_nav_menu_alignment = $_page_options['tm_overlay_nav_menu_alignment'];
				// tm_overlay_menu_title_display
				self::$tm_overlay_menu_title_display = $_page_options['tm_overlay_menu_title_display'];
				// tm_secondary_overlay_title_display
				self::$tm_secondary_overlay_title_display = $_page_options['tm_secondary_overlay_title_display'];
				// Off-Canvas Navigation Width
				self::$tm_off_canvas_nav_menu_width = $_page_options['tm_off_canvas_nav_menu_width'];
				// tm_off_canvas_nav_menu_alignment
				self::$tm_off_canvas_nav_menu_alignment = $_page_options['tm_off_canvas_nav_menu_alignment'];
				// tm_off_canvas_title_display
				self::$tm_off_canvas_title_display = $_page_options['tm_off_canvas_title_display'];
				// tm_secondary_off_canvas_title_display
				self::$tm_secondary_off_canvas_title_display = $_page_options['tm_secondary_off_canvas_title_display'];
				/** position */
				// tm_off_canvas_nav_position
				self::$tm_off_canvas_nav_position = $_page_options['tm_off_canvas_nav_position'];
				/** animation */
				// tm_overlay_nav_animation
				self::$tm_overlay_nav_animation = $_page_options['tm_overlay_nav_animation'];
				// tm_off_canvas_nav_animation
				self::$tm_off_canvas_nav_animation = $_page_options['tm_off_canvas_nav_animation'];
			} else {
				/** Take settings from customizer */
				// Menu Style inherited from global settings
				self::$header_navigation_type = TM_Customizer::tm_get_theme_mod('tm_header_navigation_type');
				// Navigation Menu alignment tm_header_navigation_alignment
				self::$header_navigation_alignment = TM_Customizer::tm_get_theme_mod('tm_header_navigation_alignment');
				// Secondary tm_header_secondary_navigation_alignment
				self::$header_secondary_navigation_alignment = TM_Customizer::tm_get_theme_mod('tm_header_secondary_navigation_alignment');
				// tm_overlay_nav_menu_alignment
				self::$tm_overlay_nav_menu_alignment = TM_Customizer::tm_get_theme_mod('tm_overlay_nav_menu_alignment');
				// tm_overlay_menu_title_display
				self::$tm_overlay_menu_title_display = TM_Customizer::tm_get_theme_mod('tm_overlay_menu_title_display');
				// tm_secondary_overlay_title_display
				self::$tm_secondary_overlay_title_display = TM_Customizer::tm_get_theme_mod('tm_secondary_overlay_title_display');
				// Off-Canvas Navigation Width
				self::$tm_off_canvas_nav_menu_width = TM_Customizer::tm_get_theme_mod('tm_off_canvas_nav_menu_width');
				// tm_off_canvas_nav_menu_alignment
				self::$tm_off_canvas_nav_menu_alignment = TM_Customizer::tm_get_theme_mod('tm_off_canvas_nav_menu_alignment');
				// tm_off_canvas_title_display
				self::$tm_off_canvas_title_display = TM_Customizer::tm_get_theme_mod('tm_off_canvas_title_display');
				// tm_secondary_off_canvas_title_display
				self::$tm_secondary_off_canvas_title_display = TM_Customizer::tm_get_theme_mod('tm_secondary_off_canvas_title_display');
				/** position */
				// tm_off_canvas_nav_position
				self::$tm_off_canvas_nav_position = TM_Customizer::tm_get_theme_mod('tm_off_canvas_nav_position');
				/** animation */
				// tm_overlay_nav_animation
				self::$tm_overlay_nav_animation = TM_Customizer::tm_get_theme_mod('tm_overlay_nav_animation');
				// tm_off_canvas_nav_animation
				self::$tm_off_canvas_nav_animation = TM_Customizer::tm_get_theme_mod('tm_off_canvas_nav_animation');
			}
			// do action hook for nav style (common)
			do_action('tm_nav_style_config');
			// style dependent
			do_action('tm_nav_style_config_'.self::$header_navigation_type);

			/**
			 * Off-Canvas Navigation Width (tm_off_canvas_nav_menu_width). #175
			 */
			if(self::$tm_off_canvas_nav_menu_width === '50%'){
				TM_StyleAndScripts::tm_add_inline_css_head("@media only screen and (min-width:768px){.side-navigation-wrapper.side-nav-wide{width:50%}.element-reveal-left.side-nav-wide{-webkit-transform:translate3d(50%,0,0);transform:translate3d(50%,0,0)}.element-reveal-right.side-nav-wide{-webkit-transform:translate3d(-50%,0,0);transform:translate3d(-50%,0,0)}}@media only screen and (max-width:1140px){.side-navigation-wrapper.side-nav-wide{width:70%}.element-reveal-right.side-nav-wide{-webkit-transform:translate3d(70%,0,0);transform:translate3d(70%,0,0)}.element-reveal-right.side-nav-wide{-webkit-transform:translate3d(-70%,0,0);transform:translate3d(-70%,0,0)}}@media only screen and (max-width:600px){.side-navigation-wrapper.side-nav-wide{width:100%}.element-reveal-left.side-nav-wide{-webkit-transform:translate3d(100%,0,0);transform:translate3d(100%,0,0)}.element-reveal-right.side-nav-wide{-webkit-transform:translate3d(-100%,0,0);transform:translate3d(-100%,0,0)}}");
			}
		}

		/**
		 * Public Methods for nav config files
		 */

		/**
		 * Update nav manu locations menu item.
		 *
		 * This needs to be used in the nav menu style config which is called in an action hook tm_nav_style_location_setup_page_option triggered in  TM_NavMenuServices::preprocess_custom_options_for_nav_menu().
		 *
		 * @since 1.0
		 * @access public
		 *
		 * @uses       TM_NavMenuServices::$nav_menu_locations_cache
		 *
		 * @param      string   $menu_location
		 * @param      integer  $setting_value
		 */
		public static function update_nav_menu_locations_menu_item($menu_location, $setting_value){
			self::$nav_menu_locations_cache[$menu_location] = $setting_value;
		}

		/**
		 * Adds navigation menu locations.
		 *
		 * @uses       TM_NavMenuServices::$nav_menu_config
		 *
		 * @param      array  $args   The arguments containing menu locations
		 */
		public static function set_nav_menu_config ($args = array()) {
			self::$nav_menu_config = $args;
		}

		/**
		 * Adds a nav menu style name.
		 *
		 * @uses       TM_NavMenuServices::$nav_nav_menu_style_names
		 * @param      array  $slug   Slug id
		 * @param      array  $name   Name
		 */
		public static function add_nav_menu_style_name ($slug, $name) {
			self::$nav_nav_menu_style_names[$slug] = $name;
		}

		/**
		 * Public Methods for accessing from front end files only
		 */

		/**
		 * Prints classes for Overlay Navigation Animation
		 *
		 * @since 1.0
		 * @access public
		 *
		 * @see        block-parts/overlay_nagivation.php
		 *
		 * @uses       fields_overlay_appearance.php
		 * @uses       TM_Customizer::tm_get_theme_mod()
		 */
		public static function tm_overlay_nav_animation_class () {
			/* Customizer tm_overlay_nav_animation */
			switch (self::$tm_overlay_nav_animation) {
				case 'top':
					echo ' enter-top';
					break;
				case 'bottom':
					echo ' enter-bottom';
					break;
				case 'left':
					echo ' enter-left';
					break;
				case 'right':
					echo ' enter-right';
					break;
				default: // scale-in
					break;
			}
		}

		/**
		 * Prints classes for Overlay Navigation Menu Alignment
		 *
		 * @since 1.0.4
		 * @access public
		 *
		 * @see        block-parts/overlay_nagivation.php
		 *
		 * @uses       fields_overlay_appearance.php
		 * @uses       TM_Customizer::tm_get_theme_mod()
		 *
		 * @param boolean $suppress_pull suppress pull- from the class output
		 */
		public static function tm_overlay_nav_menu_alignment_class ($suppress_pull = FALSE) {
			/* Customizer tm_overlay_nav_menu_alignment */
			switch (self::$tm_overlay_nav_menu_alignment) {
				case 'center':
					echo' center';
					break;
				case 'left':
					if($suppress_pull===FALSE){
						echo' pull-left';
					} else {
						echo' left';
					}
					break;
				case 'right':
					if($suppress_pull===FALSE){
						echo' pull-right';
					} else {
						echo' right';
					}
					break;
				default: // scale-in
					break;
			}
		}

		/**
		 * Prints classes for Overlay Menu Display title
		 *
		 * @since 1.0.4
		 * @access public
		 *
		 * @see        block-parts/overlay_nagivation.php
		 *
		 * @uses       fields_overlay_appearance.php
		 * @uses       TM_Customizer::tm_get_theme_mod()
		 */
		public static function tm_overlay_menu_title_display_class () {
			/* Customizer tm_overlay_menu_title_display */
			switch (self::$tm_overlay_menu_title_display) {
				case 'hide':
					echo ' hide';
					break;
				case 'show':
				default: // scale-in
					break;
			}
		}

		/**
		 * Prints classes for Off Canvas Secondary Menu Display title
		 *
		 * @since 1.0.4
		 * @access public
		 *
		 * @see        block-parts/offcanvas_nagivation.php
		 *
		 * @uses       tm_off_canvas_nav_settings section
		 * @uses       TM_Customizer::tm_get_theme_mod()
		 */
		public static function tm_secondary_overlay_title_display_class () {
			/* Customizer tm_overlay_menu_title_display */
			switch (self::$tm_secondary_overlay_title_display) {
				case 'hide':
					echo ' hide';
					break;
				case 'show':
				default: // scale-in
					break;
			}
		}

		/**
		 * Prints classes for Off-canvas Navigation Menu Alignment
		 *
		 * @since 1.0.4
		 * @access public
		 *
		 * @see        block-parts/offcanvas_nagivation.php
		 *
		 * @uses       fields_overlay_appearance.php
		 * @uses       TM_Customizer::tm_get_theme_mod()
		 */
		public static function tm_off_canvas_nav_menu_alignment_class () {
			/* Customizer tm_overlay_nav_menu_alignment */
			switch (self::$tm_off_canvas_nav_menu_alignment) {
				case 'center':
					echo' center';
					break;
				case 'left':
					echo' left';
					break;
				case 'right':
					echo' right';
					break;
				default: // scale-in
					break;
			}
		}

		/**
		 * Prints classes for Off Canvas Menu Display title
		 *
		 * @since 1.0.4
		 * @access public
		 *
		 * @see        block-parts/offcanvas_nagivation.php
		 *
		 * @uses       tm_off_canvas_nav_settings section
		 * @uses       TM_Customizer::tm_get_theme_mod()
		 */
		public static function tm_off_canvas_title_display_class () {
			/* Customizer tm_overlay_menu_title_display */
			switch (self::$tm_off_canvas_title_display) {
				case 'hide':
					echo ' hide';
					break;
				case 'show':
				default: // scale-in
					break;
			}
		}

		/**
		 * Prints classes for Off Canvas Secondary Menu Display title
		 *
		 * @since 1.0.4
		 * @access public
		 *
		 * @see        block-parts/offcanvas_nagivation.php
		 *
		 * @uses       tm_off_canvas_nav_settings section
		 * @uses       TM_Customizer::tm_get_theme_mod()
		 */
		public static function tm_secondary_off_canvas_title_display_class () {
			/* Customizer tm_overlay_menu_title_display */
			switch (self::$tm_secondary_off_canvas_title_display) {
				case 'hide':
					echo ' hide';
					break;
				case 'show':
				default: // scale-in
					break;
			}
		}

		/**
		 * Prints data attributes for Overlay Navigation Animation
		 *
		 * @since 1.0
		 * @access public
		 *
		 * @see        block-parts/overlay_nagivation.php
		 *
		 * @uses       fields_overlay_appearance.php
		 *
		 * @param      string $navMenu		Type Menu style slug
		 */
		public static function tm_overlay_nav_animation_data_attrs () {
			if(self::$tm_overlay_nav_animation === 'scale-in') {
				echo " data-animation='scale-in'";
			} else {
				echo " data-animation='slide-in'";
			}
		}

		/**
		 * Prints classes for Off-Canvas Navigation Animation
		 *
		 * @since 1.0
		 * @access public
		 *
		 * @see        block-parts/overlay_nagivation.php
		 *
		 * @uses       fields_overlay_appearance.php
		 * @uses       TM_Customizer::tm_get_theme_mod()
		 *
		 * @param      string $navMenu		Type Menu style slug
		 * @param      string $class 		Additional class
		 */
		public static function tm_off_canvas_nav_position_class () {
			echo ' '.esc_attr(self::$tm_off_canvas_nav_position);
		}

		/**
		 * Prints classes for Off-Canvas Navigation Animation
		 *
		 * @since 1.0
		 * @access public
		 *
		 * @see        block-parts/overlay_nagivation.php
		 *
		 * @uses       fields_overlay_appearance.php
		 * @uses       TM_Customizer::tm_get_theme_mod()
		 *
		 * @param      string $navMenu		Type Menu style slug
		 * @param      string $class 		Additional class
		 */
		public static function tm_off_canvas_nav_side_nav_wide_class () {
			if(self::$tm_off_canvas_nav_menu_width === '50%'){
				echo ' side-nav-wide';
			}
		}

		/**
		 * Prints data attributes for Off-Canvas Navigation Animation
		 *
		 * @since 1.0
		 * @access public
		 *
		 * @see        block-parts/overlay_nagivation.php
		 *
		 * @uses       fields_overlay_appearance.php
		 *
		 * @param      string $navMenu		Type Menu style slug
		 */
		public static function tm_off_canvas_nav_animation_data_attrs () {
			echo " data-animation='".esc_attr(self::$tm_off_canvas_nav_animation)."'";
		}

		/**
		 * Returns nav menu title by location slug.
		 *
		 * @since 1.0
		 * @access public
		 *
		 * @uses       TM_NavMenuServices::get_nav_menu_title()
		 *
		 * @param      string $location Location slug
		 *
		 * @return     string Nav menu title
		 */
		public static function tm_nav_menu_title ($location = '') {
			/** get menu id from location slug */
			$_menu_id = self::get_current_menu_item_by_menu_location($location);
			/** return the menu title */
			return self::get_nav_menu_title($_menu_id);
		}

		/**
		 * Prints nav menu markup.
		 *
		 * @since 1.0
		 * @access public
		 *
		 * @uses       TM_NavMenuServices::get_current_menu_item_by_menu_location()
		 * @uses       TM_NavMenuServices::print_nav_menu()
		 *
		 * @param      string $location Location slug
		 */
		public static function tm_nav_menu ($location='',$classes='') {
			/** get menu id from location slug */
			$_menu_id = self::get_current_menu_item_by_menu_location($location);
			self::print_nav_menu($_menu_id,$location,$classes);
		}

		/**
		 * Prints nav menu markup. Used for outputing custom HTML for buttons and other button like widgets in the nav bar.
		 * For user custom widgets, use button_ as prefix for the id. And the action hook name needs to have "tm_nav_" followed by the id.
		 *
		 * @since 1.0.2
		 * @access public
		 *
		 * @uses       TM_NavMenuServices::get_current_menu_item_by_menu_location()
		 * @uses       TM_NavMenuServices::print_nav_menu()
		 * @see        TM_WalkerNavMenu::start_el()	Skips items for buttons.
		 *
		 * @param      string $location Location slug
		 */
		public static function tm_nav_buttons () {
			/**
			 * Action hook prepared for the TM_CartNavMenu
			 */
			do_action( 'tm_nav_buttons_before' );

			/**
			 * Output Buttons registered in the Navigation menu.
			 */
			/** get menu id from location slug */
			$_menu_id = self::get_current_menu_item_by_menu_location('main_nav_menu');
			// get nav menu items registered in the location.
			$_wp_get_nav_menu_items = wp_get_nav_menu_items($_menu_id);
			/** Scan through only if there are any to be processed. */
			if(is_array($_wp_get_nav_menu_items)) {
				/** scan for buttons */
				foreach ($_wp_get_nav_menu_items as $_item) {
					$_tm_custom_nav = get_post_meta($_item->ID, 'menu-item-tm_custom_nav', true);
					if($_tm_custom_nav === 'button') {
						$_url = esc_attr( $_item->url );
						$_scroll_link_class = '';
						if (substr($_url,  0, strlen('#')) === '#') {
							$_scroll_link_class = 'scroll-link ';
						}
						$classes = empty( $_item->classes ) ? array() : (array) $_item->classes;
						$_class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $_item ) ) );
						echo "<li><div class='v-align-middle'><a href='{$_url}' class='button {$_scroll_link_class}{$_class_names}'>".apply_filters( 'the_title', $_item->title, $_item->ID )."</a></div></li>";
					} else if($_tm_custom_nav === 'icon') {
						$_url = esc_attr( $_item->url );
						$_scroll_link_class = '';
						if (substr($_url,  0, strlen('#')) === '#') {
							$_scroll_link_class = 'scroll-link ';
						}
						$classes = empty( $_item->classes ) ? array() : (array) $_item->classes;
						$_class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $_item ) ) );
						echo "<li><div class='v-align-middle'><a href='{$_url}' class='nav-icon {$_scroll_link_class}{$_class_names}'><span class='icon-label'>".apply_filters( 'the_title', $_item->title, $_item->ID )."</span></a></div></li>";
					} else if ($_tm_custom_nav === 'modal_button') {
						$_data_aux_classes = get_post_meta($_item->ID, 'menu-item-tm_custom_nav_modal_aux_classes', true);

						// $_data_aux_classes def value treatment
						$_data_aux_classes = (empty($_data_aux_classes)) ? 'tml-form-modal height-auto' : 'tml-form-modal height-auto '.$_data_aux_classes;
						// class names
						$classes = empty( $_item->classes ) ? array() : (array) $_item->classes;
						$_class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $_item ) ) );
						// output the button markup and enqueue the modal html output
						echo "<li><div class='v-align-middle'>".self::registerModalButton($_item->object_id,apply_filters( 'the_title', $_item->title, $_item->ID ),$_class_names,$_data_aux_classes)."</div></li>";
					} else if (preg_match("/^button/",$_tm_custom_nav)) {
						// do action
						do_action( 'tm_nav_'.$_tm_custom_nav, $_item );
					}
				}
			}

			/**
			 * @see        TM_NavMenuServices::output_site_search_button()
			 */
			do_action( 'tm_nav_buttons_after' );
		}

		/**
		 * Used for the Site Search
		 */

		/**
		 * Output Site Search button
		 *
		 * @uses       tm_nav_buttons_after hook in TM_NavMenuServices::tm_nav_buttons()
		 */
		public static function output_site_search_button(){
			echo '<!-- Search Icon --><li><div class="v-align-middle"><a href="#search-modal" data-content="inline" data-toolbar="" data-aux-classes="tml-search-modal" data-modal-mode data-modal-width="1000" data-lightbox-animation="fade" data-nav-exit="false" class="nav-icon lightbox-link icon-magnifying-glass"><span class="icon-label">Facebook Link</span></a></div></li><!-- Search Icon End -->';
		}

		/**
		 * Output Site Search modal
		 *
		 * @uses       tm_output_modal_HTML hook in TM_NavMenuServices::tm_output_modal_HTML()
		 */
		public static function output_site_search_modal(){
			$_tm_site_search_placeholder_text = TM_ThemeServices::tm_admin_option('tm_site_search_settings','tm_site_search_placeholder_text','Type & Hit Enter...');
			$_tm_site_search_modal_close_text = TM_ThemeServices::tm_admin_option('tm_site_search_settings','tm_site_search_modal_close_text','Close');
			echo '<!-- Search Modal End --><div id="search-modal" class="hide"><div class="row"><div class="column width-12 center"><div class="search-form-container site-search"><form role="search" method="get" id="searchform_content" name="searchform" class="searchform" action="'.esc_url( home_url( '/' ) ).'" novalidate><div class="row"><div class="column width-12"><div class="field-wrapper"><input type="text" name="s" class="form-search form-element" placeholder="'.esc_html($_tm_site_search_placeholder_text).'"><span class="border"></span></div></div></div></form><div class="form-response"></div></div><a href="#" class="tml-aux-exit">'.esc_html($_tm_site_search_modal_close_text).'</a></div></div></div><!-- Search Modal End -->';
		}

		/**
		 * Public Methods for accessing from broad external files including admin.
		 */

		/**
		 * Returns slug and names for available Nav Menu styles and the slug currently selected.
		 *
		 * @since 1.0
		 * @access public
		 *
		 * @uses       TM_NavMenuServices::$nav_nav_menu_style_names
		 * @see        assets/customizer/fields/fields_tm_page_header_nav_appearance.php
		 * @see        assets/page-options/_page_option_variables.php
		 *
		 * @param      string   $type    Data type to be returned. list, default, current
		 *
		 * @return     array List of available menu sets in array.
		 */
		public static function get_available_nav_menu_styles ($type = '') {
			return self::$nav_nav_menu_style_names;
		}

		/**
		 * Returns the default navigation menu style.
		 *
		 * @since 1.0
		 * @access public
		 *
		 * @see        assets/customizer/fields/fields_tm_page_header_nav_appearance.php
		 * @see        assets/page-options/_page_option_variables.php
		 */
		public static function get_default_nav_menu_style(){
			return 'default';
		}

		/**
		 * Returns information for available nav menu items and the slug currently selected.
		 *
		 * @since 1.0
		 * @access public
		 *
		 * @uses       TM_NavMenuServices::$nav_menu_items_cache		The property holding menu items.
		 * @uses       TM_NavMenuServices::__constructor()				Set menu items in chache.
		 * @see        assets/page-options/_page_option_variables.php		Where this method is used.
		 *
		 * @param      boolean   $addNone    Add None to the menu to be returned if set to TRUE.
		 *
		 * @return     array List of available menu sets in array
		 */
		public static function get_available_nav_menu_items_list ($addNone = FALSE) {
			// set cahche if empty
			if(empty(self::$nav_menu_items_cache)) {
				self::set_available_nav_menu_items_list_cache();
			}
			$_menu_items_list = self::$nav_menu_items_cache;
			// add none if requested
			if($addNone === TRUE) $_menu_items_list[0] = TM_ThemeStrings::$text_strings['TM_NavMenuServices']['none'];
			// Return requested data
			return $_menu_items_list;
		}

		/**
		 * Gets the current menu item id (intger) by menu location slug (string).
		 *
		 * @since 1.0
		 * @access private
		 *
		 * @uses       get_nav_menu_locations()
		 * @uses       TM_NavMenuServices::$nav_menu_locations_cache
		 *
		 * @param      string $menu_slug Menu location slug
		 *
		 * @return     integer|string Currently selected menu item id. Return 0 if not found.
		 */
		public static function get_current_menu_item_by_menu_location ($menu_slug = '') {
			/**
			 * Update the nav menu location cache if necessary.
			 * TM_NavMenuServices::$nav_menu_locations_cache is set again in
			 * TM_NavMenuServices::preprocess_custom_options_for_nav_menu()
			 */
			if(empty(self::$nav_menu_locations_cache)){
				self::$nav_menu_locations_cache = get_nav_menu_locations();
			}
			/** array of menu location slugs and its values as a currently selected menu item by ID */
			if(array_key_exists($menu_slug, self::$nav_menu_locations_cache)) {
				return self::$nav_menu_locations_cache[$menu_slug];
			} else {
				return 0;
			}
		}

		/**
		 * Sets the available navigation menu items list cache.
		 *
		 * @since 1.0
		 * @access private
		 *
		 * @uses       wp_get_nav_menus()
		 * @uses       TM_NavMenuServices::$nav_menu_items_cache	Class property holding cache of menu items in array formatted as: Array key (menu location in slug) => value (name in string)
		 * @uses       TM_NavMenuServices::tm_init_nav_menus()		The cache is set at the timing of init action hook.
		 */
		public static function set_available_nav_menu_items_list_cache() {
			/** stdClass object holding details on menu items registered on the Wordpress server */
			$_nav_menus = wp_get_nav_menus();
			/** Inutialize once */
			self::$nav_menu_items_cache = array();
			/** loop through each menu items */
			foreach ( $_nav_menus as $_menu ) {
				self::$nav_menu_items_cache[$_menu->term_id] = wp_html_excerpt( $_menu->name, 40, '&hellip;' );
			}
			if(empty(self::$nav_menu_items_cache)){
				self::$nav_menu_items_cache[0] = TM_ThemeStrings::$text_strings['TM_NavMenuServices']['please_create_a_new_menu'];
			}
			return self::$nav_menu_items_cache;
		}

		/**
		 * Modal support
		 *
		 * @since      1.0.2
		 */

		/**
		 * Enqueue html to be output in the footer
		 *
		 * @since      1.0.2
		 *
		 * @see        TM_WalkerNavMenu::registerModalButton()
		 *
		 * @param      string 		$modalID
		 * @param      integer  	$pageID
		 */
		public static function enqueue_modal_content_in_footer ($modalID,$pageID) {
			self::$modal_html[$modalID] = $pageID;
		}

		/**
		 * Output Footer HTML
		 *
		 * @since      1.0.2
		 *
		 * @uses       TM_StyleAndScripts::tm_add_inline_css_foot()
		 * @see        TM_NavMenuCustomField::__construct()
		 * @see        footer.php
		 */
		public static function output_modal_HTML () {
			/**
			 * This is necessary to ensure that any css enqueue requests goes in to the deferred inline style in the footer.
			 */
			if(class_exists('\\ThemeMountain\\TM_Shortcodes') && isset(TM_Shortcodes::$enquque_deferred_style_in_footer)) {
				TM_Shortcodes::$enquque_deferred_style_in_footer = TRUE;
			}
			// loop through
			foreach (self::$modal_html as $_modalID => $_pageID) {
				/* modal content */
				$_modal_content = apply_filters( 'the_content', get_post_field('post_content', $_pageID) );
				/* get tm_modal page options */
				$_modal_settinigs = TM_PageOptions::get_page_options($_pageID,'tm_modal');
				/** Blank vars  */
				$_modal_header = '';
				/** modal header */
				if (isset($_modal_settinigs['tm_modal_header']) && !empty($_modal_settinigs['tm_modal_header'])) {
					$_modal_header_title = (isset($_modal_settinigs['tm_modal_header_title']) && !empty($_modal_settinigs['tm_modal_header_title'])) ? TM_TemplateServices::tm_wp_kses($_modal_settinigs['tm_modal_header_title']) : get_the_title($_pageID);
					$_modal_header = "<div class='modal-header'><h4 class='modal-header-title'>{$_modal_header_title}</h4></div>";
					/** color CSS */
					$_tm_modal_header_background_color = (isset($_modal_settinigs['tm_modal_header_background_color'])) ? $_modal_settinigs['tm_modal_header_background_color'] : '#999';
					$_tm_modal_header_title_color = (isset($_modal_settinigs['tm_modal_header_title_color'])) ? $_modal_settinigs['tm_modal_header_title_color'] : '';
					// enqueue deferred style in the footer
					TM_StyleAndScripts::tm_add_inline_css_foot("#{$_modalID} .modal-header { background-color: {$_tm_modal_header_background_color};}");
						if($_tm_modal_header_title_color !== '') TM_StyleAndScripts::tm_add_inline_css_foot("#{$_modalID} .modal-header-title { color: {$_tm_modal_header_title_color};}");
				}
				/** Modal Close Button Color */
				if (isset($_modal_settinigs['tm_modal_close_button_color']) && !empty($_modal_settinigs['tm_modal_close_button_color'])) {
					$_tm_modal_close_button_color = (isset($_modal_settinigs['tm_modal_close_button_color'])) ? $_modal_settinigs['tm_modal_close_button_color'] : '#111';
					// enqueue deferred style in the footer
					TM_StyleAndScripts::tm_add_inline_css_foot("#{$_modalID} + #tml-exit { color: {$_tm_modal_close_button_color};}");
				}
				if(!empty($_modal_content)) echo "<div id='{$_modalID}' class='modal-dialog-inner' style='display:none;'>".str_replace( ']]>', ']]&gt;', $_modal_header.$_modal_content )."</div>";
			}
			// hook
			do_action('tm_output_modal_HTML');

			// Reset the value
			if(class_exists('\\ThemeMountain\\TM_Shortcodes')) {
				TM_Shortcodes::$enquque_deferred_style_in_footer = FALSE;
			}
		}

		/**
		 * Private method for TM_NavMenuServices::get_available_nav_menu_items_list()
		 */

		/**
		 * Returns nav menu title by slug
		 *
		 * @since 1.0
		 * @access private
		 *
		 * @see        https://codex.wordpress.org/Function_Reference/wp_get_nav_menu_object
		 *
		 * @param      Integer 	$menu_id		Menu id.
		 *
		 * @return     string	The nav menu title
		 */
		private static function get_nav_menu_title ($menu_id) {
			/**
			 * Get menu object
			 */
			if(empty($menu_id) || !isset(self::$nav_menu_items_cache[$menu_id])) {
				return '';
			} else {
				return self::$nav_menu_items_cache[$menu_id];
			}
		}

		/**
		 * Custom menu output for ThemeMountain Wordpress themes.
		 *
		 * @since 1.0
		 * @access private
		 *
		 * @uses       Wordpress core wp_nav_menu()
		 *
		 * @param      string $menu_id			Menu id attribute to be inseted in the HTML markup
		 * @param      string $location			Menu location attribute. This is required for the megasub menu to work properly.
		 * @param      string $classes			Menu class attribute to be inseted in the HTML markup
		 * @param      string $before			HTML mark up to be inserted before
		 * @param      string $after			HTML mark up to be inserted after
		 *
		 * @return     string Nav Menu markup
		 */
		private static function print_nav_menu ($menu_id = '', $location = '', $classes = '', $before = '', $after = '') {
			if(empty($menu_id)) {
				return;
			}
			$_items_wrap = (isset($classes)) ? '<ul class="'. $classes .'">%3$s</ul>' : '<ul>%3$s</ul>';
			wp_nav_menu( array(
				'menu' => $menu_id,
				'sort_column' => 'menu_order',
				'before' => $before,
				'after' => $after,
				'link_before' => '',
				'link_after' => '',
				'menu_id' => $menu_id,
				'container' => false ,
				'items_wrap' => $_items_wrap,
				'theme_location' => $location,
				'walker' => new TM_WalkerNavMenu // the walker customization class is included as a module class
				) );
		}

		/**
		 * Registers modal, get modal settings and return modal button html markup
		 *
		 * @since      1.0.2
		 * @access     private
		 *
		 * @param      integer 	$pageID			Page id of which contains the modal content.
		 * @param      string  	$buttonLabel	Button label title
		 * @param      string	$class_attr		class attributes
		 * @param      string	$data_aux_classes		data aux attributes
		 */
		private static function registerModalButton($pageID,$buttonLabel,$class_attr,$data_aux_classes) {
			/* modal content used only to detect certain content. do not use filter otherwise css serial number goes wrong. */
			$_modal_content = get_post_field('post_content', $pageID);
			/* get tm_modal page options */
			$_modal_settinigs = TM_PageOptions::get_page_options($pageID,'tm_modal');

			/** Add space if not empty */
			if(!empty($class_attr)) $class_attr = ' '.$class_attr;

			/** individual settings */
			$_tm_modal_width = (isset($_modal_settinigs['tm_modal_width'])) ? $_modal_settinigs['tm_modal_width'] : '500';
			$_tm_modal_content_animation = (isset($_modal_settinigs['tm_modal_content_animation'])) ? $_modal_settinigs['tm_modal_content_animation'] : 'fade';
			$_tm_modal_lightbox_overlay_animation = (isset($_modal_settinigs['tm_modal_lightbox_overlay_animation'])) ? $_modal_settinigs['tm_modal_lightbox_overlay_animation'] : 'fade';
			/** auto modal launch */
			$_tm_modal_auto_launch = (isset($_modal_settinigs['tm_modal_auto_launch']) && $_modal_settinigs['tm_modal_auto_launch'] === 'on') ? ' data-auto-launch' : '';
			$_tm_modal_auto_launch_delay = (isset($_modal_settinigs['tm_modal_auto_launch_delay']) && !empty($_tm_modal_auto_launch)) ?  " data-launch-delay='{$_modal_settinigs['tm_modal_auto_launch_delay']}'" : '';
			$_tm_modal_auto_launch_cookie = (isset($_modal_settinigs['tm_modal_auto_launch_cookie']) && $_modal_settinigs['tm_modal_auto_launch_cookie'] === 'on' && !empty($_tm_modal_auto_launch)) ?  " data-set-cookie='cookie-modal-{$pageID}'" : " data-delete-cookie='cookie-modal-{$pageID}'";
			/** custom classes from the option settings */
			$data_aux_classes = (isset($_modal_settinigs['tm_modal_custom_classes']) && !empty($_modal_settinigs['tm_modal_custom_classes'])) ? $data_aux_classes.' '.esc_attr($_modal_settinigs['tm_modal_custom_classes']) : $data_aux_classes;
			/** modal header */
			if (isset($_modal_settinigs['tm_modal_header']) && !empty($_modal_settinigs['tm_modal_header'])) {
				$data_aux_classes = (empty($data_aux_classes)) ? 'with-header' : $data_aux_classes.' with-header';
			}
			/** tm_modal_border_style */
			if (isset($_modal_settinigs['tm_modal_border_style']) && !empty($_modal_settinigs['tm_modal_border_style'])) {
				$data_aux_classes = (empty($data_aux_classes)) ? 'rounded' : $data_aux_classes.' rounded';
			}
			/* tm_modal_auto_close and detect contact form 7 shortcode */
			if(isset($_modal_settinigs['tm_modal_auto_close']) && !empty($_modal_settinigs['tm_modal_auto_close']) && strpos($_modal_content,'[contact-form-7 ') !== FALSE) {
				$data_aux_classes = (empty($data_aux_classes)) ? 'destroy-on-success' : $data_aux_classes.' destroy-on-success';
			}
			/** enqueue modal contents wrapped in id */
			self::enqueue_modal_content_in_footer('wordpress-modal-'.$pageID,$pageID);
			/** return the markup with settings value reflected */
			return "<a data-content='inline' data-aux-classes='{$data_aux_classes}' data-toolbar data-modal-mode data-modal-width='{$_tm_modal_width}' data-modal-animation='{$_tm_modal_content_animation}' data-lightbox-animation='{$_tm_modal_lightbox_overlay_animation}' href='#wordpress-modal-{$pageID}' class='lightbox-link no-page-fade button{$class_attr}'{$_tm_modal_auto_launch}{$_tm_modal_auto_launch_delay}{$_tm_modal_auto_launch_cookie}>{$buttonLabel}</a>";
		}
		/**
		 * End
		 */
	}
}