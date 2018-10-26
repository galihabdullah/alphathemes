<?php
namespace Alpha {
	/**
	 * Class Loader for WordPress Modified by ThemeMountain
	 *
	 * Notes: For classes in a namespace, names of php files need to use hyphen ( - ) where it uses back slash (\)
	 *
	 * @author ThemeMountain
	 * @author noto
	 */
	class AT_ClassLoader {
		/**
		 * Properties
		 */
		/**
		 * variable for storing directories in array
		 */
		private static $dirs = array();

		/**
		 *
		 * Constructor
		 */
		public function __construct($theme_id, $classDir) {
			spl_autoload_register('Alpha\AT_ClassLoader::loader');
			self::registerDir($classDir);
		}


		/**
		 *
		 * Register directories
		 * @param string $dir
		 */
		public function registerDir($dir){
			if( is_array($dir) ) {
				array_splice( self::$dirs, count(self::$dirs), 0, $dir );
			} else {
				array_push(self::$dirs, $dir);
			}
		}


		/**
		 *
		 * Callback
		 * @param string $classname
		 */
		public function loader($classname){
			if(strpos($classname , "\\") !== FALSE  ) {
				$classname = str_replace("\\","-",$classname);
			}
			// } else {
			// 	return;
			// }
			foreach (self::$dirs as $dir) {
				$file = $dir . '/' . $classname;
				if(locate_template($file.'.php') !== '' ){
					get_template_part ($file);
					return;
				}
			}
		}
	}
}