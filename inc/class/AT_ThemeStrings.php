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
	class AT_ThemeStrings {
		/**
		 * Configs
		 */
		/**
		 * Theme Text Domain ID.
		 * @var        string
		 */
		public static $theme_id = "alpha";

		/**
		 * Text strings
		 */
		public static $text_strings = array ();

		/**
		 * Class Constructor Magic Method.
		 *
		 * Cache theme version, execute class setup method and add filter for option fields in the admin panel.
		 *
		 * @since 1.0
		 * @access public
		 * @uses Wordpress code wp_get_theme(), AT_ThemeServices::$theme_version, 'at_admin_option_option_fields' filter hook of AT_admin::option_fields() in tm-plugin.
		 */
		public function __construct() {
			self::define_text_strings();
		}

		/**
		 * @since 1.0.8
		 * @access public
		 * @uses       AT_ThemeStrings::$theme_id
		 */
		public static function define_text_strings () {
			self::$text_strings['AT_CustomCategoryPage'] = array(
				'custom_category_page' => esc_html__('Custom Category Page',"alpha"),
				'do_not_use_custom_page' => esc_html__('Do not use custom page',"alpha"),
				'choose_page' => esc_html__('Choose Page',"alpha"),
			);

			self::$text_strings['AT_CustomFunctions'] = array(
				'comment_waiting_for_moderation' => esc_html__('Your comment is awaiting moderation.',"alpha"),
				'comment_time' => esc_html__('%1$s at %2$s',"alpha"),
				'edit' => esc_html__('Edit',"alpha"),
				'excerpt' => esc_html__('Excerpt',"alpha"),
			);

			self::$text_strings['AT_NavMenuServices'] = array(
				'hide_navigation_menu' => esc_html__('Hide Navigation Menu',"alpha"),
				'none' => esc_html__('None',"alpha"),
				'please_create_a_new_menu' => esc_html__('Please create a new menu',"alpha"),
			);	

			self::$text_strings['AT_TemplateServices'] = array(
				'category_archives' => esc_html__('Category Archives: %s',"alpha"),
				'search_results_for' => esc_html__('Search Results for: %s',"alpha"),
				'search_more' => esc_html__('Search further.',"alpha"),
				'all_posts_by' => esc_html__('All posts by %s',"alpha"),
				'not_found_title_caption' => esc_html__('404 Not Found',"alpha"),
				'results_not_found_message' => esc_html__('Please check the URL for proper spelling or capitalization. Alternatively try to search below.',"alpha"),
				'portfolio' => esc_html__('Portfolio',"alpha"),
			);

			self::$text_strings['AT_NavMenuCustomField'] = array(
				'at_custom_nav' => esc_html__('Register Menu Item As:',"alpha"),
				'at_custom_nav_none' => esc_html__('None',"alpha"),
				'at_custom_nav_megamenu' => esc_html__('Mega Menu Parent Link',"alpha"),
				'at_custom_nav_button' => esc_html__('Regular button (links to URL)',"alpha"),
				'at_custom_nav_icon' => esc_html__('Icon (links to URL)',"alpha"),
				'at_custom_nav_modalButton' => esc_html__('Modal button (links to modal)',"alpha"),
				'at_custom_nav_modal_aux_classes' => esc_html__('Modal Auxiliary Classes',"alpha"),

			);

			/**
			 * Navigtion Location
			 */
			self::$text_strings['nav_menu_locations'] = array(
				'main_nav_menu' => esc_html__('Main Navigation Menu',"alpha"),
				/** overlay */
				'overlay_menu'	=> esc_html__('Overlay Menu',"alpha"),
				'overlay_secondary_menu' => esc_html__('Overlay Secondary Menu',"alpha"),
				'overlay_social_links' => esc_html__('Overlay Social Links',"alpha"),
				/** off canvas */
				'off_canvas_menu'	=> esc_html__('Off-Canvas Menu',"alpha"),
				'off_canvas_secondary_menu'	=> esc_html__('Off-Canvas Secondary Menu',"alpha"),
				'off_canvas_social_links' => esc_html__('Off-Canvas Social Links',"alpha"),
				);

			/**
			 * Menu Style Names
			 */
			self::$text_strings['nav_menu_styles'] = array(
				'default' => esc_html__('Default',"alpha"),
				'hamburger' => esc_html__('Hamburger',"alpha"),
				'hide' => esc_html__('Hide Nav Menu',"alpha"),
				'hybrid' => esc_html__('Default and Hamburger (hybrid)',"alpha"),
				);

			/**
			 * Navigation Customizer Settings
			 * array index 0 for label and 1 for description.
			 */
			self::$text_strings['nav_menu_customizer'] = array(
				/** default menu style */
				'at_header_navigation_alignment' => array(
					esc_html__( 'Navigation Menu Alignment', "alpha" ),
					esc_html__( 'Determines the primary navigation alignment.', "alpha" ),
					esc_html__( 'Left', "alpha" ),
					esc_html__( 'Center', "alpha" ),
					esc_html__( 'Right', "alpha" ),
					),
				'at_header_width' => array(
					esc_html__( 'Header Width', "alpha" ),
					esc_html__( 'Determines the Header Width either fixed or full width.', "alpha" ),
					esc_html__( 'Fixed Width', "alpha" ),
					esc_html__( 'Full Width', "alpha" ),
					),
				'at_header_secondary_navigation_alignment' => array(
					esc_html__( 'Secondary Navigation Alignment', "alpha" ),
					esc_html__( 'Determines the secondary navigation alignment.', "alpha" ),
					esc_html__( 'Left', "alpha" ),
					esc_html__( 'Right', "alpha" ),
					),
				// Top Header Navigation Color
				'at_page_header_nav_default_menu_top_color' => array(
					esc_html__( 'Top Header Navigation Color', "alpha" ),
					),
				'at_page_header_nav_default_menu_top_color_hover' => array(
					esc_html__( 'Top Header Navigation Hover Color', "alpha" ),
					),
				'at_page_header_nav_default_menu_top_color_current' => array(
					esc_html__( 'Top Header Navigation Current Color', "alpha" ),
					),
				// Header Nenu Menu Body
				'at_page_header_nav_default_menu_body_color' => array(
					esc_html__( 'Body Header Navigation Color', "alpha" ),
					),
				'at_page_header_nav_default_menu_body_color_hover' => array(
					esc_html__( 'Body Header Navigation Hover Color', "alpha" ),
					),
				'at_page_header_nav_default_menu_body_color_active' => array(
					esc_html__( 'Body Header Navigation Active Color', "alpha" ),
					),
				'at_page_header_nav_default_menu_sub_bkg_color' => array(
					esc_html__( 'Sub Menu Background Color', "alpha" ),
					),
				'at_page_header_nav_default_menu_sub_link_color' => array(
					esc_html__( 'Sub Menu Link Color', "alpha" ),
					),
				'at_page_header_nav_default_menu_sub_link_color_hover' => array(
					esc_html__( 'Sub Menu Link Hover Color', "alpha" ),
					),
				'at_page_header_nav_default_menu_sub_link_color_active' => array(
					esc_html__( 'Sub Menu Link Active Color', "alpha" ),
					),
				'at_page_header_nav_default_menu_sub_link_background_color_hover' => array(
					esc_html__( 'Sub Menu Link & Active Background Color', "alpha" ),
					),
				'at_page_header_nav_mega_submenu_border_color' => array(
					esc_html__( 'Mega Sub Menu Border Color', "alpha" ),
					),
				'at_page_header_default_menu_top_bkg_color' => array(
					esc_html__( 'Top Header Background Color', "alpha" ),
					),
				'at_page_header_default_menu_body_bkg_color' => array(
					esc_html__( 'Body Header Background Color', "alpha" ),
					esc_html__( 'The background color the header receives as the user begins to scroll the page.', "alpha" ),
					),
				/** hamburger menu style */
				'at_page_header_hamburger_menu_bkg_color' => array(
					esc_html__( 'Hamburger Navigation Background Color', "alpha" ),
					),
				'at_page_header_hamberger_menu_icon_color' => array(
					esc_html__( 'Hamburger Navigation Color', "alpha" ),
					),
				'at_page_header_hamberger_menu_icon_hover_color' => array(
					esc_html__( 'Hamburger Navigation Hover Color', "alpha" ),
					),
				'at_page_header_hamberger_mobile_header_background_color' => array(
					esc_html__( 'Hamburger Mobile Header Background Color', "alpha" ),
					),
				'at_page_header_hamberger_mobile_header_border_color' => array(
					esc_html__( 'Mobile Header Border Color', "alpha" ),
					),
				/* Logo Background Color */
				'at_page_header_logo_background_color' => array(
					esc_html__( 'Logo Background Color', "alpha" ),
				),
				/** at_page_header_button_appearance */
				// TOP
				'at_top_header_nav_button_background_color' => array(
					esc_html__( 'Top Header Button Background Color', "alpha" ),
					),
				'at_top_header_nav_button_border_color' => array(
					esc_html__( 'Top Header Button Border Color', "alpha" ),
					),
				'at_top_header_nav_button_text_color' => array(
					esc_html__( 'Top Header Button Text Color', "alpha" ),
					),
				'at_top_header_nav_button_background_color_hover' => array(
					esc_html__( 'Top Header Button Hover Background Color', "alpha" ),
					),
				'at_top_header_nav_button_border_color_hover' => array(
					esc_html__( 'Top Header Button Hover Border Color', "alpha" ),
					),
				'at_top_header_nav_button_text_color_hover' => array(
					esc_html__( 'Top Header Button Hover Text Color', "alpha" ),
					),
				// BODY
				'at_body_header_nav_button_background_color' => array(
					esc_html__( 'Body Header Button Background Color', "alpha" ),
					),
				'at_body_header_nav_button_border_color' => array(
					esc_html__( 'Body Header Button Border Color', "alpha" ),
					),
				'at_body_header_nav_button_text_color' => array(
					esc_html__( 'Body Header Button Text Color', "alpha" ),
					),
				'at_body_header_nav_button_background_color_hover' => array(
					esc_html__( 'Body Header Button Hover Background Color', "alpha" ),
					),
				'at_body_header_nav_button_border_color_hover' => array(
					esc_html__( 'Body Header Button Hover Border Color', "alpha" ),
					),
				'at_body_header_nav_button_text_color_hover' => array(
					esc_html__( 'Body Header Button Hover Text Color', "alpha" ),
					),
				);

			/**
			 * Preheader Customizer Settings
			 */
			self::$text_strings['preheader_customizer'] = array(
				/** default menu style */
				'at_preheader_type' => array(
					esc_html__( 'Show Pre Header', "alpha" ),
					esc_html__( 'Determines whether the pre-header should be shown.', "alpha" ),
					esc_html__( 'Use preheader', "alpha" ),
					esc_html__( 'Do not show preheader', "alpha" ),
					esc_html__( 'Use the settings as set in the Customizer', "alpha" ),
					),
				'at_preheader_height' => array(
					esc_html__( 'Pre Header Height', "alpha" ),
					esc_html__( 'Determines initial pre-header height. Note: default is set to auto, which means it auto expands to its content. Any numerical value requires the suffix px to be entered.', "alpha" ),
					),
				'at_preheader_id_to_show' => array(
					esc_html__( 'Pre Header to show', "alpha" ),
					esc_html__( 'Determines which custom pre-header to use.', "alpha" ),
					),
				'at_preheader_link_color' => array(
					esc_html__( 'Pre Header Link Color', "alpha" ),
					),
				'at_preheader_link_color_hover' => array(
					esc_html__( 'Pre Header Link Hover Color', "alpha" ),
					),
				); // end

			/**
			 * customizer panels
			 */
			self::$text_strings['customizer_panels'] = array(
				'at_header_settings' => array(
					esc_html__( 'Header Settings', "alpha" ),
					esc_html__( 'This section allows you to manage your site logo, main and mobile navigation colors, header background color states and positions.', "alpha" ),
					),
				'at_aux_nav_settings' => array(
					esc_html__( 'Auxiliary Navigation Settings', "alpha" ),
					),
				'at_content_settings' => array(
					esc_html__( 'Content Settings', "alpha" ),
					esc_html__( 'In this section you can manage everything from fonts, font colors, to default titles for pages such as Tm folio, 404 pages, archive, category, search and author index pages.', "alpha" ),
					),
				'at_footer_settings' => array(
					esc_html__( 'Footer Settings', "alpha" ),
					esc_html__( 'In this section you can manage the number of footer columns, footer colors and footer form colors.', "alpha" ),
					),
				'at_form_settings' => array(
					esc_html__( 'Form Settings', "alpha" ),
					esc_html__( 'In this section you can manage all form colors relating to contact forms, comment forms, and search fields.', "alpha" ),
					),
				);

			/**
			 * customizer sections
			 */
			self::$text_strings['customizer_sections'] = array(
				// Navigation Header
				'at_navigation_header_logo' => array(
					esc_html__( 'Header Logo', "alpha" ),
					esc_html__( '-', "alpha" ),
					),
				'at_page_header_nav_appearance' => array(
					esc_html__( 'Header Navigation Appearance', "alpha" ),
					esc_html__( 'Determines whether your site should employ a default main navigation or the more modern, hamburger navigation. Below are dependent color options for each navigation type.', "alpha" ),
					),
				'at_page_header_appearance' => array(
					esc_html__( 'Header Appearance', "alpha" ),
					esc_html__( '-', "alpha" ),
					),
				'at_page_header_button_appearance' => array(
					esc_html__( 'Header Button Appearance', "alpha" ),
					esc_html__( '-', "alpha" ),
					),
				'at_page_header_site_search_appearance' => array(
					esc_html__( 'Site Search Appearance', "alpha" ),
					esc_html__( '-', "alpha" ),
					),
				'at_preheader_settings' => array(
					esc_html__( 'Pre-Header Settings', "alpha" ),
					esc_html__( '-', "alpha" ),
					),
				// Overlay Navigation
				'at_overlay_nav_settings' => array(
					esc_html__( 'Overlay Navigation Settings', "alpha" ),
					esc_html__( '-', "alpha" ),
					),
				'at_off_canvas_nav_settings' => array(
					esc_html__( 'Off-Canvas Navigation Settings', "alpha" ),
					esc_html__( '-', "alpha" ),
					),
				// Content Layout Settings
				'at_language_settings' => array(
					esc_html__( 'Language', "alpha" ),
					esc_html__( '-', "alpha" ),
					),
				'at_content_font_settings' => array(
					esc_html__( 'Fonts', "alpha" ),
					esc_html__( '-', "alpha" ),
					),
				'at_content_navigation' => array(
					esc_html__( 'Content Navigation', "alpha" ),
					esc_html__( '-', "alpha" ),
					),
				'at_content_body' => array(
					esc_html__( 'Content Body Color', "alpha" ),
					esc_html__( 'Page Layout Settings for content body', "alpha" ),
					),
				// home / global
				'at_layout_home' => array(
					esc_html__( 'Blog Index Page', "alpha" ),
					esc_html__( 'Blog Index Page Layout. The settings are also used as the global settings.', "alpha" ),
					),
				// single post
				'at_layout_post' => array(
					esc_html__( 'Single Post', "alpha" ),
					esc_html__( 'Page Layout for single post pages', "alpha" ),
					),
				'at_layout_page' => array(
					esc_html__( 'Page', "alpha" ),
					esc_html__( 'Page Layout for single pages', "alpha" ),
					),
				'at_layout_at_folio' => array(
					esc_html__( 'Project Page', "alpha" ),
					esc_html__( 'Page Layout for Project Pages', "alpha" ),
					),
				'at_layout_404' => array(
					esc_html__( '404 Page', "alpha" ),
					esc_html__( '404 Page Index Page Layout', "alpha" ),
					),
				'at_layout_shop' => array(
					esc_html__( 'Shop Page', "alpha" ),
					esc_html__( 'WooCommerce Shop Page Product Archive Page Layout', "alpha" ),
					),
				// Index Pages
				'at_layout_archive' => array(
					esc_html__( 'Archive Index Page', "alpha" ),
					esc_html__( 'Home Page Index Page Layout', "alpha" ),
					),
				'at_layout_category' => array(
					esc_html__( 'Category Index Page', "alpha" ),
					esc_html__( 'Home Page Index Page Layout', "alpha" ),
					),
				'at_layout_search' => array(
					esc_html__( 'Search Index Page', "alpha" ),
					esc_html__( 'Home Page Index Page Layout', "alpha" ),
					),
				'at_layout_author' => array(
					esc_html__( 'Author Index Page', "alpha" ),
					esc_html__( 'Home Page Index Page Layout', "alpha" ),
					),
				'at_light_box' => array(
					esc_html__( 'Lightbox', "alpha" ),
					esc_html__( '-', "alpha" ),
					),
				'at_loader' => array(
					esc_html__( 'Loader', "alpha" ),
					esc_html__( '-', "alpha" ),
					),
				// Footer Settings sections
				'at_footer_columns' => array(
					esc_html__( 'Footer Columns', "alpha" ),
					esc_html__( '-', "alpha" ),
					),
				'at_footer_color' => array(
					esc_html__( 'Footer Colors', "alpha" ),
					esc_html__( '-', "alpha" ),
					),
				'at_footer_form_color' => array(
					esc_html__( 'Footer Form Colors', "alpha" ),
					esc_html__( '-', "alpha" ),
					),
				// Form
				'at_cf7_border_style_section' => array(
					esc_html__( 'Form Border Style', "alpha" ),
					esc_html__( '-', "alpha" ),
					),
				'at_cf7_color' => array(
					esc_html__( 'Contact Form 7 & Woo Form Colors', "alpha" ),
					esc_html__( 'Color settings for Contact Form 7 and Woo Commerce form elements', "alpha" ),
					),
				'at_theme_form_color' => array(
					esc_html__( 'Theme Form Colors', "alpha" ),
					esc_html__( 'Color Settings for Theme Forms, which inlcudes, post reply forms, search forms, sidebar subscribe forms.', "alpha" ),
					),
				);

			/**
			 * Customizer Settings
			 * array index 0 for label and 1 for description
			 */
			self::$text_strings['customizer'] = array(
				// fields.php
				'at_show_back_to_top' => array(
					esc_html__( 'Show back to top button', "alpha" ),
					esc_html__( 'Determines whether the "back to top" link should be shown or hidden.', "alpha" ),
					esc_html__( 'Show', "alpha" ),
					esc_html__( 'Hide', "alpha" ),
					),
				// fields_content_font_settings.php
				'at_copyright_notice' => array(
					esc_html__( 'Copyright Notice', "alpha" ),
					esc_html__( '&#169; 2018 THEMEMOUNTAIN. All Rights Reserved.', "alpha" ),
					esc_html__( 'Copyright Notice', "alpha" ),
					),
				'at_privacy_policy_link' => array(
					esc_html__( 'Link to privacy policy', "alpha" ),
					),
				'at_cookie_policy_link' => array(
					esc_html__( 'Link to cookie policy', "alpha" ),
					),
				// fields_content_layout_settings.php
				// Language settings
				// Font settings
				'at_content_font_presets' => array(
					esc_html__( 'Font Presets', "alpha" ),
					esc_html__( 'Font presets are carefully selected fonts that work well together. We have created these to save you time. In this section you can select between 30+ different font pairs selected by the ThemeMountain Team.', "alpha" ),
					esc_html__( 'Please choose a preset to load.', "alpha" ),
					),
				// font settings
				'at_body_font' => array(
					esc_html__( 'Body Font', "alpha" ),
					),
				'at_body_font_target' => array(
					esc_html__( 'Body Font CSS Target', "alpha" ),
					),
				'at_title_font' => array(
					esc_html__( 'Title Font', "alpha" ),
					),
				'at_title_font_target' => array(
					esc_html__( 'Title Font CSS Target', "alpha" ),
					),
				'at_lead_font' => array(
					esc_html__( 'Lead Font', "alpha" ),
					),
				'at_lead_font_target' => array(
					esc_html__( 'Lead Font CSS Target', "alpha" ),
					),
				/** Navigation */
				'at_navigtion_font' => array(
					esc_html__( 'Navigation Font', "alpha" ),
					),
				'at_navigtion_font_target' => array(
					esc_html__( 'Navigation Font CSS Target', "alpha" ),
					),
				/** Form */
				'at_form_font' => array(
					esc_html__( 'Form Font', "alpha" ),
					),
				'at_form_font_target' => array(
					esc_html__( 'Form Font CSS Target', "alpha" ),
					),
				/** Project Title and Description Elements */
				'at_project_title_and_description_font' => array(
					esc_html__( 'Project Title and Description Font', "alpha" ),
					),
				'at_project_title_and_description_font_target' => array(
					esc_html__( 'Project Title and Description Font CSS Target', "alpha" ),
					),
				'at_blockquote_font' => array(
					esc_html__( 'Blockquote Font', "alpha" ),
					),
				'at_blockquote_font_target' => array(
					esc_html__( 'Blockquote Font CSS Target', "alpha" ),
					),
				// alt fonts
				'at_alt_font_1' => array(
					esc_html__( 'Font Alternative 1', "alpha" ),
					),
				'at_alt_font_1_target' => array(
					esc_html__( 'Font Alternative 1 CSS Target', "alpha" ),
					),
				'at_alt_font_2' => array(
					esc_html__( 'Font Alternative 2', "alpha" ),
					),
				'at_alt_font_2_target' => array(
					esc_html__( 'Font Alternative 2 CSS Target', "alpha" ),
					),
				'at_alt_font_3' => array(
					esc_html__( 'Font Alternative 3', "alpha" ),
					),
				'at_alt_font_3_target' => array(
					esc_html__( 'Font Alternative 3 CSS Target', "alpha" ),
					),
				// heading titles
				'at_h_tag_font_sizes' => array(
					esc_html__( 'H Tag Font Sizes', "alpha" ),
					),
				'at_aux_title_font_sizes' => array(
					esc_html__( 'Auxiliary Title Font Sizes', "alpha" ),
					),
				'at_lead_font_size' => array(
					esc_html__( 'Lead Font Size', "alpha" ),
					),
				'at_aux_text_font_sizes' => array(
					esc_html__( 'Auxiliary Text Font Sizes', "alpha" ),
					),
				/* H Tag Font Sizes */
				'at_title_font_size_h1' => array(
					esc_html__( 'Title H1 Font Size', "alpha" ),
					),
				'at_title_font_size_h2' => array(
					esc_html__( 'Title H2 Font Size', "alpha" ),
					),
				'at_title_font_size_h3' => array(
					esc_html__( 'Title H3 Font Size', "alpha" ),
					),
				'at_title_font_size_h4' => array(
					esc_html__( 'Title H4 Font Size', "alpha" ),
					),
				'at_title_font_size_h5' => array(
					esc_html__( 'Title H5 Font Size', "alpha" ),
					),
				'at_title_font_size_h6' => array(
					esc_html__( 'Title H6 Font Size', "alpha" ),
					),
				/* Auxiliary Title Font Sizes */
				'at_title_font_size_extra_large' => array(
					esc_html__( 'Extra Large Title Font Size', "alpha" ),
				),
				'at_title_font_size_large' => array(
					esc_html__( 'Large Title Font Size', "alpha" ),
				),
				'at_title_font_size_medium' => array(
					esc_html__( 'Medium Title Font Size', "alpha" ),
				),
				'at_title_font_size_small' => array(
					esc_html__( 'Small Title Font Size', "alpha" ),
				),
				/* Lead Font Size */
				'at_title_font_size_lead' => array(
					esc_html__( 'Lead Font Size', "alpha" ),
				),
				/* Auxiliary Text Font Sizes */
				'at_text_font_size_extra_large' => array(
					esc_html__( 'Extra Large Text Font Size', "alpha" ),
				),
				'at_text_font_size_large' => array(
					esc_html__( 'Large Text Font Size', "alpha" ),
				),
				'at_text_font_size_medium' => array(
					esc_html__( 'Medium Text Font Size', "alpha" ),
				),
				'at_text_font_size_small' => array(
					esc_html__( 'Small Text Font Size', "alpha" ),
				),
				// fields_footer_form.php
				// Global Loop Settings
				'at_global_loop_info_intro' => array(
					esc_html__( 'This is for %sBlog Index page%s. And anything set here is used for other loop index pages unless you do not specify custom settings on them.', "alpha" ),
					),
				'at_post_twitter' => array(
					esc_html__( 'Enable Twitter SNS icon', "alpha" ),
					esc_html__( 'Whether the single post page should have a Twitter share icon', "alpha" ),
					),
				'at_post_facebook' => array(
					esc_html__( 'Enable Facebook SNS icon', "alpha" ),
					esc_html__( 'Whether the single post page should have a Facebook share icon', "alpha" ),
					),
				'at_post_googleplus' => array(
					esc_html__( 'Enable Google + SNS icon', "alpha" ),
					esc_html__( 'Whether the single post page should have a Google+ share icon', "alpha" ),
					),
				'at_post_pinterest' => array(
					esc_html__( 'Enable Pinterest icon', "alpha" ),
					esc_html__( 'Whether the single post page should have a Pinterest share icon', "alpha" ),
					),
				// Home
				'at_page_header_title_home' => array(
					esc_html__( 'Page Header Title', "alpha" ),
					esc_html__( 'Sets the page title for the blog index. Leave blank to use your site tag line for your home page index page title.', "alpha" ),
					),
				// 404
				'at_error_page_type' => array(
					esc_html__( 'Error Page Type', "alpha" ),
					esc_html__( 'Determines whether the error page should use the default 404 page layout, or whether a custom post type layout should be used (layout created using Visual Composer).', "alpha" ),
					esc_html__( 'Use Default Layout', "alpha" ),
					esc_html__( 'Use AT Error Page', "alpha" ),
				),
				'at_error_page_id_to_show' => array(
					esc_html__( 'AT Error Page to Show', "alpha" ),
					'',
					esc_html__( 'Select a Error Page', "alpha" ),
					),
				'at_page_header_title_404' => array(
					esc_html__( 'Page Header Title', "alpha" ),
					esc_html__( 'Sets the page title for the 404 index. Leave blank to use default.', "alpha" ),
					),
				'at_search_message_404' => array(
					esc_html__( 'Search Message', "alpha" ),
					esc_html__( 'Sets the page title for the 404 search message. Leave blank to use default.', "alpha" ),
					),
				// Search
				'at_page_header_title_search' => array(
					esc_html__( 'Page Header Title', "alpha" ),
					esc_html__( 'Sets the page title for the search index. Leave blank to use default.', "alpha" ),
					),
				'at_search_message_search' => array(
					esc_html__( 'Search Message', "alpha" ),
					esc_html__( 'Sets the page title for the search message. Leave blank to use default.', "alpha" ),
					),
				// Archive
				'at_page_header_title_archive' => array(
					esc_html__( 'Page Header Title', "alpha" ),
					esc_html__( 'Sets the page title for the archive index. Leave blank to use default.', "alpha" ),
					),
				// Category
				'at_page_header_title_category' => array(
					esc_html__( 'Page Header Title', "alpha" ),
					esc_html__( 'Sets the page title for the category index. Leave blank to use default.', "alpha" ),
					),
				// Author
				'at_page_header_title_author' => array(
					esc_html__( 'Page Header Title', "alpha" ),
					esc_html__( 'Sets the page title for the author index. Leave blank to use default.', "alpha" ),
					),
				// at_folio
				'at_page_header_title_at_folio' => array(
					esc_html__( 'Page Header Title', "alpha" ),
					esc_html__( 'Sets the page title for the ThemeMountain Portofolio custom post type index. Leave blank to use default.', "alpha" ),
					),
				// Search Info
				'at_search_loop_info_intro' => array(
					esc_html__( 'This is for %ssearch index page%s.', "alpha" ),
					),
				// 404
				'at_404_info_intro' => array(
					esc_html__( 'This is for %s404 index page%s.', "alpha" ),
					),
				// Advanced menu
				'at_use_custom_settings_home' => array(
					esc_html__( 'Show advanced setting items.', "alpha" ),
					esc_html__( 'This section controls advanced settings such as blog index layout, sidebar options and header styles.', "alpha" ),
					),
				'at_use_custom_settings_a' => array(
					esc_html__( 'Use Custom Setings.', "alpha" ),
					esc_html__( 'By default global settings are used. You can specify unique settings for the single page by turning on "Use Custom Settings".', "alpha" ),
					),
				'at_use_custom_settings_b' => array(
					esc_html__( 'Use Custom Setings.', "alpha" ),
					esc_html__( 'By default global settings are used.', "alpha" ),
					),
				// Recent Post Title
				'show_recent_post_title_' => array(
					esc_html__( 'Show Recent Post Title', "alpha" ),
					'',
					),
				'recent_post_title_' => array(
					esc_html__( 'Recent Post Title', "alpha" ),
					'',
					esc_html__( 'Recent Posts', "alpha" ),
					),
				'recent_post_title_alignment_' => array(
					esc_html__( 'Recent Post Title Alignment', "alpha" ),
					'',
					esc_html__( 'Left', "alpha" ),
					esc_html__( 'Center', "alpha" ),
					esc_html__( 'Right', "alpha" ),
					),
				'recent_post_title_bottom_padding_' => array(
					esc_html__( 'Recent Post Title Bottom Padding', "alpha" ),
					'',
					),
				// Excerpt Layout Style
				'at_loop_style_' => array(
					esc_html__( 'Excerpt Layout Style', "alpha" ),
					esc_html__( 'Determines the blog index page layout, either Wide Layout, 3 Column Layout or 4 Column Layout.', "alpha" ),
					esc_html__( 'Wide Layout', "alpha" ),
					esc_html__( 'Grid Layout', "alpha" ),
					esc_html__( 'Creative Layout', "alpha" ),
					),
				'at_excerpt_grid_layout_columns_' => array(
					esc_html__( 'Grid Layout Columns', "alpha" ),
					'',
					esc_html__( '2', "alpha" ),
					esc_html__( '3', "alpha" ),
					esc_html__( '4', "alpha" ),
					),
				'at_column_gutters_' => array(
					esc_html__( 'Column Gutters', "alpha" ),
					'',
					esc_html__( 'None', "alpha" ),
					esc_html__( 'Small', "alpha" ),
					esc_html__( 'Large', "alpha" ),
					),
				'at_loop_thumbnail_ratio_' => array(
					esc_html__( 'Thumbnail Ratio', "alpha" ),
					esc_html__( 'The ratio used for calculating grid item with and height. Changing the ratio will change the height of the masonry grid items.', "alpha" ),
					),
				'at_grid_layout_width_' => array(
					esc_html__( 'Grid Layout Width', "alpha" ),
					esc_html__( 'Determines whether the blog index page layout should be fixed or full width.', "alpha" ),
					esc_html__( 'Fixed Width', "alpha" ),
					esc_html__( 'Full Width', "alpha" ),
					),
				// Blog grid item background color and post color needs color options in Customiser #192
				'at_grid_layout_box_article_background_color_' => array(
					esc_html__( 'Article Background Color', "alpha" ),
					'',
					),
				'at_grid_layout_box_article_color_' => array(
					esc_html__( 'Article Color', "alpha" ),
					'',
					),
				'at_grid_layout_box_article_title_color_' => array(
					esc_html__( 'Article Title Color', "alpha" ),
					'',
					),
				'at_grid_layout_box_article_title_color_hover_' => array(
					esc_html__( 'Article Title Hover Color', "alpha" ),
					'',
					),
				'at_grid_layout_box_article_link_color_' => array(
					esc_html__( 'Article Link Color', "alpha" ),
					'',
					),
				'at_grid_layout_box_article_link_color_hover_' => array(
					esc_html__( 'Article Link Hover Color', "alpha" ),
					'',
					),
				// End #192
				// #226
				'at_grid_layout_box_article_post_meta_color_' => array(
					esc_html__( 'Article Post Meta Color', "alpha" ),
					'',
					),
				// End #226
				'at_use_sidebar_' => array(
					esc_html__( 'Sidebar Settings', "alpha" ),
					esc_html__( 'Determines whether the blog index page layout should have No sidebar, Sidebar to the left or Sidebar to the right.', "alpha" ),
					esc_html__( 'No side bar', "alpha" ),
					esc_html__( 'Right', "alpha" ),
					esc_html__( 'Left', "alpha" ),
					),
				/** Add overlay info color colorpicker to Under Customizing> Content Settings > Blog Index Page #90 */
				'at_post_rollover_background_color_wide_grids_' => array(
					esc_html__( 'Post Rollover Background Color', "alpha" ),
					),
				'at_post_rollover_background_color_creative_' => array(
					esc_html__( 'Post Rollover Background Color', "alpha" ),
					),
				// end #90
				// Add blog rollover color option to customiser #180
				// Content Settings > Blog Index Page, and Page options, Recent Posts
				'at_post_rollover_color_wide_grids_home' => array(
					esc_html__( 'Post Rollover Color', "alpha" ),
					''
				),
				'at_post_rollover_color_creative_home' => array(
					esc_html__( 'Post Rollover Color', "alpha" ),
					''
				),
				//
				// end #180
				'at_use_masthead_title_' => array(
					esc_html__( 'Use Masthead Title', "alpha" ),
					esc_html__( 'Determines whether a masthead title should be used.', "alpha" ),
					),
				/** Page Head Background Title Color */
				'at_page_head_title_background_color_' => array(
					esc_html__( 'Masthead Title Background Color', "alpha" ),
					),
				'at_page_head_title_font_color_' => array(
					esc_html__( 'Masthead Title Font Color', "alpha" ),
					),
				'at_page_head_title_background_image_' => array(
					esc_html__( 'Masthead Title Background Image', "alpha" ),
					esc_html__( 'Upload a header background image.', "alpha" ),
					),
				'at_page_head_title_overlay_background_color_' => array(
					esc_html__( 'Masthead Overlay Background Color', "alpha" ),
					),
				// Pagination Options
				'at_pagination_background_color_' => array(
					esc_html__( 'Pagination Link Background Color', "alpha" ),
				),
				'at_pagination_background_color_hover_' => array(
					esc_html__( 'Pagination Link Background Hover Color', "alpha" ),
				),
				'at_pagination_background_color_active_' => array(
					esc_html__( 'Link Active Background Color', "alpha" ),
				),
				'at_pagination_border_color_' => array(
					esc_html__( 'Pagination LInk Border Color', "alpha" ),
				),
				'at_pagination_border_color_hover_' => array(
					esc_html__( 'Pagination Link Border Hover Color', "alpha" ),
				),
				'at_pagination_border_color_active_' => array(
					esc_html__( 'Pagination Link Active Border Color', "alpha" ),
				),
				'at_pagination_link_color_' => array(
					esc_html__( 'Pagination Link Color', "alpha" ),
				),
				'at_pagination_link_color_hover_' => array(
					esc_html__( 'Pagination Link Hover Color', "alpha" ),
				),
				'at_pagination_link_color_active_' => array(
					esc_html__( 'Pagination Link Active Color', "alpha" ),
				),
				'at_pagination_return_to_index_' => array(
					esc_html__( 'Pagination Return to Index', "alpha" ),
					'',
					esc_html__( 'None', "alpha" ),
					esc_html__( 'Label', "alpha" ),
					esc_html__( 'Icon', "alpha" ),
				),
				'at_pagination_return_to_index_label_' => array(
					esc_html__( 'Pagination Return to Index Label', "alpha" ),
				),
				// content body
				'at_content_body_background_color' => array(
					esc_html__( 'Body Background Color', "alpha" ),
					),
				'at_section_block_background_color' => array(
					esc_html__( 'Section Block Background Color', "alpha" ),
					),
				'at_content_body_text_color' => array(
					esc_html__( 'Content Body Text Color', "alpha" ),
					),
				'at_content_body_title_color' => array(
					esc_html__( 'Title Color', "alpha" ),
					),
				'at_content_body_title_link_color' => array(
					esc_html__( 'Title Link Color', "alpha" ),
					),
				'at_content_body_title_link_color_hover' => array(
					esc_html__( 'Title Link Hover Color', "alpha" ),
					),
				'at_content_body_link_color' => array(
					esc_html__( 'Link Color', "alpha" ),
					),
				'at_content_body_link_color_hover' => array(
					esc_html__( 'Link Hover Color', "alpha" ),
					),
				'at_lead_font_color' => array(
					esc_html__( 'Lead Font Color', "alpha" ),
					),
				// Single Post Options
				'at_show_author_bio' => array(
					esc_html__( 'Show Author Bio', "alpha" ),
					''
					),
				// Global Button Color
				'at_button_set_global_color' => array(
					esc_html__( 'Set Global Button Color', "alpha" ),
					esc_html__( 'Determines whether global button sizes, styles and colors should apply. You can override the colors individually for form elements and button shortcodes.', "alpha" ),
					),
				// Button Size (dropdown)
				'at_button_size' => array(
					esc_html__( 'Button Size', "alpha" ),
					esc_html__( 'Determines whether button should be small, medium, large or extra large in size.', "alpha" ),
					esc_html__( 'Small', "alpha" ),
					esc_html__( 'Medium', "alpha" ),
					esc_html__( 'Large', "alpha" ),
					esc_html__( 'Extra Large', "alpha" ),
					),
				// Button Style (dropdown)
				'at_button_style' => array(
					esc_html__( 'Button Style', "alpha" ),
					esc_html__( 'Whether button should have sharp corners, rounded corners, or be pill-shaped.', "alpha" ),
					esc_html__( 'None', "alpha" ),
					esc_html__( 'Rounded', "alpha" ),
					esc_html__( 'Pill', "alpha" ),
					),
				// Global Button Background Color (colorpicker)
				'at_button_bkg_color' => array(
					esc_html__( 'Global Button Background Color', "alpha" ),
					),
				// Global Button Background Color Hover (colorpicker)
				'at_button_bkg_color_hover' => array(
					esc_html__( 'Global Button Background Color Hover', "alpha" ),
					),
				// Global Button Border Color (colorpicker)
				'at_button_border_color' => array(
					esc_html__( 'Global Button Border Color', "alpha" ),
					),
				// Global Button Border Color Hover (colorpicker)
				'at_button_border_color_hover' => array(
					esc_html__( 'Global Button Border Color Hover', "alpha" ),
					),
				// Global Button Label Color (colorpicker)
				'at_button_label_color' => array(
					esc_html__( 'Global Button Label Color', "alpha" ),
					),
				// Global Button Label Color Hover (colorpicker)
				'at_button_label_color_hover' => array(
					esc_html__( 'Global Button Label Color Hover', "alpha" ),
					),
				// fields_footer.php
				'at_footer_type' => array(
					esc_html__( 'Footer Type', "alpha" ),
					esc_html__( 'Determines whether the footer should use the WordPress default widget space, or whether the footer should use a custom post type (layout created using Visual Composer).', "alpha" ),
					esc_html__( 'Use Widget Space', "alpha" ),
					esc_html__( 'Use AT Footer', "alpha" ),
					esc_html__( 'Hide Footer', "alpha" ),
					),
				'at_footer_id_to_show' => array(
					esc_html__( 'AT Footer to show', "alpha" ),
					esc_html__( 'Determines which custom footer to use.', "alpha" ),
					),
				'at_footer_column_number' => array(
					esc_html__( 'The number of columns in the footer', "alpha" ),
					esc_html__( 'Determines the number of columns the footer should have. Note: Our themes support 1-4 footer columns.', "alpha" ),
					esc_html__( '1 Column', "alpha" ),
					esc_html__( '2 Columns', "alpha" ),
					esc_html__( '3 Columns', "alpha" ),
					esc_html__( '4 Columns', "alpha" ),
					esc_html__( '5 Columns', "alpha" ),
					),
				'at_footer_column_align_' => array(
					esc_html__( 'Column %s Content Alignment', "alpha" ),
					esc_html__( 'Determines the content alignment of each footer column. Alignment can be set for each individual column.', "alpha" ),
					esc_html__( 'Left', "alpha" ),
					esc_html__( 'Center', "alpha" ),
					esc_html__( 'Right', "alpha" ),
					),
				'at_footer_position' => array(
					esc_html__( 'Footer Position', "alpha" ),
					esc_html__( 'Determines whether the footer should scroll with the content or fixed and revealed by the content.', "alpha" ),
					esc_html__( 'Relative', "alpha" ),
					esc_html__( 'Fixed', "alpha" ),
					),
				'at_footer_scale_content_upon_footer_reveal' => array(
					esc_html__( 'Scale content upon footer reveal', "alpha" ),
					esc_html__( 'Determines if the content should scale and animate as the footer is revealed.', "alpha" ),
					),
				// Footer Color Section
				'at_footer_background_color' => array(
					esc_html__( 'Footer Background Color', "alpha" ),
					),
				'at_footer_text_color' => array(
					esc_html__( 'Footer Text Color', "alpha" ),
					),
				'at_footer_link_text_color' => array(
					esc_html__( 'Footer Link Text Color', "alpha" ),
					),
				'at_footer_link_text_color_hover' => array(
					esc_html__( 'Footer Link Hover Color', "alpha" ),
					),
				'at_footer_title_color' => array(
					esc_html__( 'Footer Title Color', "alpha" ),
					),
				'at_footer_text_font_size' => array(
					esc_html__( 'Footer Text Font Size', "alpha" ),
					),
				'at_footer_form_background_color' => array(
					esc_html__( 'Form Background Color', "alpha" ),
					),
				'at_footer_form_border_color' => array(
					esc_html__( 'Form Border Color', "alpha" ),
					),
				'at_footer_form_placeholder_color' => array(
					esc_html__( 'Form Placeholder Color', "alpha" ),
					),
				'at_footer_form_focus_background_color' => array(
					esc_html__( 'Form Focus Background Color', "alpha" ),
					),
				'at_footer_form_focus_border_color' => array(
					esc_html__( 'Form Focus Border Color', "alpha" ),
					),
				'at_footer_form_focus_text_color' => array(
					esc_html__( 'Form Focus Text Color', "alpha" ),
					),
				'at_footer_form_required_background_color' => array(
					esc_html__( 'Form Required Background Color', "alpha" ),
					),
				'at_footer_form_required_border_color' => array(
					esc_html__( 'Form Required Border Color', "alpha" ),
					),
				'at_footer_form_required_text_color' => array(
					esc_html__( 'Form Required Text Color', "alpha" ),
					),
				'at_footer_form_error_background_color' => array(
					esc_html__( 'Form Error Background Color', "alpha" ),
					),
				'at_footer_form_error_border_color' => array(
					esc_html__( 'Form Error Border Color', "alpha" ),
					),
				'at_footer_form_error_text_color' => array(
					esc_html__( 'Form Error Text Color', "alpha" ),
					),
				'at_footer_form_submit_background_color' => array(
					esc_html__( 'Form Submit Background Color', "alpha" ),
					),
				'at_footer_form_submit_border_color' => array(
					esc_html__( 'Form Submit Border Color', "alpha" ),
					),
				'at_footer_form_submit_text_color' => array(
					esc_html__( 'Form Submit Text Color', "alpha" ),
					),
				'at_footer_form_submit_hover_background_color' => array(
					esc_html__( 'Form Submit Hover Background Color', "alpha" ),
					),
				'at_footer_form_submit_hover_border_color' => array(
					esc_html__( 'Form Submit Hover Border Color', "alpha" ),
					),
				'at_footer_form_submit_hover_text_color' => array(
					esc_html__( 'Form Submit Hover Text Color', "alpha" ),
					),
				'at_footer_form_response_message_color' => array(
					esc_html__( 'Form Response Message Color', "alpha" ),
					),
				// fields_form.php
				'at_theme_form_background_color' => array(
					esc_html__( 'Form Background Color', "alpha" ),
					),
				'at_theme_form_border_color' => array(
					esc_html__( 'Form Border Color', "alpha" ),
					),
				'at_theme_form_placeholder_color' => array(
					esc_html__( 'Form Placeholder Color', "alpha" ),
					),
				'at_theme_form_placeholder_focus_color' => array(
					esc_html__( 'Form Placeholder Focus Color', "alpha" ),
					),
				'at_theme_form_focus_background_color' => array(
					esc_html__( 'Form Focus Background Color', "alpha" ),
					),
				'at_theme_form_focus_border_color' => array(
					esc_html__( 'Form Focus Border Color', "alpha" ),
					),
				'at_theme_form_focus_text_color' => array(
					esc_html__( 'Form Focus Text Color', "alpha" ),
					),
				// submit
				'at_theme_form_submit_background_color' => array(
					esc_html__( 'Form Submit Background Color', "alpha" ),
					),
				'at_theme_form_submit_border_color' => array(
					esc_html__( 'Form Submit Border Color', "alpha" ),
					),
				'at_theme_form_submit_text_color' => array(
					esc_html__( 'Form Submit Text Color', "alpha" ),
					),
				'at_theme_form_submit_hover_background_color' => array(
					esc_html__( 'Form Submit Hover Background Color', "alpha" ),
					),
				'at_theme_form_submit_hover_border_color' => array(
					esc_html__( 'Form Submit Hover Border Color', "alpha" ),
					),
				'at_theme_form_submit_hover_text_color' => array(
					esc_html__( 'Form Submit Hover Text Color', "alpha" ),
					),
				// fields_form_cf7.php
				// at_cf7_border_style_section
				'at_cf7_border_style' => array(
					esc_html__( 'Form Border Style', "alpha" ),
					'',
					esc_html__( 'None', "alpha" ),
					esc_html__( 'Rounded', "alpha" ),
					esc_html__( 'Pill', "alpha" ),
				),
				'at_cf7_background_color' => array(
					esc_html__( 'Form Background Color', "alpha" ),
					),
				'at_cf7_border_color' => array(
					esc_html__( 'Form Border Color', "alpha" ),
					),
				'at_cf7_placeholder_color' => array(
					esc_html__( 'Form Placeholder Color', "alpha" ),
					),
				'at_cf7_form_text_color' => array(
					esc_html__( 'Form Text Color', "alpha" ),
					),
				'at_cf7_placeholder_focus_color' => array(
					esc_html__( 'Form Placeholder Focus Color', "alpha" ),
					),
				'at_cf7_focus_background_color' => array(
					esc_html__( 'Form Focus Background Color', "alpha" ),
					),
				'at_cf7_focus_border_color' => array(
					esc_html__( 'Form Focus Border Color', "alpha" ),
					),
				'at_cf7_focus_text_color' => array(
					esc_html__( 'Form Focus Text Color', "alpha" ),
					),
				'at_cf7_error_background_color' => array(
					esc_html__( 'Form Error Background Color', "alpha" ),
					),
				'at_cf7_error_border_color' => array(
					esc_html__( 'Form Error Border Color', "alpha" ),
					),
				'at_cf7_error_text_color' => array(
					esc_html__( 'Form Error Text Color', "alpha" ),
					),
				'at_cf7_submit_background_color' => array(
					esc_html__( 'Form Submit Background Color', "alpha" ),
					),
				'at_cf7_submit_border_color' => array(
					esc_html__( 'Form Submit Border Color', "alpha" ),
					),
				'at_cf7_submit_text_color' => array(
					esc_html__( 'Form Submit Text Color', "alpha" ),
					),
				'at_cf7_submit_hover_background_color' => array(
					esc_html__( 'Form Submit Hover Background Color', "alpha" ),
					),
				'at_cf7_submit_hover_border_color' => array(
					esc_html__( 'Form Submit Hover Border Color', "alpha" ),
					),
				'at_cf7_submit_hover_text_color' => array(
					esc_html__( 'Form Submit Hover Text Color', "alpha" ),
					),
				'at_cf7_response_message_color' => array(
					esc_html__( 'Form Response Message Color', "alpha" ),
					),
				'at_cf7_checkbox_radio_background_color' => array(
					esc_html__( 'Checkbox & Radio Background Color', "alpha" ),
					),
				'at_cf7_checkbox_radio_border_color' => array(
					esc_html__( 'Checkbox & Radio Border Color', "alpha" ),
					),
				'at_cf7_checkbox_checked_background_color' => array(
					esc_html__( 'Checkbox Checked Background Color', "alpha" ),
					),
				'at_cf7_radio_checked_background_color' => array(
					esc_html__( 'Radio Checked Background Color', "alpha" ),
					),
				'at_cf7_checkbox_check_color' => array(
					esc_html__( 'Checkbox Check Color', "alpha" ),
					),
				'at_cf7_radiobutton_checked_color' => array(
					esc_html__( 'Radio Button Checked Color', "alpha" ),
					),
				// fields_lightbox.php
				'at_lightbox_overlay_background_color' => array(
					esc_html__( 'Lightbox Overlay Background Color', "alpha" ),
					),
				'at_lightbox_navigation_color' => array(
					esc_html__( 'Lightbox Navigation Color', "alpha" ),
					),
				'at_lightbox_caption_background_color' => array(
					esc_html__( 'Lightbox Caption Background Color', "alpha" ),
					),
				'at_lightbox_caption_color' => array(
					esc_html__( 'Lightbox Caption Color', "alpha" ),
					),
				// fields_loader.php
				'at_loader_color' => array(
					esc_html__( 'Loader Color', "alpha" ),
					),
				'at_loader_border_thickness' => array(
					esc_html__( 'Loader Border Thickness', "alpha" ),
					),
				'at_loader_size' => array(
					esc_html__( 'Loader Size', "alpha" ),
					),
				// #175. In at_off_canvas_nav_settings in fields_off_canvas_nav_settings.php
				'at_off_canvas_nav_menu_width' => array(
					esc_html__( 'Off-canvas Navigation Width', "alpha" ),
					esc_html__( 'Determines the Off-canvas navigation width.', "alpha" ),
					esc_html__( 'Default', "alpha" ),
					esc_html__( '50%', "alpha" ),
					),
				// at_off_canvas_nav_settings in fields_off_canvas_nav_settings.php
				'at_off_canvas_nav_menu_alignment' => array(
					esc_html__( 'Off-canvas Navigation Alignment', "alpha" ),
					esc_html__( 'Determines the Off-canvas navigation alignment.', "alpha" ),
					esc_html__( 'Left', "alpha" ),
					esc_html__( 'Center', "alpha" ),
					esc_html__( 'Right', "alpha" ),
					),
				'at_off_canvas_title_display' => array(
					esc_html__( 'Off-Canvas Menu Title Display', "alpha" ),
					esc_html__( 'Determines the Off-Canvas Menu Title Display.', "alpha" ),
					esc_html__( 'Show', "alpha" ),
					esc_html__( 'Hide', "alpha" ),
					),
				'at_secondary_off_canvas_title_display' => array(
					esc_html__( 'Off-Canvas Secondary Menu Title Display', "alpha" ),
					esc_html__( 'Determines the Off-Canvas Secondary Menu Title Display.', "alpha" ),
					esc_html__( 'Show', "alpha" ),
					esc_html__( 'Hide', "alpha" ),
					),
				// Off-Canvas Navigation Color
				'at_off_canvas_nav_color' => array(
					esc_html__( 'Off-Canvas Navigation Color', "alpha" ),
					),
				'at_off_canvas_nav_color_hover_active' => array(
					esc_html__( 'Off-Canvas Navigation Hover & Active Color', "alpha" ),
					),
				'at_off_canvas_background_color' => array(
					esc_html__( 'Off-Canvas Background Color', "alpha" ),
					),
				'at_offcanvas_exit_button_color' => array(
					esc_html__( 'Off-Canvas Exit Button Color', "alpha" ),
					),
				'at_offcanvas_exit_button_color_hover' => array(
					esc_html__( 'Off-Canvas Exit Button Hover Color', "alpha" ),
					),
				'at_off_canvas_nav_copyright_color' => array(
					esc_html__( 'Off-Canvas Navigation Copyright Color', "alpha" ),
					),
				'at_off_canvas_nav_position' => array(
					esc_html__( 'Off-Canvas Navigation Position', "alpha" ),
					'',
					esc_html__( 'Enter Left', "alpha" ),
					esc_html__( 'Enter Right', "alpha" ),
					),
				'at_off_canvas_nav_animation' => array(
					esc_html__( 'Off-Canvas Navigation Animation', "alpha" ),
					'',
					esc_html__( 'Content slide out', "alpha" ),
					esc_html__( 'Nav slide in', "alpha" ),
					esc_html__( 'Nav push in', "alpha" ),
					esc_html__( 'Nav scale in', "alpha" ),
					),
				// Add color options for cart to Side Navigation options in Customiser: #211
				'at_offcanvas_sub_menu_navigation_color' => array(
					esc_html__( 'Off-Canvas Sub Menu Navigation Color', "alpha" ),
				),
				'at_offcanvas_sub_menu_navigation_color_hover' => array(
					esc_html__( 'Off-Canvas Sub Menu Navigation Hover Color', "alpha" ),
				),
				'at_offcanvas_cart_delete_button_background_color' => array(
					esc_html__( 'Off-Canvas Cart Delete Button Bkg Color', "alpha" ),
				),
				// Added in #218
				'at_offcanvas_cart_badge_background_color' => array(
					esc_html__( 'Off-Canvas Cart Badge Background Color', "alpha" ),
				),
				'at_offcanvas_cart_badge_color' => array(
					esc_html__( 'Off-Canvas Cart Badge Color', "alpha" ),
				),
				// End #218
				'at_offcanvas_cart_delete_button_color' => array(
					esc_html__( 'Off-Canvas Cart Delete Button Color', "alpha" ),
				),
				'at_offcanvas_cart_delete_button_color_hover' => array(
					esc_html__( 'Off-Canvas Cart Delete Button Hover Color', "alpha" ),
				),
				'at_offcanvas_cart_price_color' => array(
					esc_html__( 'Off-Canvas Cart Price Color', "alpha" ),
				),
				'at_offcanvas_cart_total_color' => array(
					esc_html__( 'Off-Canvas Cart Total Color', "alpha" ),
				),
				'at_offcanvas_cart_total_divider_color' => array(
					esc_html__( 'Off-Canvas Cart Total Divider Color', "alpha" ),
				),
				'at_offcanvas_button_background_color' => array(
					esc_html__( 'Off-Canvas Button Background Color', "alpha" ),
				),
				'at_offcanvas_button_border_color' => array(
					esc_html__( 'Off-Canvas Button Border Color', "alpha" ),
				),
				'at_offcanvas_button_text_color' => array(
					esc_html__( 'Off-Canvas Button Text Color', "alpha" ),
				),
				'at_offcanvas_button_background_color_hover' => array(
					esc_html__( 'Off-Canvas Button Hover Background Color', "alpha" ),
				),
				'at_offcanvas_button_border_color_hover' => array(
					esc_html__( 'Off-Canvas Button Hover Border Color', "alpha" ),
				),
				'at_offcanvas_button_text_color_hover' => array(
					esc_html__( 'Off-Canvas Button Hover Text Color', "alpha" ),
				),
				// end #211
				// fields_overlay_appearance.php
				'at_overlay_nav_menu_alignment' => array(
					esc_html__( 'Overlay Navigation Alignment', "alpha" ),
					esc_html__( 'Determines the Overlay navigation alignment.', "alpha" ),
					esc_html__( 'Left', "alpha" ),
					esc_html__( 'Center', "alpha" ),
					esc_html__( 'Right', "alpha" ),
					),
				'at_overlay_menu_title_display' => array(
					esc_html__( 'Overlay Menu Title Display', "alpha" ),
					esc_html__( 'Determines the Overlay Menu Title Display.', "alpha" ),
					esc_html__( 'Show', "alpha" ),
					esc_html__( 'Hide', "alpha" ),
					),
				'at_secondary_overlay_title_display' => array(
					esc_html__( 'Overlay Secondary Menu Title Display', "alpha" ),
					esc_html__( 'Determines the Overlay Secondary Menu Title Display.', "alpha" ),
					esc_html__( 'Show', "alpha" ),
					esc_html__( 'Hide', "alpha" ),
					),
				// Overlay Navigation Color
				'at_overlay_background_color' => array(
					esc_html__( 'Overlay Navigation Background Color', "alpha" ),
					),
				'at_overlay_exit_button_color' => array(
					esc_html__( 'Overlay Navigation Exit Button Color', "alpha" ),
					),
				'at_overlay_exit_button_color_hover' => array(
					esc_html__( 'Overlay Navigation Exit Button Color', "alpha" ),
					),
				'at_overlay_nav_title_color' => array(
					esc_html__( 'Overlay Navigation Title Color', "alpha" ),
					),
				'at_overlay_nav_copyright_color' => array(
					esc_html__( 'Overlay Navigation Copyright Color', "alpha" ),
					),
				'at_overlay_nav_animation' => array(
					esc_html__( 'Overlay Navigation Animation', "alpha" ),
					'',
					esc_html__( 'Slide in Top', "alpha" ),
					esc_html__( 'Slide in Right', "alpha" ),
					esc_html__( 'Slide in Bottom', "alpha" ),
					esc_html__( 'Slide in Left', "alpha" ),
					esc_html__( 'Scale In', "alpha" ),
					),
				// fields_overlay_nav_appearance.php
				'at_overlay_navigation_color' => array(
					esc_html__( 'Overlay Navigation Color', "alpha" ),
					),
				'at_overlay_navigation_color_hover_active' => array(
					esc_html__( 'Overlay Navigation Hover & Active Color', "alpha" ),
					),
				// Add color options for cart to Side Navigation options in Customiser: #212
				'at_overlay_sub_menu_navigation_color' => array(
					esc_html__( 'Overlay Sub Menu Navigation Color', "alpha" ),
				),
				'at_overlay_sub_menu_navigation_color_hover' => array(
					esc_html__( 'Overlay Sub Menu Navigation Hover Color', "alpha" ),
				),
				// Added in #218
				'at_overlay_cart_badge_background_color' => array(
					esc_html__( 'Overlay Cart Badge Background Color', "alpha" ),
				),
				'at_overlay_cart_badge_color' => array(
					esc_html__( 'Overlay Cart Badge Color', "alpha" ),
				),
				// End #218
				'at_overlay_cart_delete_button_background_color' => array(
					esc_html__( 'Overlay Cart Delete Button Bkg Color', "alpha" ),
				),
				'at_overlay_cart_delete_button_color' => array(
					esc_html__( 'Overlay Cart Delete Button Color', "alpha" ),
				),
				'at_overlay_cart_delete_button_color_hover' => array(
					esc_html__( 'Overlay Cart Delete Button Hover Color', "alpha" ),
				),
				'at_overlay_cart_price_color' => array(
					esc_html__( 'Overlay Cart Price Color', "alpha" ),
				),
				'at_overlay_cart_total_color' => array(
					esc_html__( 'Overlay Cart Total Color', "alpha" ),
				),
				'at_overlay_cart_total_divider_color' => array(
					esc_html__( 'Overlay Cart Total Divider Color', "alpha" ),
				),
				'at_overlay_button_background_color' => array(
					esc_html__( 'Overlay Button Background Color', "alpha" ),
				),
				'at_overlay_button_border_color' => array(
					esc_html__( 'Overlay Button Border Color', "alpha" ),
				),
				'at_overlay_button_text_color' => array(
					esc_html__( 'Overlay Button Text Color', "alpha" ),
				),
				'at_overlay_button_background_color_hover' => array(
					esc_html__( 'Overlay Button Hover Background Color', "alpha" ),
				),
				'at_overlay_button_border_color_hover' => array(
					esc_html__( 'Overlay Button Hover Border Color', "alpha" ),
				),
				'at_overlay_button_text_color_hover' => array(
					esc_html__( 'Overlay Button Hover Text Color', "alpha" ),
				),
				// end #212
				// Site Search
				'at_search_modal_overlay_background_color' => array(
					esc_html__( 'Search Modal Overlay Background Color', "alpha" ),
					),
				'at_search_modal_form_placeholder_color' => array(
					esc_html__( 'Search Modal Form Placeholder Color', "alpha" ),
					),
				'at_search_modal_form_focus_color' => array(
					esc_html__( 'Search Modal Form Focus Text Color', "alpha" ),
					),
				'at_search_modal_close_link_color' => array(
					esc_html__( 'Search Modal Close Link Color', "alpha" ),
					),
				// fields_at_navigation_header_logo.php
				'at_use_top_logo' => array(
					esc_html__( 'Use top logo', "alpha" ),
					esc_html__( 'Our themes allow you to use two logos for the header. Namely, a top and body header logo. The first appears by default, and the second appears as the user begins to scroll the page. This options determines whether your site should have a top logo.', "alpha" ),
					),
				'custom_logo' => array(
					esc_html__( 'Top Logo Image', "alpha" ),
					esc_html__( 'This is where you upload your top logo. Note: the default logo width is set to 95px. This means that your logo image should measure at least 190px to ensure it looks sharp on retina displays.', "alpha" ),
					),
				'at_page_header_logo_common_menu_hover_opacity' => array(
					esc_html__( 'Header Logo Hover Opacity', "alpha" ),
					esc_html__( 'Determines the logo opacity upon hover.', "alpha" ),
					),
				'at_logo_top_width_hamburger' => array(
					esc_html__( 'Top Logo Width (hamburger)', "alpha" ),
					esc_html__( 'Determines the initial width of the top logo. Note: your logo will proportionally scale in height based on its width. If you have a vertical shaped logo, consider modifying the "Top Header Height" and "Body Header Height" under "Header Settings > Header Navigation Apperance". Default: 120', "alpha" ),
					),
				'at_logo_top_width_default' => array(
					esc_html__( 'Top Logo Width (default)', "alpha" ),
					esc_html__( 'Determines the initial width of the top logo. Note: your logo will proportionally scale in height based on its width. If you have a vertical shaped logo, consider modifying the "Top Header Height" and "Body Header Height" under "Header Settings > Header Navigation Apperance". Default: 120', "alpha" ),
					),
				'at_use_body_logo' => array(
					esc_html__( 'Use body logo', "alpha" ),
					esc_html__( 'Determines whether your site should use the same image that you uploaded for the top logo for the body logo, whether it should be different or whether you should use no body logo.', "alpha" ),
					esc_html__( 'Same as the top logo', "alpha" ),
					esc_html__( 'Different from top logo', "alpha" ),
					esc_html__( 'Do not use body logo', "alpha" ),
					),
				'at_logo_body' => array(
					esc_html__( 'Body Logo Image', "alpha" ),
					esc_html__( 'This is where you upload your body logo.', "alpha" ),
					),
				'at_logo_body_width_default' => array(
					esc_html__( 'Body Logo Width', "alpha" ),
					esc_html__( 'Determines the initial width of the body logo. Note: If the header is reduced in height upon scroll, consider reducing the logo width as well for the body logo. Default: 95', "alpha" ),
					),
				// fields_at_page_header_appearance.php
				'at_body_header_presets' => array(
					esc_html__( 'Header Style Presets', "alpha" ),
					esc_html__( 'Determines the header style and position. Note that this is a present and that each individual option for the preset can be overridden below.', "alpha" ),
					esc_html__( 'Header Above Content', "alpha" ),
					esc_html__( 'Header Above Content - Sticky on Scroll', "alpha" ),
					esc_html__( 'Header Over Content', "alpha" ),
					esc_html__( 'Header Over Content - Sticky on Scroll', "alpha" ),
					esc_html__( 'Header Over Content - Fixed', "alpha" ),
					esc_html__( 'Header Bottom', "alpha" ),
					esc_html__( 'Header Bottom - Sticky on Scroll', "alpha" ),
					),
				'at_header_position' => array(
					esc_html__( 'Header Position', "alpha" ),
					esc_html__( 'Determines the initial position of the header. The header can either be positioned relative to the page content i.e. above page content, positioned absolutely, where the header overlays the content but scrolls with the page, or, positioned fixed, where the header overlays content and remains sticky at all times.', "alpha" ),
					esc_html__( 'Relative', "alpha" ),
					esc_html__( 'Absolute', "alpha" ),
					esc_html__( 'Fixed', "alpha" ),
					),
				'at_header_fixed_on_mobile' => array(
					esc_html__( 'Header Position Mobile', "alpha" ),
					esc_html__( 'Determines whether the header should scroll with the content or remain fixed on mobile.', "alpha" ),
					esc_html__( 'Fix header on mobile', "alpha" ),
					esc_html__( 'Do not fix header on mobile', "alpha" ),
					),
				'at_header_vertical_alignment' => array(
					esc_html__( 'Header Vertical Alignment', "alpha" ),
					esc_html__( 'Determines whether the header should be position top or bottom of the viewport.', "alpha" ),
					esc_html__( 'Top', "alpha" ),
					esc_html__( 'Bottom', "alpha" ),
					),
				'at_header_vertical_alignment_bottom_value' => array(
					esc_html__( 'Header Bottom Value', "alpha" ),
					esc_html__( 'Determines the bottom position pixel value of the header.', "alpha" ),
					),
				'at_top_header_common_menu_height' => array(
					esc_html__( 'Top Header Height', "alpha" ),
					esc_html__( 'Determines initial header height. Note: default is set to 80px.', "alpha" ),
					),
				'at_body_header_default_menu_height' => array(
					esc_html__( 'Body Header Height', "alpha" ),
					esc_html__( 'Determines body header height. Note: default is set to 65px.', "alpha" ),
					),
				'at_body_header_default_menu_height_threshold' => array(
					esc_html__( 'Body Header Height Threshold', "alpha" ),
					esc_html__( 'Determines how many pixels the user must scroll before the header swaps height. Note: default is set to 100px. Leave blank not to apply.', "alpha" ),
					),
				'at_body_header_background_color_threshold' => array(
					esc_html__( 'Body Header Background Color Threshold', "alpha" ),
					esc_html__( 'Determines how many pixels the user must scroll before the header swaps background color. Note: default is set to 100px. Leave blank not to apply.', "alpha" ),
					),
				'at_body_header_compact_threshold' => array(
					esc_html__( 'Body Header Compact Threshold', "alpha" ),
					esc_html__( 'Determines the number of pixels the user must scroll before the header should be reduced in height, i.e. compacted. Leave blank not to apply.', "alpha" ),
					),
				'at_body_header_sticky_threshold' => array(
					esc_html__( 'Header Sticky Threshold', "alpha" ),
					esc_html__( 'Determines the number of pixels the user must scroll before the header should become sticky, i.e. remain fixed. Leave blank not to apply.', "alpha" ),
					),
				'at_body_header_helper_out_threshold' => array(
					esc_html__( 'Header Helper Out Threshold', "alpha" ),
					esc_html__( 'Determines the number of pixels the user must scroll before the header should slide out and default to its original position. Leave blank not to apply.', "alpha" ),
					),
				// fields_at_page_header_nav_appearance.php
				'at_header_navigation_type' => array(
					esc_html__( 'Header Navigation Type', "alpha" ),
					esc_html__( 'Determines whether your site should employ a default main navigation or the more modern, hamburger navigation.', "alpha" ),
					),
				'at_page_header_nav_top_header_border_color' => array(
					esc_html__( 'Top Header Border Color', "alpha" ),
					),
				'at_page_header_nav_body_header_border_color' => array(
					esc_html__( 'Body Header Border Color', "alpha" ),
					),
				// Added #218
				'at_page_header_cart_badge_background_color' => array(
					esc_html__( 'Header Cart Badge Background Color', "alpha" ),
				),
				'at_page_header_cart_badge_color' => array(
					esc_html__( 'Header Cart Badge Color', "alpha" ),
				),
				// End #218
				// default values for at_pagination_return_to_index_label
				'at_pagination_return_to_index_label_at_folio' => esc_html__( 'Folio index', "alpha" ),
				'at_pagination_return_to_index_label_home' => esc_html__( 'Blog index', "alpha" ),
				);

			/**
			 * Page Options Settings
			 * array index 0 for label and 1 for description
			 */
			self::$text_strings['page_options'] = array(
				/** Tab strings */
				'homepage_with_posts' => array(
					esc_html__( 'Custom options for homepage with posts', "alpha" ),
					esc_html__( 'Pre-Header', "alpha" ),
					esc_html__( 'Navigation Menu', "alpha" ),
					esc_html__( 'Footer', "alpha" ),
					esc_html__( 'Recent Posts', "alpha" ),
					esc_html__( 'Featured Media', "alpha" ),
					esc_html__( 'Grids', "alpha" ),
					),
				'page' => array(
					esc_html__( 'Custom options for page', "alpha" ),
					esc_html__( 'Pre-Header', "alpha" ),
					esc_html__( 'Navigation Menu', "alpha" ),
					esc_html__( 'Footer', "alpha" ),
					esc_html__( 'Featured Media', "alpha" ),
					esc_html__( 'Sidebar Location', "alpha" ),
					esc_html__( 'Loop', "alpha" ),
					esc_html__( 'Grids', "alpha" ),
					),
				'post' => array(
					esc_html__( 'Custom options for post', "alpha" ),
					esc_html__( 'Pre-Header', "alpha" ),
					esc_html__( 'Navigation Menu', "alpha" ),
					esc_html__( 'Footer', "alpha" ),
					esc_html__( 'Featured Media', "alpha" ),
					esc_html__( 'Post Media', "alpha" ),
					esc_html__( 'Sidebar Location', "alpha" ),
					esc_html__( 'Loop', "alpha" ),
					esc_html__( 'Grids', "alpha" ),
					),
				'at_error_page' => array(
					esc_html__( 'Custom options for AT Error Page', "alpha" ),
					esc_html__( 'Pre-Header', "alpha" ),
					esc_html__( 'Navigation Menu', "alpha" ),
					esc_html__( 'Footer', "alpha" ),
					esc_html__( 'Featured Media', "alpha" ),
					esc_html__( 'Sidebar Location', "alpha" ),
					esc_html__( 'Loop', "alpha" ),
					esc_html__( 'Grids', "alpha" ),
					),
				'at_folio' => array(
					esc_html__( 'Custom options for Folio', "alpha" ),
					esc_html__( 'Pre-Header', "alpha" ),
					esc_html__( 'Navigation Menu', "alpha" ),
					esc_html__( 'Footer', "alpha" ),
					esc_html__( 'Featured Media', "alpha" ),
					esc_html__( 'Loop', "alpha" ),
					esc_html__( 'Grids', "alpha" ),
					esc_html__( 'Pagination', "alpha" ),
					),
				'at_modal' => array(
					esc_html__( 'Custom options for Modal items', "alpha" ),
					esc_html__( 'Modal Animation Settings', "alpha" ),
					),
				/** for WooCommerce */
				'product' => array(
					esc_html__( 'Custom options for WooCommerce product page', "alpha" ),
					esc_html__( 'Pre-Header', "alpha" ),
					esc_html__( 'Navigation Menu', "alpha" ),
					esc_html__( 'Footer', "alpha" ),
					esc_html__( 'Featured Media', "alpha" ),
					esc_html__( 'Sidebar Location', "alpha" ),
					esc_html__( 'Grids', "alpha" ),
					),
				/** Featured Media */
				'at_featured_media_type' => array(
					esc_html__( 'Featured Media Type', "alpha" ),
					esc_html__( 'Sets featured media to either image or video.', "alpha" ),
					esc_html__( 'None', "alpha" ),
					esc_html__( 'Image', "alpha" ),
					esc_html__( 'Use Vimeo Video', "alpha" ),
					esc_html__( 'Use YouTube Video', "alpha" ),
					esc_html__( 'Use HATL5 Video', "alpha" ),
					),
				'at_featured_media_youtube' => array(
					esc_html__( 'Youtube Video ID', "alpha" ),
					''
					),
				'at_featured_media_vimeo' => array(
					esc_html__( 'Vimeo Video ID', "alpha" ),
					''
					),
				'at_featured_media_video_mp4' => array(
					esc_html__( 'Video File (mp4)', "alpha" ),
					'',
					esc_html__( 'Set video file', "alpha" ),
					),
				'at_featured_media_video_webm' => array(
					esc_html__( 'Video File (webm)', "alpha" ),
					'',
					esc_html__( 'Set video file', "alpha" ),
					),
				'at_featured_media_thumbnail' => array(
					esc_html__( 'Video Thumbnail', "alpha" ),
					'',
					esc_html__( 'Set video thumbnail image file', "alpha" ),
					),
				'at_featured_media_loop_video' => array(
					esc_html__( 'Loop Video', "alpha" ),
					'',
					esc_html__( 'Do not loop', "alpha" ),
					esc_html__( 'Loop', "alpha" ),
					),
				'at_featured_media_mute_video' => array(
					esc_html__( 'Mute Sound', "alpha" ),
					'',
					esc_html__( 'Mute', "alpha" ),
					esc_html__( 'Play sound', "alpha" ),
					),
				'at_featured_media_video_mode' => array(
					esc_html__( 'Video Format', "alpha" ),
					'',
					esc_html__( 'Regular (with controls)', "alpha" ),
					esc_html__( 'Background Video (no controls)', "alpha" ),
					),
				/** Page Head */
				'at_use_masthead_title_settings_of' => array(
					esc_html__( 'Custom Masthead Title', "alpha" ),
					esc_html__( 'Check if you want to use custom settings for the masthead title block. (optional)', "alpha" ),
					esc_html__( 'Use customiser settings', "alpha" ),
					esc_html__( 'Set masthead title options for this post', "alpha" ),
					esc_html__( 'Hide the masthead title', "alpha" ),
					),
				'at_masthead_height' => array(
					esc_html__( 'Post Media Height', "alpha" ),
					esc_html__( 'Media Height.', "alpha" ),
					esc_html__( 'Default (500px)', "alpha" ),
					esc_html__( 'Window Height', "alpha" ),
					esc_html__( 'Custom', "alpha" ),
					),
				'at_page_head_min_height' => array(
					esc_html__( 'Minimum Height', "alpha" ),
					esc_html__( 'Determines the height beyond which the slider will not scale.', "alpha" ),
					),
				'at_masthead_height_custom' => array(
					esc_html__( 'Custom Page Head Height', "alpha" ),
					'',
					),
				'at_page_head_title_animation' => array(
					esc_html__( 'Masthead Title Animation', "alpha" ),
					'',
					esc_html__( 'No animation effects', "alpha" ),
					esc_html__( 'Fade in', "alpha" ),
					esc_html__( 'Slide in from bottom short', "alpha" ),
					esc_html__( 'Slide in from right short', "alpha" ),
					esc_html__( 'Slide in from top short', "alpha" ),
					esc_html__( 'Slide in from left short', "alpha" ),
					esc_html__( 'Slide in from bottom long', "alpha" ),
					esc_html__( 'Slide in from right long', "alpha" ),
					esc_html__( 'Slide in from top long', "alpha" ),
					esc_html__( 'Slide in from left long', "alpha" ),
					esc_html__( 'Bounce in', "alpha" ),
					esc_html__( 'Bounce out', "alpha" ),
					esc_html__( 'Bounce in from bottom', "alpha" ),
					esc_html__( 'Bounce in from right', "alpha" ),
					esc_html__( 'Bounce in from top', "alpha" ),
					esc_html__( 'Bounce in from left', "alpha" ),
					esc_html__( 'Scale in', "alpha" ),
					esc_html__( 'Scale out', "alpha" ),
					esc_html__( 'Flip in X', "alpha" ),
					esc_html__( 'Flip in Y', "alpha" ),
					esc_html__( 'Spin in X', "alpha" ),
					esc_html__( 'Spin in Y', "alpha" ),
					esc_html__( 'Helicopter in', "alpha" ),
					esc_html__( 'Helicopter out', "alpha" ),
					esc_html__( 'Sign swing in from top', "alpha" ),
					esc_html__( 'Sign swing in from right', "alpha" ),
					esc_html__( 'Sign swing in from bottom', "alpha" ),
					esc_html__( 'Sign swing in from left', "alpha" ),
					esc_html__( 'Wiggle X', "alpha" ),
					esc_html__( 'Wiggle Y', "alpha" ),
					esc_html__( 'Drop in from bottom', "alpha" ),
					esc_html__( 'Drop in from top', "alpha" ),
					esc_html__( 'Roll in from left', "alpha" ),
					esc_html__( 'Roll in from right', "alpha" ),
					esc_html__( 'Turn in from right', "alpha" ),
					esc_html__( 'Turn in from left', "alpha" ),
					),
				'at_page_head_title_animation_duration' => array(
					esc_html__( 'Animation Duration', "alpha" ),
					esc_html__( 'How long the animation should be. Expressed in milliseconds i.e. 1000 represents 1 second.', "alpha" ),
					),
				'at_page_head_title_animation_delay' => array(
					esc_html__( 'Animation Delay', "alpha" ),
					esc_html__( 'How long before the animation should begin upon entering the viewport. Expressed in milliseconds i.e. 100 represents 0.1 second.', "alpha" ),
					),
				/** Sidebar */
				'at_use_sidebar' => array(
					esc_html__( 'Sidebar Location', "alpha" ),
					esc_html__( 'Determines whether the page template should have No sidebar, Sidebar to the left or Sidebar to the right.', "alpha" ),
					esc_html__( 'Use the Customiser setting', "alpha" ),
					esc_html__( 'Show sidebar on right', "alpha" ),
					esc_html__( 'Show sidebar on left', "alpha" ),
					esc_html__( 'Do not show sidebar', "alpha" ),
					),
				/** Post Media */
				'at_use_post_media' => array(
					esc_html__( 'Post Media', "alpha" ),
					esc_html__( 'Use post media.', "alpha" ),
					esc_html__( 'Do not use media', "alpha" ),
					esc_html__( 'Use Vimeo', "alpha" ),
					esc_html__( 'Use Youtube', "alpha" ),
					esc_html__( 'Use self hosted video', "alpha" ),
					esc_html__( 'Use self hosted audio', "alpha" ),
					),
				'at_media_height' => array(
					esc_html__( 'Post Media Height', "alpha" ),
					esc_html__( 'Media Height.', "alpha" ),
					esc_html__( 'Default (500px)', "alpha" ),
					esc_html__( 'Window Height', "alpha" ),
					esc_html__( 'Custom', "alpha" ),
					),
				'at_media_height_custom' => array(
					esc_html__( 'Custom Video Height', "alpha" ),
					esc_html__( 'Custom Video Height', "alpha" ),
					),
				'at_media_youtube' => array(
					esc_html__( 'Youtube Video ID', "alpha" ),
					esc_html__( 'Enter Youtube video ID', "alpha" ),
					),
				'at_media_vimeo' => array(
					esc_html__( 'Vimeo Video ID', "alpha" ),
					esc_html__( 'Enter Vimeo video ID', "alpha" ),
					),
				'at_media_video_mp4' => array(
					esc_html__( 'Video File (mp4)', "alpha" ),
					'',
					esc_html__( 'Set video file', "alpha" ),
					),
				'at_media_video_webm' => array(
					esc_html__( 'Video File (webm)', "alpha" ),
					'',
					esc_html__( 'Set video file', "alpha" ),
					),
				'at_media_thumbnail' => array(
					esc_html__( 'Video Thumbnail', "alpha" ),
					'',
					esc_html__( 'Set video thumbnail image file', "alpha" ),
					),
				'at_use_video_for_featured' => array(
					esc_html__( 'Use Video for Featured Media in Loop', "alpha" ),
					'',
					),
				/** Audio */
				'at_media_audio' => array(
					esc_html__( 'Audio File (mp3)', "alpha" ),
					'',
					esc_html__( 'Set audio file', "alpha" ),
					),
				'at_use_audio_for_featured' => array(
					esc_html__( 'Use Audio for Featured Media in Loop', "alpha" ),
					'',
					),
				/** Fields Loop */
				'at_hide_excerpt_in_loop' => array(
					esc_html__( 'Excerpt in loop', "alpha" ),
					esc_html__( 'Check this box to hide excerpt in loop (optional)', "alpha" ),
					),
				/** Grids */
				'at_grid_thumbnail' => array(
					esc_html__( 'Grid Thumbnail', "alpha" ),
					esc_html__( 'Upload a different image that will appear in the grid.', "alpha" ),
					esc_html__( 'Select grid thumbnail image', "alpha" ),
					),
				'at_grid_linked_item' => array(
					esc_html__( 'Link Grid Item To', "alpha" ),
					'',
					esc_html__( 'Post', "alpha" ),
					esc_html__( 'Lightbox', "alpha" ),
					esc_html__( 'Custom URL', "alpha" ),
					esc_html__( 'Not Linked', "alpha" ),
					),
				'at_grid_custom_url' => array(
					esc_html__( 'Custom URL', "alpha" ),
					''
					),
				'at_grid_lightbox_caption' => array(
					esc_html__( 'Lightbox Caption', "alpha" ),
					''
					),
				/**
				 * see at_grid item need to add an additional option to grid rollovers #39
				 *  - text_with_thumbnail_rollover added and labels for text_with_thumbnail has been changed
				 */
				'at_grid_box_type' => array(
					esc_html__( 'Grid Box Appearance', "alpha" ),
					esc_html__( 'Determines appearance of page/post in the grid', "alpha" ),
					esc_html__( 'Ignored if no Featured Media or grid thumbnail has been set', "alpha" ),
					esc_html__( 'Show thumb with project title & description below', "alpha" ),
					esc_html__( 'Show thumb with project title & description on rollover', "alpha" ),
					esc_html__( 'Show title & excerpt with solid background color', "alpha" ),
					esc_html__( 'Do not show in the grid', "alpha" ),
					),
				/**
				 * see at_grid item need to add an additional option to grid rollovers #39
				 */
				'at_grid_box_title' => array(
					esc_html__( 'Grid Box Title', "alpha" ),
					'',
					),
				/**
				 * see at_grid item need to add an additional option to grid rollovers #39
				 */
				'at_grid_box_description' => array(
					esc_html__( 'Grid Box Description', "alpha" ),
					'',
					),
				'at_grid_box_thumb_format' => array(
					esc_html__( 'Grid box thumbnail format and size', "alpha" ),
					esc_html__( 'Determines the format of the thumbnail in the grid', "alpha" ),
					esc_html__( 'Do not specify', "alpha" ),
					esc_html__( 'Large Landscape', "alpha" ),
					esc_html__( 'Portrait', "alpha" ),
					esc_html__( 'Large Portrait', "alpha" ),
					esc_html__( 'Wide', "alpha" ),
					),
				// Blog Creative Layout Options and Fixes #15
				'at_grid_box_content_vertical_alignment' => array(
					esc_html__( 'Grid Box Content Vertical Alignment', "alpha" ),
					'',
					esc_html__( 'Top', "alpha" ),
					esc_html__( 'Middle', "alpha" ),
					esc_html__( 'Bottom', "alpha" ),
					),
				'at_grid_box_content_horizontal_alignment' => array(
					esc_html__( 'Gird Box Content Horizontal Alignment', "alpha" ),
					'',
					esc_html__( 'Left', "alpha" ),
					esc_html__( 'Center', "alpha" ),
					esc_html__( 'Right', "alpha" ),
					),
				// Blog Creative Layout Options and Fixes #15 End
				'at_grid_box_text' => array(
					esc_html__( 'Grid Box Text', "alpha" ),
					''
					),
				/** Pagination (for at_folio) */
				'at_pagination_hide' => array(
					esc_html__( 'Hide Pagination', "alpha" ),
					esc_html__( 'Yes', "alpha" ),
					),
				/** Navigation Menu */
				'at_navigation_menu_deviate' => array(
					esc_html__( 'Change Navigation Appearance for this Page', "alpha" ),
					esc_html__( 'Check this box if you would like to alter the main navigation for this page/post only. Leave blank to default to Customiser settings.', "alpha" ),
					),
				'at_deviate_logo' => array(
					esc_html__( 'Logo', "alpha" ),
					esc_html__( 'Determines which logo to use for the header.', "alpha" ),
					esc_html__( 'User Customiser Setting', "alpha" ),
					esc_html__( 'Use Top Logo', "alpha" ),
					esc_html__( 'Use Body Logo', "alpha" ),
					),
				'at_navigation_menu_item_main_nav_menu' => array(
					esc_html__( 'Main Navigation Menu', "alpha" ),
					'',
					),
				'at_navigation_menu_item_overlay_menu' => array(
					esc_html__( 'Overlay Navigation Menu', "alpha" ),
					esc_html__( 'Sets the overlay navigation menu.', "alpha" ),
					),
				'at_navigation_menu_item_overlay_secondary_menu' => array(
					esc_html__( 'Overlay Secondary Navigation Menu', "alpha" ),
					esc_html__( 'Determines the secondary overlay menu alignment.', "alpha" ),
					),
				'at_navigation_menu_item_off_canvas_menu' => array(
					esc_html__( 'Off-Canvas Navigation Menu', "alpha" ),
					esc_html__( 'Sets the off-canvas navigation menu.', "alpha" ),
					),
				'at_navigation_menu_item_off_canvas_secondary_menu' => array(
					esc_html__( 'Off-Canvas Secondary Navigation Menu', "alpha" ),
					esc_html__( 'Determines the secondary off-canvas menu alignment.', "alpha" ),
					),
				'at_navigation_color_set' => array(
					esc_html__( 'Navigation Color Set', "alpha" ),
					'',
					esc_html__( 'Default', "alpha" ),
					esc_html__( 'Custom', "alpha" ),
					),
				/** Homepage with Posts Template Options */
				'at_hide_pagination' => array(
					esc_html__( 'Hide Pagination', "alpha" ),
					esc_html__( 'Determines whether to show the blog pagination.', "alpha" ),
					),
				'at_post_count' => array(
					esc_html__( 'Post Count', "alpha" ),
					esc_html__( 'Determines the number of posts to be shown.', "alpha" ),
					),
				/** AT Footer */
				'at_footer_type' => array(
					esc_html__( 'Footer Type', "alpha" ),
					esc_html__( 'Determines whether the footer should use the WordPress default widget space, or whether the footer should use a custom post type (layout created using Visual Composer).', "alpha" ),
					esc_html__( 'Use Customizer Settings', "alpha" ),
					esc_html__( 'Use Widget Space', "alpha" ),
					esc_html__( 'Use AT Footer', "alpha" ),
					esc_html__( 'Hide Footer', "alpha" ),
					),
				'at_footer_id_to_show' => array(
					esc_html__( 'AT Footer to show', "alpha" ),
					esc_html__( 'Determines which custom footer to use for this page.', "alpha" ),
					),
				'at_footer_column_number' => array(
					esc_html__( 'The number of columns in the footer', "alpha" ),
					esc_html__( 'Determines the number of columns the footer should have. Note: Our themes support 1-4 footer columns.', "alpha" ),
					esc_html__( '1 Column', "alpha" ),
					esc_html__( '2 Columns', "alpha" ),
					esc_html__( '3 Columns', "alpha" ),
					esc_html__( '4 Columns', "alpha" ),
					esc_html__( '5 Columns', "alpha" ),
					),
				'at_footer_column_align_1' => array(
					esc_html__( 'Column 1 Content Alignment', "alpha" ),
					'',
					esc_html__( 'Left', "alpha" ),
					esc_html__( 'Center', "alpha" ),
					esc_html__( 'Right', "alpha" ),
					),
				'at_footer_column_align_2' => array(
					esc_html__( 'Column 2 Content Alignment', "alpha" ),
					'',
					esc_html__( 'Left', "alpha" ),
					esc_html__( 'Center', "alpha" ),
					esc_html__( 'Right', "alpha" ),
					),
				'at_footer_column_align_3' => array(
					esc_html__( 'Column 3 Content Alignment', "alpha" ),
					'',
					esc_html__( 'Left', "alpha" ),
					esc_html__( 'Center', "alpha" ),
					esc_html__( 'Right', "alpha" ),
					),
				'at_footer_column_align_4' => array(
					esc_html__( 'Column 4 Content Alignment', "alpha" ),
					'',
					esc_html__( 'Left', "alpha" ),
					esc_html__( 'Center', "alpha" ),
					esc_html__( 'Right', "alpha" ),
					),
				'at_footer_column_align_5' => array(
					esc_html__( 'Column 5 Content Alignment', "alpha" ),
					'',
					esc_html__( 'Left', "alpha" ),
					esc_html__( 'Center', "alpha" ),
					esc_html__( 'Right', "alpha" ),
					),
				/** AT Modal */
				'at_modal_width' => array(
					esc_html__( 'Modal Width', "alpha" ),
					''
					),
				'at_modal_content_animation' => array(
					esc_html__( 'Modal Content Animation', "alpha" ),
					'',
					esc_html__( 'Fade', "alpha" ),
					esc_html__( 'Slide in top', "alpha" ),
					esc_html__( 'Slide in bottom', "alpha" ),
					esc_html__( 'Scale in', "alpha" ),
					esc_html__( 'Scale out', "alpha" ),
					),
				'at_modal_lightbox_overlay_animation' => array(
					esc_html__( 'Lightbox Overlay Animation', "alpha" ),
					'',
					esc_html__( 'Fade', "alpha" ),
					esc_html__( 'Slide in top', "alpha" ),
					esc_html__( 'Slide in right', "alpha" ),
					esc_html__( 'Slide in bottom', "alpha" ),
					esc_html__( 'Slide in left', "alpha" ),
					),
				/** tm modal add a few options to Custom options for modal items #69 */
				'at_modal_header' => array(
					esc_html__( 'Add Modal Header', "alpha" ),
					''
					),
				// at_modal custom post type add an option for rounded corners for lightbox #74
				'at_modal_border_style' => array(
					esc_html__( 'Modal Border Style', "alpha" ),
					'',
					esc_html__( 'None', "alpha" ),
					esc_html__( 'Rounded', "alpha" ),
				),
				'at_modal_header_title' => array(
					esc_html__( 'Modal Header Title', "alpha" ),
					''
					),
				'at_modal_header_background_color' => array(
					esc_html__( 'Modal Header Background Color', "alpha" ),
					''
					),
				'at_modal_header_title_color' => array(
					esc_html__( 'Modal Header Title Color', "alpha" ),
					''
					),
				'at_modal_close_button_color' => array(
					esc_html__( 'Modal Close Button Color', "alpha" ),
					''
				),
				'at_modal_custom_classes' => array(
					esc_html__( 'Modal Custom Classes', "alpha" ),
					''
					),
				/* #69 end */
				'at_modal_auto_launch' => array(
					esc_html__( 'Auto Launch Modal', "alpha" ),
					'',
					),
				'at_modal_auto_launch_delay' => array(
					esc_html__( 'Modal Auto Launch Delay', "alpha" ),
					esc_html__( 'Determines the delay before the modal is launched upon page load. Expressed in milliseconds i.e. 5000, represents 5 seconds.', "alpha" ),
					),
				'at_modal_auto_close' => array(
					esc_html__( 'Auto Close Modal', "alpha" ),
					esc_html__( 'This option will only work if you have added a Contact Form to the modal. If checked, the modal will auto close upon form success.', "alpha" ),
					),
				'at_modal_auto_launch_cookie' => array(
					esc_html__( 'Set Cookie', "alpha" ),
					esc_html__( 'Sets a cookies so that the modal only autolaunches a single time. This is useful if you create a autolaunching signup using a modal.', "alpha" ),
					),
				);
		}

		/**
		 * End
		 */
	}
}
