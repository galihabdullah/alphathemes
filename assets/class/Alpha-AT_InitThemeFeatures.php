<?php
namespace Alpha {

	Class AT_InitThemeFeatures extends AT_AlphaThemes{

		public function __construct(){
			if ( ! isset ( $content_width ) ) $content_width = 900;

			add_action('after_setup_theme', ['Alpha\\AT_InitThemeFeatures', 'alpha_after_setup']);
			add_action('widgets_init', ['Alpha\\AT_InitThemeFeatures', 'alpha_widget_init']);

		}

		public static function alpha_widget_init(){
				for($i=1; $i <= 2; $i++)
				{
						register_sidebar(array(
							'name' 			=> __('Footer','mfn-opts') .' | #'.$i,
							'id' 			=> 'footer-area-'.$i,
							'description'	=> __('Appears in the Footer section of the site.','betheme'),
							'before_widget' => '<div class="col_one_third">',
							'after_widget' 	=> '</div>',
							'before_title' 	=> '<h4>',
							'after_title' 	=> '</h4>',
						));
				}
				register_sidebar(array(
					'name' 			=> __('Footer 3','mfn-opts'),
					'id' 			=> 'footer-area-3',
					'description'	=> __('Appears in the Footer section of the site.','betheme'),
					'before_widget' => '<div class="col_one_third col_last">',
					'after_widget' 	=> '</div>',
					'before_title' 	=> '<h4>',
					'after_title' 	=> '</h4>',
				));

		}

		public static function alpha_after_setup(){
						/*
			 * Make theme available for translation.
			 * Translations can be filed in the /languages/ directory.
			 * If you're building a theme based on alpha, use a find and replace
			 * to change 'alpha' to the name of your theme in all the template files.
			 */
			load_theme_textdomain( 'alpha', get_template_directory() . '/languages' );

			// Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );

			/*
			 * Let WordPress manage the document title.
			 * By adding theme support, we declare that this theme does not use a
			 * hard-coded <title> tag in the document head, and expect WordPress to
			 * provide it for us.
			 */
			add_theme_support( 'title-tag' );

			/*
			 * Enable support for Post Thumbnails on posts and pages.
			 *
			 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
			 */
			add_theme_support( 'post-thumbnails' );

			// This theme uses wp_nav_menu() in one location.
			register_nav_menus( array(
				'primary-menu' => esc_html__( 'Primary', 'alpha' ),
			) );

			/*
			 * Switch default core markup for search form, comment form, and comments
			 * to output valid HTML5.
			 */
			add_theme_support( 'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			) );

			// Set up the WordPress core custom background feature.
			add_theme_support( 'custom-background', apply_filters( 'alpha_custom_background_args', array(
				'default-color' => 'ffffff',
				'default-image' => '',
			) ) );

			// Add theme support for selective refresh for widgets.
			add_theme_support( 'customize-selective-refresh-widgets' );

			/**
			 * Add support for core custom logo.
			 *
			 * @link https://codex.wordpress.org/Theme_Logo
			 */
		}
	}
}