<?php
namespace Alpha {


	if (locate_template('assets/class/Alpha-AT_ClassLoader.php', TRUE, TRUE)) {
		new AT_ClassLoader("alpha",array('inc/class/','assets/class/'));

	} else {
		trigger_error(esc_html__('AT_ClassLoader is required.', "Alpha"), E_USER_ERROR);
	}

	if (!class_exists('AT_ThemeStrings')) {
			new AT_ThemeStrings();
	}

	if (!class_exists('AT_AlphaThemes')) {
		/** The TM_ThemeMountain class requires $theme_id, $required_tmplugin_version, $required_tmcommerce_version (optional) and $required_oneclick_version (optional) to be passed as argument */
		new AT_AlphaThemes(AT_ThemeStrings::$theme_id,'1.1.20','1.1.7','1.4');
	}
}