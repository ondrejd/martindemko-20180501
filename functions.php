<?php
/**
 * Theme "martindemko-20180501" for WordPress.
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


// Includes
include( dirname( __FILE__ ) . '/inc/class-md_products.php' );
include( dirname( __FILE__ ) . '/inc/class-md_customize.php' );
include( dirname( __FILE__ ) . '/inc/template-tags.php' );


if( !function_exists( 'martindemko_after_setup_theme' ) ) :
    /**
     * Setup theme.
     * @return void
     * @since 1.0.0
     */
    function martindemko_setup_theme() {
        load_theme_textdomain( 'martindemko', get_stylesheet_directory() . '/languages' );

        add_option( 'site_product_id', 'yes' );
        add_option( 'show_product_logos', 'yes' );
        add_option( 'product_order_btn_text', __( 'Objednat PRODUKT', 'martindemko' ) );
        add_option( 'product_order_btn_link', __( '#', 'martindemko' ) );
        add_option( 'header_foreground_color', '#000000' );
        add_option( 'header_background_color', '#ecd9d9' );
        add_option( 'ordersteps_show', 'yes' );
        add_option( 'ordersteps_foreground_color', '#98a0a6' );
        add_option( 'ordersteps_background_color_1', '#ecd9d9' );
        add_option( 'ordersteps_background_color_2', '#ffffff' );
        add_option( 'ordersteps_text_1', __( 'Klikněte na "Objednat PRODUKT"', 'martindemko' ) );
        add_option( 'ordersteps_text_2', __( 'Vyplňte formulář', 'martindemko' ) );
        add_option( 'ordersteps_text_3', __( 'Počkejte, až Vám zavoláme', 'martindemko' ) );
        add_option( 'homepage_post_excerpts_show', 'yes' );
        add_option( 'footer_foreground_color', '#ffffff' );
        add_option( 'footer_background_color', '#2f1b1b' );

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
            'footer-languages-menu' => __( 'Jazykové menu', 'martindemko' ),
            'footer-contact-menu' => __( 'Kontaktní menu', 'martindemko' )
        ) );

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
			        'name'  => __( 'Jazykové menu', 'martindemko' ),
			        'items' => array(),
		        ),
		        'footer-contact-menu' => array(
			        'name'  => __( 'Kontaktní menu', 'martindemko' ),
			        'items' => array(),
		        ),
	        ),
        ) );
    }
endif;
// Setup up theme
add_action( 'after_setup_theme', 'martindemko_setup_theme' );


if( !function_exists( 'martindemko_create_post_type' ) ) :
    /**
     * Register new custom post type.
     * @return void
     * @since 1.0.0
     */
    function martindemko_create_post_type() {
        register_post_type( 'martindemko_product', array(
            'labels' => array(
                'name' => __( 'Products', 'martindemko' ),
                'singular_name' => __( 'Product', 'martindemko' )
            ),
            'description' => __( 'Products custom post type', 'martindemko' ),
            'public' => true,
            'has_archive' => true,
            'menu_positions' => 21,
            'menu_icon' => 'dashicons-paperclip',
            'hierarchical' => false,
            'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'comments', 'revisions', 'page-attributes' ),
            'delete_with_user' => false,
            'show_in_rest' => false,
            'slug' => array( __( 'product', 'martindemko' ) )
        ) );
    }
endif;
add_action( 'init', 'martindemko_enqueue_styles' );


if( !function_exists( 'martindemko_enqueue_styles' ) ) :
    /**
     * Register new custom post type.
     * @return void
     * @since 1.0.0
     */
    function martindemko_enqueue_styles() {

        wp_register_script( 'martindemko-html5', get_stylesheet_directory_uri() . '/assets/js/html5.js' );
        wp_register_script( 'martindemko-popper', get_stylesheet_directory_uri() . '/assets/js/popper.min.js' );
        wp_register_script( 'martindemko-bootstrap', get_stylesheet_directory_uri() . '/assets/js/bootstrap.bundle.min.js' );
        wp_register_script( 'martindemko-fontawesome', get_stylesheet_directory_uri() . '/assets/js/fontawesome/fontawesome-all.min.js' );

        wp_register_script(
            'martindemko-script', 
            get_stylesheet_directory_uri() . '/assets/js/theme-script.js',
            array(
                'jquery', 'jquery-color', 'jquery-form',
                'jquery-masonry', 'jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-mouse',
                'jquery-ui-sortable', 'jquery-ui-draggable', 'jquery-ui-droppable',
                'jquery-ui-droppable', 'jquery-ui-selectable', 'jquery-ui-position',
                'jquery-ui-tooltip', 'jquery-ui-dialog', 'jquery-ui-button', 'jquery-ui-datepicker', 
                'jquery-effects-core', 'jquery-effects-fade', 'jquery-effects-highlight',
                'jquery-effects-slide', 'jquery-effects-transfer', 'martindemko-html5',
                'martindemko-popper', 'martindemko-bootstrap', 'martindemko-fontawesome'
            ),
            wp_get_theme()->get( 'Version' ),
            true
        );
        wp_enqueue_script( 'martindemko-script' );

        wp_enqueue_style( 'martindemko-bootstrap_reboot-style', get_stylesheet_directory_uri() . '/assets/css/bootstrap-reboot.min.css' );
        //wp_enqueue_style( 'martindemko-bootstrap_grid-style', get_stylesheet_directory_uri() . '/assets/css/bootstrap-grid.min.css' );
        wp_enqueue_style( 'martindemko-bootstrap-style', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css' );

        wp_enqueue_style(
            'martindemko-style',
            get_stylesheet_directory_uri() . '/style.css',
            array(),
            wp_get_theme()->get( 'Version' )
        );
    }
endif;
add_action( 'wp_enqueue_scripts', 'martindemko_enqueue_styles' );


