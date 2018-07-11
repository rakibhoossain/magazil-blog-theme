<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package magazil
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'magazil' ); ?></a>
		<header class="magazil-header">
			<div class="header-top">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-6 header-top-left no-padding">
						<?php
						wp_nav_menu( array(
							'theme_location'    => 'social',
							'menu_class'        => 'social-menu',
							'container'         => false,
							'depth'          => 1,
							'link_before'    => '<span class="screen-reader-text">',
							'link_after'     => '</span><i class="fa fa-chain"></i>',
						) );
						?>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-6 header-top-right no-padding">
							<ul>
								<li>
									<a href="tel:+440 012 3654 896">
										<span class="lnr lnr-phone-handset"></span>
										<span class="site-phone"><?php echo get_theme_mod( 'magazil_phone', '+8801776217594' ); ?></span>
									</a>
								</li>
								<li>
									<a href="mailto:support@colorlib.com">
										<span class="lnr lnr-envelope"></span>
										<span  class="site-email"><?php echo get_theme_mod( 'magazil_email', 'serakib@gmail.com' ); ?></span>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="logo-wrap">
				<div class="container">
					<div class="row justify-content-between align-items-center">
						<div class="col-lg-4 col-md-4 col-sm-12 logo-left no-padding">
						<?php 
							if ( has_custom_logo() ) {
								the_custom_logo();
							} else {
								echo '<h1>'. get_bloginfo( 'name' ) .'</h1>';
							}
						?>
						</div>

				<?php
				$magazil_show_banner = get_theme_mod( 'magazil_show_banner_on_homepage', true );
				 if ( $magazil_show_banner ): ?>
                    <div class="col-lg-8 col-md-8 col-sm-12 logo-right no-padding header-banner ads-banner">
						<?php
						$banner = get_theme_mod( 'magazil_banner_type', 'image' );
						get_template_part( 'template-parts/banner/banner', $banner );
						?>
                    </div>
				<?php endif; ?>

					</div>
				</div>
			</div>
			<div class="container main-menu" id="main-menu">
				<div class="row align-items-center justify-content-between">
					<nav id="nav-menu-container">
					<?php
					wp_nav_menu( array(
						'theme_location'    => 'primary',
						'menu_class'        => 'nav-menu',
						'container'         => false,
					) );
					?>
					</nav><!-- #nav-menu-container -->

					 <div class="navbar-right">

					 	<div class="Search">
					 		<input type="text" class="form-control Search-box" name="search" id="search" autocomplete="off" placeholder="<?php _e( 'Search....', 'magazil' );?>">
					 		<label for="Search-box" class="Search-box-label" id="search-open">
					 			<span class="lnr lnr-magnifier"></span>
					 		</label>
					 		<span class="Search-close" id="search-close">
					 			<span class="lnr lnr-cross"></span>
					 		</span>
					 		<div id="datafetch"></div>
					 	</div>
					 	
					</div>
				</div>
			</div>
		</header>

	<div id="content" class="site-content">
