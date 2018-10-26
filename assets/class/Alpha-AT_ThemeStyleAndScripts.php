<?php

namespace Alpha {

	class AT_ThemeStyleAndScripts extends AT_AlphaThemes{

		public function __construct(){

			add_action('wp_enqueue_scripts', ['Alpha\\AT_ThemeStyleAndScripts', 'enqueue_style_script']);
		}


		public static function style_directory(){
			$style_directory = get_template_directory_uri() . '/assets/css';
			return $style_directory;
		}

		public static function scripts_directory(){
			$scripts_directory = get_template_directory_uri() . '/assets/js';
			return $scripts_directory;
		}

		public static function enqueue_style_script(){
			wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Raleway:300,400,500,600,700|Crete+Round:400i');
			wp_enqueue_style( 'alpha-style', get_stylesheet_uri() );
			wp_enqueue_style('bootstrap', self::style_directory().'/bootstrap.css');
			wp_enqueue_style('swiper', self::style_directory().'/swiper.css');
			wp_enqueue_style('dark', self::style_directory().'/dark.css');
			wp_enqueue_style('font-icons', self::style_directory().'/font-icons.css');
			wp_enqueue_style('animate', self::style_directory().'/animate.css');
			wp_enqueue_style('magnific-popup', self::style_directory().'/magnific-popup.css');
			wp_enqueue_style('responsive', self::style_directory().'/responsive.css');


			wp_enqueue_script( 'alpha-navigation', self::scripts_directory() . '/navigation.js', array(), '20151215', true );
			wp_enqueue_script('jquery', self::scripts_directory().'/jquery.js', array(),true,true);
			wp_enqueue_script('plugins', self::scripts_directory().'/plugins.js', array(),false, true);
			wp_enqueue_script('functions', self::scripts_directory().'/functions.js', array(),false, true);

			wp_enqueue_script( 'alpha-skip-link-focus-fix', self::scripts_directory() . '/skip-link-focus-fix.js', array(), '20151215', true );

			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}

	}
}