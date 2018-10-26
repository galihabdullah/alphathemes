<?php


/**
 * Custom Frontend Main Menu Walker
 */
class AT_MegaMenuFrontEnd extends Walker_Nav_Menu {

	// columns
	var $columns		= 0;
	var $max_columns	= 0;

	// rows
	var $rows			= 1;
	var $aRows			= array();

	// mega menu
	var $has_megamenu	= 0;
	var $bg_megamenu	= '';
    
	/**
	 * @see Walker::start_lvl()
	 */        
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);

		if($this->has_megamenu)
		{
			if($depth === 0)
			{
				$output .= "\n<div class=\"mega-menu-content style-2 clearfix\">\n";
			}
			if($depth === 1)
			{
				$output .= "\n<ul>\n";	
			}
		}

	}
    
	/**
	 * @see Walker::end_lvl()
	 */
		function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		
		if( $depth === 0 )
		{
			if( $this->has_megamenu )
			{
				// mega menu background image
				if( $this->bg_megamenu ){

					$class	= ' mfn-megamenu-bg';
					$style	= ' style="background-image:url('. $this->bg_megamenu .');"';
					
					$output	= str_replace("{tag_ul_class}", " mfn-megamenu mfn-megamenu-".$this->max_columns . $class, $output);
					$output	= str_replace("{tag_ul_style}", $style, $output);
					$output .= "$indent\n";	
					
				} else {

					$output = str_replace("{tag_ul_class}", " mfn-megamenu mfn-megamenu-".$this->max_columns, $output);
					$output = str_replace("{tag_ul_style}", "", $output);
					$output .= "$indent\n";
					
				}

				foreach($this->aRows as $row => $columns){
					$output = str_replace("{tag_li_class_".$row."}", "mfn-megamenu-cols-".$columns, $output);
				}
					
				$this->columns		= 0;
				$this->max_columns	= 0;
				$this->aRows		= array();
			} 
			else
			{
				$output = str_replace("{tag_ul_class}", "", $output);
				$output = str_replace("{tag_ul_style}", "", $output);
				$output .= "$indent</ul>\n";
			}
		}
		if($this->has_megamenu && $depth === 1)
		{
			$output .= "</ul>";
		}
		if($this->has_megamenu && $depth === 0)
		{
			$output .= "</div>";
		}
	}    

	/**
	 * @see Walker::start_el()
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {   
		global $wp_query;

		$item_output = $li_text_block_class = $column_class = "";

		if( $depth === 0 ){ 
			 
			// 1st level --------------------------------------------
			
			$this->has_megamenu	= get_post_meta( $item->ID, 'menu-item-mfn-megamenu', true);
			$this->bg_megamenu	= get_post_meta( $item->ID, 'menu-item-mfn-bg', true);

			if($this->has_megamenu)
			{
				$column_class = " mega-menu";
			}
		}
           
		if( $depth === 1 && $this->has_megamenu ){
			
     		// 2nd level Mega Menu ----------------------------------
     		
			$this->columns ++;
			$this->aRows[$this->rows] = $this->columns;
			
			if($this->max_columns < $this->columns) $this->max_columns = $this->columns;

			if( $item->title != "-" )
			{
				$title = apply_filters( 'the_title', $item->title, $item->ID );
				
				$attributes  = ! empty( $item->attr_title ) ? ' title="'. esc_attr( $item->attr_title ) .'"' : '';
                $attributes .= ! empty( $item->target )     ? ' target="'. esc_attr( $item->target ) .'"' : '';
                $attributes .= ! empty( $item->xfn )        ? ' rel="'. esc_attr( $item->xfn ) .'"' : '';
                $attributes .= ! empty( $item->url )        ? ' href="'. esc_attr( $item->url ) .'"' : '';       
                
				$item_output .= $args->before;
					$item_output .= '<a class=""'. $attributes .'>';
						$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
					$item_output .= '</a>';
				$item_output .= $args->after;
			}
                
			$column_class = " mega-menu-title";
			$output .= "\n<ul class=\"mega-menu-column col-5\">\n";
			
		} else {
			
			// 1-3 level, except Mega Menu 2nd level ----------------
			
				$attributes  = ! empty( $item->attr_title ) ? ' title="'. esc_attr( $item->attr_title ) .'"' : '';
                $attributes .= ! empty( $item->target )     ? ' target="'. esc_attr( $item->target ) .'"' : '';
                $attributes .= ! empty( $item->xfn )        ? ' rel="'. esc_attr( $item->xfn ) .'"' : '';
                $attributes .= ! empty( $item->url )        ? ' href="'. esc_attr( $item->url ) .'"' : '';   
			
			$item_output .= $args->before;
				$item_output .= '<a'. $attributes .'>';
					$description =  trim($item->description) ? '<span class="description">'. $item->description .'</span>' : false;
					$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $description . $args->link_after;
				$item_output .= '</a>';
			$item_output .= $args->after;
			
		}
		
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = '';
		
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		
		
		// Active | for post types parents

		// Active | Blog
		if( get_post_type( get_the_ID() ) == 'post' ){
			if( $item->object_id == get_option('page_for_posts') ){
				$classes[] = 'current-menu-item';
			}
		}
		
		// Active | Portfolio
		if( get_post_type( get_the_ID() ) == 'portfolio' ){
			if( $item->object_id == mfn_opts_get( 'portfolio-page' ) ){
				$classes[] = 'current-menu-item';
			}
		}
		
		// Active | Shop
		if( get_post_type( get_the_ID() ) == 'product' ){	
			if( function_exists( 'is_woocommerce' ) && is_woocommerce() ){
				
				if( version_compare( WC_VERSION, '2.7', '<' ) ){
					$shop_page_id = woocommerce_get_page_id( 'shop' );
				} else {
					$shop_page_id = wc_get_page_id( 'shop' );
				}
					
				if( $item->object_id == $shop_page_id ){
					$classes[] = 'current-menu-item';
				}
				
			}
		}

		
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="'. $li_text_block_class . esc_attr( $class_names ) . $column_class.'"';
		
		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		if($depth === 1 && $this->has_megamenu)
		{
			$output .= "</li>{$n}</ul>";
		}
		else
		{
			$output .= "</li>{$n}";
		}
		
	}

}