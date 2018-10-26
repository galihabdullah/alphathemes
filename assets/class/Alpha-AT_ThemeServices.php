<?php
/**
 * ThemeMountain namespace reserved for ThemeMountain Wordpress themes
 * If you do not know what namespace is, please read http://php.net/manual/en/language.namespaces.php
 */
namespace Alpha {
	/**
	 * Provides Theme Services
	 *
	 * @package ThemeMountain
	 * @subpackage Core
	 * @since 1.0
	 */
	class AT_ThemeServices extends AT_AlphaThemes {
		/**
		 * Public Configuration variable
		 */

		/**
		 * Holds theme version in string.
		 *
		 * Defined in TM_ThemeServices::__construct() magic method. This is widely used in classes as well as in the front end template files.
		 *
		 * @since 1.0
		 * @access public
		 * @uses Wordpress core wp_get_theme() function.
		 * @see
		 *
		 * @var string
		 */
		public static $theme_version = '';

		/**
		 * Holds default customizer and other settings of theme styles.
		 *
		 * Merged with the default value settings only when Kirki is active (see TM_Customizer::setup_kirki() method). And this is also used as a list to deternube setting items to be output in CSS (used in the TM_TemplateServices::on_template_include() method).
		 * The config files are found under the inc/theme-styles/ directory and are loaded with the TM_ThemeServices::add_theme_style() method.
		 * See the default layout config file for further information on the array structure.
		 *
		 * @since 1.0
		 * @access public
		 * @uses TM_ThemeServices::add_theme_style() for registering all the theme styles available in this theme.
		 * @see TM_ThemeServices::get_theme_style_ids_and_names(), TM_ThemeServices, TM_TemplateServices, TM_StyleAndScripts and TM_Customizer
		 *
		 * @var array
		 */
		public static $theme_styles = array();

		/**
		 * Private Runtime Variables
		 */

		/**
		 * Caches all the available theme style ids and names.
		 *
		 * Holds numbered arrays whose arrays are key arrays with its id as key and its value is the name.
		 *
		 * @since 1.0
		 * @access private
		 * @uses Wordpress core get_option() function.
		 * @see TM_ThemeServices::get_theme_style_ids_and_names()
		 *
		 * @var array
		 */
		private static $theme_style_ids_and_names = array();

		/**
		 * Caches a default theme style id.
		 *
		 * Defined in TM_ThemeServices::get_theme_style_ids_and_names(); In one of theme-styles files there should be at least one theme style with 'is_default' set to TRUE and the id of the theme style is set to this variable when TM_ThemeServices::get_theme_style_ids_and_names() is called.
		 * See the default layout config file for further information on the array structure of theme-styles files.
		 *
		 * @since 1.0
		 * @access private
		 * @uses TM_ThemeServices::get_theme_style_ids_and_names(), TM_ThemeServices::$theme_style_ids_and_names
		 * @see TM_ThemeServices::get_current_theme_style_id(), TM_ThemeServices::on_tm_admin_option_option_fields()
		 *
		 * @var string|NULL
		 */
		private static $default_theme_style_id = NULL;

		/**
		 * Caches a current theme style id.
		 *
		 * @since 1.0
		 * @access private
		 * @uses TM_ThemeServices::get_theme_style_ids_and_names()
		 * @see TM_ThemeServices::get_current_theme_style_id()
		 *
		 * @var string|NULL
		 */
		private static $current_theme_style_id = NULL;

		/**
		 * End Properties
		 *
		 * Begin Method
		 */

		/**
		 * Class Constructor Magic Method.
		 *
		 * Cache theme version, execute class setup method and add filter for option fields in the admin panel.
		 *
		 * @since 1.0
		 * @access public
		 *
		 * @uses Wordpress code wp_get_theme(), TM_ThemeServices::$theme_version, 'tm_admin_option_option_fields' filter hook of TM_admin::option_fields() in tm-plugin.
		 */
		public function __construct() {
			/**
			 * Set theme version to the cache variable.
			 */
			$theme = wp_get_theme();
			self::$theme_version = $theme->get('Version');
			unset($theme);

			/**
			 * Load theme styles
			 */
			parent::locate_template_in_dir('inc/theme-styles/*.php');

			/**
			 * Initialize theme styles and names. Ensuring to set the current default.
			 */
			self::get_theme_style_ids_and_names();

			/**
			 * Add available theme styles automatically for admin panel.
			 * tm_admin_option_option_fields is a hook found in TM_admin::option_fields() of tm-plugin.
			 */
			add_filter('tm_admin_option_option_fields',['Alpha\\AT_ThemeServices','on_tm_admin_option_option_fields']);
		}

		/**
		 * Public Methods for hooks
		 */

		/**
		 * A hook function for 'tm_admin_option_option_fields' found in TM_admin::option_fields() of tm-plugin.
		 *
		 * Sends out theme style id and name to the admin option panel.
		 *
		 * @since 1.0
		 * @access public
		 * @uses       TM_ThemeServices::get_theme_style_ids_and_names(), TM_ThemeServices::$default_theme_style_id
		 * @see        TM_admin::option_fields() 'tm_admin_option_option_fields' found in TM_admin::option_fields() of tm-plugin.
		 *
		 * @param      array  $option_metabox  The option metabox
		 *
		 * @return     array  Modified $option_metabox array.
		 */
		public static function on_tm_admin_option_option_fields ($option_metabox) {
			if( isset($option_metabox[0]['fields'][0]['options']) ) {
				$option_metabox[0]['fields'][0]['options'] = self::get_theme_style_ids_and_names();
				if(isset(self::$default_theme_style_id)){
					$option_metabox[0]['fields'][0]['default'] = self::$default_theme_style_id;
				}
			}
			return $option_metabox;
		}

		/**
		 * Public Methods for both classes and front end template files.
		 */

		/**
		 * Gets the current theme style identifier.
		 *
		 * @since 1.0
		 * @access public
		 *
		 * @uses       TM_ThemeServices::$default_theme_style_id, TM_ThemeServices::$current_theme_style_id, Wordpress core get_option()
		 *
		 * @return     string  The current theme style identifier.
		 */
		public static function get_current_theme_style_id () {
			// see if cached
			if(isset(self::$current_theme_style_id)) {
				return self::$current_theme_style_id;
			}
			// get current theme style from option
			$thememountain_general_settings = get_option('tm_general_settings');
			if(
				is_array($thememountain_general_settings) &&
				array_key_exists('tm_theme_style', $thememountain_general_settings) &&
				array_key_exists($thememountain_general_settings['tm_theme_style'], self::$theme_style_ids_and_names)
			) {
				return $thememountain_general_settings['tm_theme_style'];
			} else {
				self::$current_theme_style_id = self::$default_theme_style_id;
				// return the default
				return self::$current_theme_style_id;
			}
		}

		/**
		 * Gets the current theme style settings.
		 *
		 * @since 1.0
		 * @access public
		 * @uses       TM_ThemeServices::get_current_theme_style_id(), TM_ThemeServices::$theme_styles
		 * @see        TM_Customizer::setup_kirki(), TM_StyleAndScripts::enqueue_styles_and_scripts() , TM_TemplateServices::on_template_include()
		 *
		 * @param      string $property_name property name, key of array
		 *
		 * @return     array  All the settings of current theme style. Returns an empty array if the property does not exist.
		 */
		public static function get_current_theme_style_properties ( $property_name ) {
			$_current_theme_style_id = self::get_current_theme_style_id();
			if(!isset(self::$theme_styles[$_current_theme_style_id][$property_name])) {
				return array();
			} else {
				return TM_ThemeServices::$theme_styles[$_current_theme_style_id][$property_name];
			}
		}

		/**
		 * Register theme style
		 *
		 * Used in theme style files under the theme-styles directory.
		 *
		 * @since 1.0
		 * @access public
		 * @uses       TM_ThemeServices::$theme_styles
		 *
		 * @return     boolean Returns false if invalid. (requires id and label)
		 */
		public static function add_theme_style ($style_data) {
			if( !array_key_exists('id', $style_data) || !array_key_exists('label', $style_data) ) {
				return FALSE;
			}
			self::$theme_styles[$style_data['id']] = array(
				'label' => $style_data['label'],
				'is_default' => (isset($style_data['is_default'])) ? TRUE : FALSE,
				'css_files' => (isset($style_data['css_files'])) ? $style_data['css_files'] : array(),
				'js_files' => (isset($style_data['js_files'])) ? $style_data['js_files'] : array(),
				'settings' => $style_data['settings']
				);
		}

		/**
		 * Get admin option values.
		 * If settings are not set yet, it returns FALSE instead of default.
		 *
		 * @param      string   $tab    The tab
		 * @param      string   $key    The key
		 * @param      string   $default	default value when the settings is not found.
		 *
		 * @return     boolean|mixed	Current option value
		 */
		public static function tm_admin_option ($tab = '',  $key = '' , $default = '') {
			$_settings_values_array = get_option($tab);
			if(is_array($_settings_values_array) && array_key_exists($key, $_settings_values_array)) {
				return $_settings_values_array[$key];
			} else {
				return $default;
			}
		}

		/**
		 * Protected methods
		 */

		/**
		 * Get and cache available theme style id and names. Also caches the default style id.
		 *
		 * @since 1.0
		 * @access protected
		 *
		 * @uses       TM_ThemeServices::$theme_style_ids_and_names, TM_ThemeServices::$default_theme_style_id
		 * @see        TM_ThemeServices::on_tm_admin_option_option_fields()
		 * @see        TM_PageOptions::get_nav_menu_list()
		 *
		 * @return     array  The available theme style names as value and ids as key.
		 */
		protected static function get_theme_style_ids_and_names () {
			if(!empty(self::$theme_style_ids_and_names)) {
				// return cache
				return self::$theme_style_ids_and_names;
			}
			// scan
			foreach (self::$theme_styles as $_key => $_value ) {
				self::$theme_style_ids_and_names[$_key] = $_value['label'] ;
				if(
					isset($_value['is_default']) &&
					$_value['is_default'] == TRUE
				) {
					self::$default_theme_style_id = $_key;
				}
			}
			return self::$theme_style_ids_and_names;
		}

		/**
		 * End
		 */
	}
}