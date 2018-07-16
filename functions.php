<?php
/**
 * Theme "Single Product" for WordPress.
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
 * @link https://github.com/ondrejd/singleproduct for the canonical source repository
 * @package singleproduct
 * @since 1.0.0
 */

if( ! defined( 'ABSPATH' ) ) {
    exit;
}


// Includes
include( dirname( __FILE__ ) . '/inc/class-md_products.php' );
include( dirname( __FILE__ ) . '/inc/class-md_navwalker.php' );
include( dirname( __FILE__ ) . '/inc/class-md_customize.php' );
include( dirname( __FILE__ ) . '/inc/template-tags.php' );


if( !function_exists( 'singleproduct_after_setup_theme' ) ) :
    /**
     * Setup theme.
     * @return void
     * @since 1.0.0
     * @uses add_option()
     * @uses add_image_size()
     * @uses add_theme_support()
     * @uses get_stylesheet_directory()
     * @uses load_theme_textdomain()
     * @uses register_nav_menus()
     * @uses update_option()
     */
    function singleproduct_setup_theme() {
        load_theme_textdomain( 'singleproduct', get_stylesheet_directory() . '/languages' );

        add_option( 'site_product_id', 'yes' );
        add_option( 'show_product_logos', 'yes' );
        add_option( 'product_logo_img_1', 0 );
        add_option( 'product_logo_url_1', '#' );
        add_option( 'product_logo_img_2', 0 );
        add_option( 'product_logo_url_2', '#' );
        add_option( 'product_logo_img_3', 0 );
        add_option( 'product_logo_url_3', '#' );
        add_option( 'product_order_btn_text', __( 'Objednat PRODUKT', 'singleproduct' ) );
        add_option( 'product_order_btn_link', __( '#', 'singleproduct' ) );
        add_option( 'header_foreground_color', '#000000' );
        add_option( 'header_background_color', '#ecd9d9' );
        add_option( 'ordersteps_show', 'yes' );
        add_option( 'ordersteps_foreground_color', '#98a0a6' );
        add_option( 'ordersteps_background_color_1', '#ecd9d9' );
        add_option( 'ordersteps_background_color_2', '#ffffff' );
        add_option( 'ordersteps_text_1', __( 'Klikněte na "Objednat PRODUKT"', 'singleproduct' ) );
        add_option( 'ordersteps_text_2', __( 'Vyplňte formulář', 'singleproduct' ) );
        add_option( 'ordersteps_text_3', __( 'Počkejte, až Vám zavoláme', 'singleproduct' ) );
        add_option( 'homepage_post_excerpts_show', 'yes' );
        add_option( 'footer_foreground_color', '#ffffff' );
        add_option( 'footer_background_color', '#2f1b1b' );
        add_option( 'homepage_show_posts_pagination', 'yes' );
        add_option( 'bootstrap_theme_option', '---' );
        add_option( 'bootstrap_typography', '---' );
        add_option( 'show_post_navigation', 'yes' );

        update_option( 'posts_per_page', 6 );

        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support(
            'html5', array(
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            )
        );

        add_image_size( 'martindemko-featured-image', 2000, 1200, true );
        add_image_size( 'martindemko-featured-image-small', 400, 200, true );
        add_image_size( 'martindemko-default-product', 400, 340, true );
        add_image_size( 'martindemko-thumbnail-avatar', 100, 100, true );

        register_nav_menus( array(
            'footer-languages-menu' => __( 'Jazykové menu', 'singleproduct' ),
            'footer-contact-menu'   => __( 'Kontaktní menu', 'singleproduct' )
        ) );

        // TODO We need support `starter-content` with example logo image
        add_theme_support( 'starter-content', array(
	        'widgets'     => array(),
	        'posts'       => array(),
	        'attachments' => array(),
	        'options'     => array(
		        'show_on_front'  => 'posts',
	        ),
	        'theme_mods'  => array(),
	        'nav_menus'   => array(
		        'footer-languages-menu' => array(
			        'name'  => __( 'Jazykové menu', 'singleproduct' ),
			        'items' => array(),
		        ),
		        'footer-contact-menu' => array(
			        'name'  => __( 'Kontaktní menu', 'singleproduct' ),
			        'items' => array(),
		        ),
	        ),
        ) );

        add_theme_support( 'customize-selective-refresh-widgets' );
    }
endif;
// Setup up theme
add_action( 'after_setup_theme', 'singleproduct_setup_theme' );


if( !function_exists( 'singleproduct_enqueue_styles' ) ) :
    /**
     * Register new custom post type.
     * @return void
     * @since 1.0.0
     * @uses get_option()
     * @uses get_stylesheet_directory_uri()
     * @uses wp_enqueue_script()
     * @uses wp_enqueue_style()
     * @uses wp_get_theme()
     * @uses wp_register_script()
     */
    function singleproduct_enqueue_styles() {

        $stylesheet_dir_uri = get_stylesheet_directory_uri();
        $theme_version = wp_get_theme()->get( 'Version' );

        // Bootstrap JS includes
        wp_register_script( 'singleproduct-html5', $stylesheet_dir_uri . '/assets/js/html5.js' );
        wp_register_script( 'singleproduct-popper', $stylesheet_dir_uri . '/assets/js/popper.min.js' );
        wp_register_script( 'singleproduct-bootstrap', $stylesheet_dir_uri . '/assets/js/bootstrap.bundle.min.js' );
        wp_register_script( 'singleproduct-fontawesome', $stylesheet_dir_uri . '/assets/js/fontawesome/fontawesome-all.min.js' );

        // Our main script
        wp_register_script(
            'singleproduct-script', 
            $stylesheet_dir_uri . '/assets/js/theme-script.js',
            // TODO Check what is really needed!
            array(
                'jquery', 'jquery-color', 'jquery-form',
                'jquery-masonry', 'jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-mouse',
                'jquery-ui-sortable', 'jquery-ui-draggable', 'jquery-ui-droppable',
                'jquery-ui-droppable', 'jquery-ui-selectable', 'jquery-ui-position',
                'jquery-ui-tooltip', 'jquery-ui-dialog', 'jquery-ui-button', 'jquery-ui-datepicker', 
                'jquery-effects-core', 'jquery-effects-fade', 'jquery-effects-highlight',
                'jquery-effects-slide', 'jquery-effects-transfer', 'singleproduct-html5',
                'singleproduct-popper', 'singleproduct-bootstrap', 'singleproduct-fontawesome'
            ),
            $theme_version,
            true
        );
        wp_enqueue_script( 'singleproduct-script' );

        // Bootstrap style basics
        wp_enqueue_style( 'singleproduct-bootstrap_reboot-style', $stylesheet_dir_uri . '/assets/css/bootstrap-reboot.min.css' );
        wp_enqueue_style( 'singleproduct-bootstrap-style', $stylesheet_dir_uri . '/assets/css/bootstrap.min.css' );
        wp_enqueue_style( 'singleproduct-bootstrap_grid-style', $stylesheet_dir_uri . '/assets/css/bootstrap-grid.min.css' );

        // Bootstrap Theme Option
        $bootstrap_theme_option = get_option( 'bootstrap_theme_option' );

        if( $bootstrap_theme_option != '---' ) {
            $stylesheet_uri = $stylesheet_dir_uri . '/assets/css/presets/theme-option/' . $bootstrap_theme_option . '.css';
            wp_enqueue_style( 'singleproduct-bootstrap-theme_option', $stylesheet_uri );
        }

        // Bootstrap Typography
        $bootstrap_typography = get_option( 'bootstrap_typography' );

        if( $bootstrap_typography != '---' ) {
            $stylesheet_uri = $stylesheet_dir_uri . '/assets/css/presets/typography/' . $bootstrap_typography . '.css';
            wp_enqueue_style( 'singleproduct-bootstrap-typography', $stylesheet_uri );
        }

        // Our own style
        wp_enqueue_style( 'singleproduct-style', $stylesheet_dir_uri . '/style.css', array(), $theme_version );
    }
endif;
add_action( 'wp_enqueue_scripts', 'singleproduct_enqueue_styles' );
