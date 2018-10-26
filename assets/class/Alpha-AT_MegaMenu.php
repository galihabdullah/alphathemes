<?php

namespace Alpha {

	class AT_MegaMenu extends AT_AlphaThemes{

		public function __construct(){

			// Custom Fields - Add
			add_filter( 'wp_setup_nav_menu_item', array( $this, 'at_setup_nav_menu_item'));
		
			// Custom Fields - Save
			add_action( 'wp_update_nav_menu_item', array( $this, 'at_update_nav_menu_item'), 100, 3 );

			// Custom Walker - Edit
			add_filter( 'wp_edit_nav_menu_walker',  array( $this, 'at_edit_nav_menu_walker'), 100, 2 );
			
			remove_filter('nav_menu_description', 'strip_tags');

			add_filter( 'wp_setup_nav_menu_item', ['Alpha\\AT_MegaMenu', 'at_wp_setup_nav_menu_item'] );

			add_filter( 'wp_nav_menu',['Alpha\\AT_MegaMenu','search_cart'], 10, 2 );

		}

				/* ---------------------------------------------------------------------------
		 * Custom Fields - Add
		 * --------------------------------------------------------------------------- */
		public static function at_setup_nav_menu_item( $menu_item ) {
			$menu_item->megamenu	= get_post_meta( $menu_item->ID, 'menu-item-at-megamenu', true );
			$menu_item->bg 			= get_post_meta( $menu_item->ID, 'menu-item-at-bg', true );
			return $menu_item;
		}
		
		/* ---------------------------------------------------------------------------
		 * Custom Fields - Save
		 * --------------------------------------------------------------------------- */
		public static function at_update_nav_menu_item( $menu_id, $menu_item_db_id, $menu_item_data ) {
			
			// mega menu
			if ( ! isset( $_REQUEST['edit-menu-item-megamenu'][$menu_item_db_id]) ) {
				$_REQUEST['edit-menu-item-megamenu'][$menu_item_db_id] = '';
			}
			$megamenu = $_REQUEST['edit-menu-item-megamenu'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, 'menu-item-at-megamenu', $megamenu );
			
			// background
			if ( ! isset( $_REQUEST['edit-menu-item-bg'][$menu_item_db_id]) ) {
				$_REQUEST['edit-menu-item-bg'][$menu_item_db_id] = '';
			}
			$bg = $_REQUEST['edit-menu-item-bg'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, 'menu-item-at-bg', $bg );
		}

		/* ---------------------------------------------------------------------------
		 * Custom Backend Walker - Edit
		 * --------------------------------------------------------------------------- */
		public static function at_edit_nav_menu_walker($walker,$menu_id) {
			return 'AT_MegaMenuBackEnd';
		}

		public static function at_wp_setup_nav_menu_item($menu_item){
			$menu_item->description = apply_filters('nav_menu_description', $menu_item->post_content);
			return $menu_item;		
		}

		public static function at_wp_nav_menu(){
			$args = array(
				'container'		=> false,
				'link_before'	=> '<div>',
				'link_after'	=> '</div>',
				'depth'			=> '0',
				'walker'		=> new \AT_MegaMenuFrontEnd,
				'theme_location' => 'primary-menu',
			);

			echo '<nav id="primary-menu" class="sub-title">';

				wp_nav_menu($args);
			echo '</nav>';
		}

		public static function search_cart($items, $args)
		{

			$items .=	"<div id=\"top-cart\">
									<a href=\"#\" id=\"top-cart-trigger\"><i class=\"icon-shopping-cart\"></i><span>5</span></a>
									<div class=\"top-cart-content\">
										<div class=\"top-cart-title\">
											<h4>Shopping Cart</h4>
										</div>
										<div class=\"top-cart-items\">
											<div class=\"top-cart-item clearfix\">
												<div class=\"top-cart-item-image\">
													<a href=\"#\"><img src=\"images/shop/small/1.jpg\" alt=\"Blue Round-Neck Tshirt\" /></a>
												</div>
												<div class=\"top-cart-item-desc\">
													<a href=\"#\">Blue Round-Neck Tshirt</a>
													<span class=\"top-cart-item-price\">$19.99</span>
													<span class=\"top-cart-item-quantity\">x 2</span>
												</div>
											</div>
											<div class=\"top-cart-item clearfix\">
												<div class=\"top-cart-item-image\">
													<a href=\"#\"><img src=\"images/shop/small/6.jpg\" alt=\"Light Blue Denim Dress\" /></a>
												</div>
												<div class=\"top-cart-item-desc\">
													<a href=\"#\">Light Blue Denim Dress</a>
													<span class=\"top-cart-item-price\">$24.99</span>
													<span class=\"top-cart-item-quantity\">x 3</span>
												</div>
											</div>
										</div>
										<div class=\"top-cart-action clearfix\">
											<span class=\"fleft top-checkout-price\">$114.95</span>
											<button class=\"button button-3d button-small nomargin fright\">View Cart</button>
										</div>
									</div>
								</div>
								<div id=\"top-search\">
									<a href=\"#\" id=\"top-search-trigger\"><i class=\"icon-search3\"></i><i class=\"icon-line-cross\"></i></a>
									<form action=\"search.html\" method=\"get\">
										<input type=\"text\" name=\"q\" class=\"form-control\" value='' placeholder=\"Type &amp; Hit Enter..\">
									</form>
								</div>";
			return $items;
		}
	}
}