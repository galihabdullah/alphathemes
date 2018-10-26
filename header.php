<?php

namespace Alpha;
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package alpha
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class('stretched'); ?>>
<div id="wrapper" class="clearfix">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'alpha' ); ?></a>

	<header id="header">
		<div id="header-wrap">
			<div class="container clearfix">
				<div id="primary-menu-trigger"><i class="icon-reorder"></i></div>
					<!-- Logo
					============================================= -->
					<div id="logo">
						<a href="index.html" class="standard-logo"><img src="<?php echo get_theme_mod('at_logo')?>"></a>
						<a href="index.html" class="retina-logo"><img src="<?php echo get_theme_mod('at_retina_logo');?>" alt="Canvas Logo"></a>
					</div><!-- #logo end -->
			<?php AT_MegaMenu::at_wp_nav_menu()?>
	</div><!-- .site-branding -->
</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">