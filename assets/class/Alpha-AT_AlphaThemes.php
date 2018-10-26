<?php
/**
 * ThemeMountain namespace reserved for ThemeMountain Wordpress themes
 * If you do not know what namespace is, please read http://php.net/manual/en/language.namespaces.php
 */
namespace Alpha {
	/**
	 * ThemeMountain parent core class providing common utility methods
	 *
	 * @package ThemeMountain
	 * @subpackage Core
	 * @since 1.0
	 */
	class AT_AlphaThemes {
		/**
		 * Properties
		 */
		/**
		 * Theme Text Domain ID.
		 * @see 	TM_Vc::vc_admin_enqueue()	Used to determine directory of TM Layout Library thumbnail.
		 * @see		TM_ThemeMountain::get_theme_id()
		 * @var		string
		 */
		protected static $theme_id;

		/**
		 * FALSE set if this theme is not compatible with the ThemeMountain Plugin.
		 * Otherwise minimum requied version of TM Plugin
		 *
		 * @see 	ThemeMountain Plugin
		 * @see		TM_ThemeMountain::get_required_tmplugin_version()
		 * @var boolean | string
		 */
		protected static $required_tmplugin_version;

		/**
		 * FALSE set if this theme is not compatible with the ThemeMountain Commerce Plugin.
		 * Otherwise minimum requied version of TM Commerce Plugin
		 *
		 * @see 	ThemeMountain Commerce Plugin
		 * @see		TM_ThemeMountain::get_required_tmcommerce_version()
		 * @var boolean | string
		 */
		protected static $required_tmcommerce_version;

		/**
		 * FALSE set if this theme is not compatible with the ThemeMountain OneClick.
		 * Otherwise minimum requied version of TM OneClick
		 *
		 * @see 	ThemeMountain OneClick plugin
		 * @see		TM_ThemeMountain::get_required_oneclick_version()
		 * @var boolean | string
		 */
		protected static $required_oneclick_version;

		/**
		 * Class Constructor Magic Method.
		 *
		 * Cache theme version, execute class setup method and add filter for option fields in the admin panel.
		 *
		 * @since 1.0
		 * @access public
		 * @uses Wordpress code wp_get_theme(), TM_ThemeServices::$theme_version, 'tm_admin_option_option_fields' filter hook of TM_admin::option_fields() in tm-plugin.
		 */
		public function __construct($theme_id, $required_tmplugin_version = FALSE, $required_tmcommerce_version = FALSE, $required_oneclick_version = FALSE) {
			/**
			 * Set text domain for this theme
			 */
			self::$theme_id = $theme_id;

			/**
			 * Set compatibility flags
			 */
			self::$required_tmplugin_version = $required_tmplugin_version;
			self::$required_tmcommerce_version = $required_tmcommerce_version;
			self::$required_oneclick_version = $required_oneclick_version;

			
			 // Classes with TM_ThemeMountain as parent.
			 
			//new AT_ThemeServices();
			/**
			new AT_TemplateServices();
			new TM_PreheaderServices();
			new AT_NavMenuServices();
			new TM_PageFooterServices();
			new TM_MastheadServices();
			new TM_Customizer(); // extends TM_ThemeMountain. uses $theme_id
			new TM_PageOptions();
			new TM_StyleAndScripts(); // text domain free
			new TM_CustomCategoryPage();
			// @future_feature
			new TM_NavMenuCustomField();
			*/


			/**
			 * Classes without TM_ThemeMountain as parent.
			 */
			new AT_InitTGMPA(); // extends TM_ThemeMountain. uses $theme_id
			new AT_InitThemeFeatures();
			new AT_ThemeStyleAndScripts();
			new AT_Customizer();
			new AT_MegaMenu();
			//new TM_CustomFunctions();

			/**
			 * Reserved for debugging
			 */
			// add_action( 'shutdown',['ThemeMountain\\TM_ThemeServices','shutdown']);
		}

		/**
		 * Public Methods for hooks
		 */

		/**
		 * Get theme id
		 *
		 * @uses TM_ThemeMountain::$theme_id
		 *
		 * @return string
		 */
		public static function get_theme_id () {
			return self::$theme_id;
		}

		/**
		 * Is compatible with ThemeMoutain Plugin?
		 *
		 * @see 	ThemeMountain Plugin
		 * @uses 	TM_ThemeMountain::$required_tmplugin_version
		 *
		 * @return boolean|string
		 */
		public static function get_required_tmplugin_version () {
			return self::$required_tmplugin_version;
		}

		/**
		 * Is compatible with ThemeMoutain Commerce Plugin?
		 *
		 * @see 	ThemeMountain Commerce Plugin
		 * @uses 	TM_ThemeMountain::$required_tmcommerce_version
		 *
		 * @return boolean|string
		 */
		public static function get_required_tmcommerce_version () {
			return self::$required_tmcommerce_version;
		}

		/**
		 * Is compatible with ThemeMoutain OneClick?
		 *
		 * @see 	ThemeMountain OneClick plugin
		 * @uses 	TM_ThemeMountain::$required_oneclick_version
		 *
		 * @return boolean|string
		 */
		public static function get_required_oneclick_version () {
			return self::$required_oneclick_version;
		}

		/**
		 * A hook function for 'shutdown' action of Wordpress Core.
		 *
		 * For debugging only. Prints all the hooks registered at the end of execution.
		 *
		 * @since 1.0
		 * @access public
		 */
		public static function shutdown () {
			global $wp_filter, $wp_actions;
			foreach( $wp_actions as $action => $count ) {
	        	printf( '%s (%d) <br/>' . PHP_EOL, $action, $count );
	        }
			foreach( $wp_filter as $_filter => $_count ) {
		        printf( '%s (%d) <br/>' . PHP_EOL, $_filter, $_count );
		   	}
		}

		/**
		 *	Protected Methods
		 */

		/**
		 * get_stylesheet_directory() is used to find the dir location
		 * so that child theme can override template config files if needed.
		 *
		 * @since 1.0
		 * @access protected
		 *
		 * @param      string  $_target_dir_relative_path  The target dir relative path
		 */
		protected static function locate_template_in_dir ( $_target_dir_relative_path ) {
			$_template_dir = get_stylesheet_directory().'/';
			$_template_found = FALSE;
			// scan through the shortcodes in the parent theme
			foreach (glob( $_template_dir.$_target_dir_relative_path ) as $_file_path) {
				$_file_path = str_replace($_template_dir, '', $_file_path);
				$_template_found = locate_template($_file_path, TRUE, TRUE);
			}
			if(is_child_theme() && $_template_found === FALSE) {
				$_template_dir = get_template_directory().'/';
				// scan through the shortcodes in the parent theme
				foreach (glob( $_template_dir.$_target_dir_relative_path ) as $_file_path) {
					$_file_path = str_replace($_template_dir, '', $_file_path);
					locate_template($_file_path, TRUE, TRUE);
				}
			}
		}

		/**
		 * Helper function to detect whether the current admin screen is customizer.
		 *
		 * @since 1.0
		 * @access protected
		 * @see        TM_Customizer::setup_kirki(), TM_PageOptions
		 *
		 * @param      string $pageName Page name
		 *
		 * @return     boolean  True if customizer, False otherwise.
		 */
		protected static function is_pagenow ( $pageName ) {
			global $pagenow;
			return ( $pagenow === $pageName );
		}

		/**
		 * End
		 */
	}
}