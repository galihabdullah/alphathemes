<?php

namespace Alpha {

	class AT_Customizer extends AT_AlphaThemes{

		public function __construct(){
			add_action('customize_register', ['Alpha\\AT_Customizer', 'at_logo_theme']);
		}

		public static function at_logo_theme($wp_customize){

			$wp_customize->add_setting('at_logo');
			$wp_customize->add_control(new \WP_Customize_Image_Control($wp_customize, 'at_logo', array(
				'label' 		=> 'Logo',
				'section'		=> 'title_tagline',
				'settings'		=> 'at_logo',
				'priority'		=> '7'

			)));

			$wp_customize->add_setting('at_retina_logo');
			$wp_customize->add_control(new \WP_Customize_Image_Control($wp_customize, 'at_retina_logo', array(
				'label'		=> 'Retina Logo',
				'section'	=> 'title_tagline',
				'settings'	=> 'at_retina_logo',
				'priority'	=> '7'

			)));
		}
	}
}