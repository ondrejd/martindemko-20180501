<?php
/**
 * WordPress theme "martindemko-20180501" based on Twentyseventeen theme.
 * 
 * Copyright (C) 2018 Ondřej Doněk
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Ondřej Doněk <ondrejd@gmail.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License 3.0
 * @link https://github.com/ondrejd/martindemko-20180501 for the canonical source repository
 * @package martindemko-20180501
 * @since 1.0.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'martindemko' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="row justify-content-md-center">
			<div class="col-5 col-lg-4">
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			</div>
			<div class="col-5 col-lg-4 site-product-order-button-cont">
				<span class="btn btn-primary site-product-order-button">
					<?php esc_html_e( 'Objednat PRODUKT', 'martindemko' ) ?>
				</span>
			</div>
		</div>
	</header><!-- #masthead -->

    <div class="site-product">
        <?php
            /**
             * @todo Toto zatím nechávám takto, pak buď přes nastavení 
             *       pluginu nebo meta hodnotu u `md-products`
             */
            $default_product_ID = 18;//[4|18]
            $default_product = get_post( $default_product_ID, OBJECT, 'display' );
        ?>
        <div class="row justify-content-md-center">
            <div class="col-5 col-sm-6 col-lg-4">
            	<div class="post-thumbnail">
		            <a href="<?php the_permalink(); ?>">
                    	<?php if ( '' !== get_the_post_thumbnail( $default_product_ID ) ) : ?>
			            <?php echo get_the_post_thumbnail( $default_product_ID, 'martindemko-default-product' ); ?>
                        <?php else: ?>
                        <span class="no-post-thumbnail"></span>
                    	<?php endif; ?>
		            </a>
	            </div><!-- .post-thumbnail -->
            </div>
            <div class="col-5 col-sm-4 col-lg-4">
                <h2 class="entry-title">
                    <?php echo esc_html( $default_product->post_title ); ?>
                </h2>
                <div class="entry-content">
                    <p><?php echo esc_html( $default_product->post_excerpt ); ?></p>
                </div>
                <div class="entry-footer">
                    <p>
                        <span class="btn btn-primary site-product-order-button">
					        <?php esc_html_e( 'Objednat PRODUKT', 'martindemko' ) ?>
				        </span>
                    </p>
                </div>
            </div>
        </div>
        <div class="site-product-logos">
            <div class="row justify-content-md-center">
                <div class="col-3 site-product-logo site-product-logo-1">
                    <a href="#">
                        <img alt="logo 1" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/service-mark.png'; ?>">
                    </a>
                </div>
                <div class="col-3 site-product-logo site-product-logo-2">
                    <a href="#">
                        <img alt="logo 2" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/service-mark.png'; ?>">
                    </a>
                </div>
                <div class="col-3 site-product-logo site-product-logo-3">
                    <a href="#">
                        <img alt="logo 3" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/service-mark.png'; ?>">
                    </a>
                </div>
            </div>
        </div><!-- .site-product-logos -->
    </div><!-- .site-product -->

	<div class="site-content-contain">
		<div id="content" class="site-content">
