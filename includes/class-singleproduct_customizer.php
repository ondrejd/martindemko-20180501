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

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


if ( ! class_exists( 'Singleproduct_Customizer' ) ) :

/**
 * Contains methods for customizing the theme customization screen.
 * 
 * @author Ondřej Doněk <ondejd@gmil.com>
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since 1.0.0
 */
class Singleproduct_Customizer {

    /**
     * @since 1.0.0
     * @var string
     */
    const THEME_PANEL_ID = 'singleproduct_theme_panel';

    /**
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    public static function register( \WP_Customize_Manager $wp_customize ) {

        // Register main panel
        $wp_customize->add_panel( self::THEME_PANEL_ID, array(
            'title' => __( 'Vzhled tématu', 'singleproduct' ),
            'description' => __( 'Sdružuje nastavení vzhledu tématu <strong>martindemko-20180501</strong>', 'singleproduct' ),
            'priority' => 15,
        ) );

        // Product options
        self::register_product_section( $wp_customize );
        self::register_product_options( $wp_customize );
        self::register_product_controls( $wp_customize );
        self::register_product_partials( $wp_customize );

        // "Logos" panel
        self::register_logos_section( $wp_customize );
        self::register_logos_options( $wp_customize );
        self::register_logos_controls( $wp_customize );
        self::register_logos_partials( $wp_customize );

        // "Other Steps" panel
        self::register_ordersteps_section( $wp_customize );
        self::register_ordersteps_options( $wp_customize );
        self::register_ordersteps_controls( $wp_customize );
        self::register_ordersteps_partial( $wp_customize );

        // Other theme options
        self::register_other_section( $wp_customize );
        self::register_other_options( $wp_customize );
        self::register_other_controls( $wp_customize );
        self::register_other_partials( $wp_customize );

        // Header/footer options
        self::register_footer_section( $wp_customize );
        self::register_footer_options( $wp_customize );
        self::register_footer_controls( $wp_customize );

        // Bootstrap options
        self::register_footer_section( $wp_customize );
        self::register_bootstrap_options( $wp_customize );
        self::register_bootstrap_controls( $wp_customize );


        self::register_blogname_partials( $wp_customize );

        $wp_customize->remove_section( 'static_front_page' );
    }

    /**
     * @internal Register section for theme's default product.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_product_section( \WP_Customize_Manager $wp_customize ) {
        $wp_customize->add_section( 'singleproduct_product_options', array(
            'title'       => __( 'Produkt', 'singleproduct' ),
            'priority'    => 10,
            'capability'  => 'edit_theme_options',
            'description' => __( 'Nastavení pro produkt, kterému je web věnován.', 'singleproduct' ),
            'panel'       => self::THEME_PANEL_ID,
        ) );
    }

    /**
     * @internal Register options for theme's default product.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_product_options( \WP_Customize_Manager $wp_customize ) {
        $wp_customize->add_setting( 'site_product_title' , self::get_default_setting_options( DEFAULT_SITE_PRODUCT_TITLE ) );
        $wp_customize->add_setting( 'site_product_description' , self::get_default_setting_options( DEFAULT_SITE_PRODUCT_DESCRIPTION ) );
        $wp_customize->add_setting( 'site_product_image' , self::get_default_setting_options( DEFAULT_SITE_PRODUCT_IMAGE ) );
    }

    /**
     * @internal Register controls for theme's default product.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_product_controls( \WP_Customize_Manager $wp_customize ) {
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize,
            'cnt_product_title', array(
                'label'           => __( 'Název produktu', 'singleproduct' ),
                'section'         => 'singleproduct_product_options',
                'settings'        => 'site_product_title',
                'type'            => 'text',
                'active_callback' => array( 'Singleproduct_Customizer', 'callback_product' ),
            )
        ) );

        $wp_customize->add_control( new WP_Customize_Control( $wp_customize,
            'cnt_product_description', array(
                'label'           => __( 'Popis produktu', 'singleproduct' ),
                'section'         => 'singleproduct_product_options',
                'settings'        => 'site_product_description',
                'type'            => 'textarea',
                'active_callback' => array( 'Singleproduct_Customizer', 'callback_product' ),
            )
        ) );
    }

    /**
     * @internal Register partials for theme's default product.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_product_partials( \WP_Customize_Manager $wp_customize ) {

        if ( ! isset( $wp_customize->selective_refresh ) ) {
            return;
        }

        // Product
        $wp_customize->selective_refresh->add_partial( 'product', array(
            'selector'        => '.site-product',
            'settings'        => array(
                'site_product_title',
                'site_product_description',
                'site_product_image',
            ),
        ) );
    }

    /**
     * @internal Register section for "Logos" panel options.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_logos_section( \WP_Customize_Manager $wp_customize ) {
        $wp_customize->add_section( 'singleproduct_logos_options', array(
            'title'       => __( 'Pás s logy', 'singleproduct' ),
            'priority'    => 13,
            'capability'  => 'edit_theme_options',
            'description' => __( 'Nastavení pro pás s logy, který se zobrazí hned pod produktem.', 'singleproduct' ),
            'panel'       => self::THEME_PANEL_ID,
        ) );
    }

    /**
     * @internal Register options for "Logos" panel.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_logos_options( \WP_Customize_Manager $wp_customize ) {
        $wp_customize->add_setting( 'show_product_logos', self::get_default_setting_options( 'yes' ) );
        $wp_customize->add_setting( 'product_logo_img_1', self::get_default_setting_options() );
        $wp_customize->add_setting( 'product_logo_url_1', self::get_default_setting_options() );
        $wp_customize->add_setting( 'product_logo_img_2', self::get_default_setting_options() );
        $wp_customize->add_setting( 'product_logo_url_2', self::get_default_setting_options() );
        $wp_customize->add_setting( 'product_logo_img_3', self::get_default_setting_options() );
        $wp_customize->add_setting( 'product_logo_url_3', self::get_default_setting_options() );
    }

    /**
     * @internal Register controls for "Logos" panel options.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_logos_controls( \WP_Customize_Manager $wp_customize ) {

        $wp_customize->add_control( new WP_Customize_Control( $wp_customize,
            'cnt_show_product_logos', array(
                'label'       => __( 'Zobrazit loga produktu', 'singleproduct' ),
                'description' => __( 'Zobrazí panel s třemi logy - ty musí být nastaveny v šabloně v souboru <code>header.php</code>', 'singleproduct' ),
                'section'     => 'singleproduct_logos_options',
                'settings'    => 'show_product_logos',
                'type'        => 'select',
                'choices' => array(
                    'yes' => __( 'Ano', 'singleproduct' ),
                    'no'  => __( 'Ne', 'singleproduct' ),
                ),
                'active_callback' => array( 'Singleproduct_Customizer', 'callback_logos' ),
            )
        ) );

        $wp_customize->add_control( new WP_Customize_Control( $wp_customize,
            'cnt_product_logo_url_1', array(
                'label'           => __( 'Odkaz prvního loga', 'singleproduct' ),
                'section'         => 'singleproduct_logos_options',
                'settings'        => 'product_logo_url_1',
                'type'            => 'url',
                'active_callback' => array( 'Singleproduct_Customizer', 'callback_logos' ),
            )
        ) );

        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize,
            'cnt_product_logo_img_1', array(
                'label'    => __( 'První logo', 'singleproduct' ),
                'section'  => 'singleproduct_logos_options',
                'settings' => 'product_logo_img_1',
                'active_callback' => array( 'Singleproduct_Customizer', 'callback_logos' ),
            )
        ) );

        $wp_customize->add_control( new WP_Customize_Control( $wp_customize,
            'cnt_product_logo_url_2', array(
                'label'       => __( 'Odkaz druhého loga', 'singleproduct' ),
                'section'     => 'singleproduct_logos_options',
                'settings'    => 'product_logo_url_2',
                'type'        => 'url',
                'active_callback' => array( 'Singleproduct_Customizer', 'callback_logos' ),
            )
        ) );

        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize,
            'cnt_product_logo_img_2', array(
                'label'    => __( 'Druhé logo', 'singleproduct' ),
                'section'  => 'singleproduct_logos_options',
                'settings' => 'product_logo_img_2',
                'active_callback' => array( 'Singleproduct_Customizer', 'callback_logos' ),
            )
        ) );

        $wp_customize->add_control( new WP_Customize_Control( $wp_customize,
            'cnt_product_logo_url_3', array(
                'label'       => __( 'Odkaz třetího loga', 'singleproduct' ),
                'section'     => 'singleproduct_logos_options',
                'settings'    => 'product_logo_url_3',
                'type'        => 'url',
                'active_callback' => array( 'Singleproduct_Customizer', 'callback_logos' ),
            )
        ) );

        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize,
            'cnt_product_logo_img_3', array(
                'label'    => __( 'Třetí logo', 'singleproduct' ),
                'section'  => 'singleproduct_logos_options',
                'settings' => 'product_logo_img_3',
                'active_callback' => array( 'Singleproduct_Customizer', 'callback_logos' ),
            )
        ) );
    }

    /**
     * @internal Register partials for "Logos" panel options.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_logos_partials( \WP_Customize_Manager $wp_customize ) {
        $wp_customize->selective_refresh->add_partial( 'product_logos', array(
            'selector'        => '.site-product-logos',
            'settings'        => array( 'show_product_logos', 'product_logo_img_1', 'product_logo_url_1', 'product_logo_img_2', 'product_logo_url_2', 'product_logo_img_3', 'product_logo_url_3' ),
            'render_callback' => array( 'Singleproduct_Customizer' , 'callback_logos_render' ),
        ) );
    }

    /**
     * @internal Register section for "Order steps" panel options.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_ordersteps_section( \WP_Customize_Manager $wp_customize ) {
        $wp_customize->add_section( 'singleproduct_ordersteps_options', array(
            'title'       => __( 'Postup objednávky', 'singleproduct' ),
            'description' => __( 'Nastavení pro panel s postupem objednávky.', 'singleproduct' ),
            'priority'    => 30,
            'capability'  => 'edit_theme_options',
            'panel'       => self::THEME_PANEL_ID,
        ) );
    }

    /**
     * @internal Register options for "Order steps" panel.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_ordersteps_options( \WP_Customize_Manager $wp_customize ) {
        $wp_customize->add_setting( 'ordersteps_show' , self::get_default_setting_options( 'yes' ) );
        $wp_customize->add_setting( 'ordersteps_foreground_color' , self::get_default_setting_options( '#98a0a6' ) );
        $wp_customize->add_setting( 'ordersteps_background_color_1' , self::get_default_setting_options( '#ecd9d9' ) );
        $wp_customize->add_setting( 'ordersteps_background_color_2' , self::get_default_setting_options( '#ffffff' ) );
        $wp_customize->add_setting( 'ordersteps_text_1' , self::get_default_setting_options( __( 'Klikněte na "Objednat PRODUKT"', 'singleproduct' ) ) );
        $wp_customize->add_setting( 'ordersteps_text_2' , self::get_default_setting_options( __( 'Vyplňte formulář', 'singleproduct' ) ) );
        $wp_customize->add_setting( 'ordersteps_text_3' , self::get_default_setting_options( __( 'Počkejte, až Vám zavoláme', 'singleproduct' ) ) );
    }

    /**
     * @internal Register controls for "Order steps" panel options.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_ordersteps_controls( \WP_Customize_Manager $wp_customize ) {
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize,
            'cnt_ordersteps_show', array(
                'label'       => __( 'Zobrazit postup objednávky', 'singleproduct' ),
                'section'     => 'singleproduct_ordersteps_options',
                'settings'    => 'ordersteps_show',
                'type'        => 'select',
                'choices' => array(
                    'yes' => __( 'Ano', 'singleproduct' ),
                    'no'  => __( 'Ne', 'singleproduct' ),
                )
            )
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
            'cnt_ordersteps_foreground_color', array(
                'label'    => __( 'Barva textu', 'singleproduct' ),
                'section'  => 'singleproduct_ordersteps_options',
                'settings' => 'ordersteps_foreground_color',
            )
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
            'cnt_ordersteps_background_color_1', array(
                'label'    => __( 'Barva hlavního pozadí', 'singleproduct' ),
                'section'  => 'singleproduct_ordersteps_options',
                'settings' => 'ordersteps_background_color_1',
            )
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
            'cnt_ordersteps_background_color_2', array(
                'label'    => __( 'Barva pozadí kruhů', 'singleproduct' ),
                'section'  => 'singleproduct_ordersteps_options',
                'settings' => 'ordersteps_background_color_2',
            )
        ) );

        $wp_customize->add_control( new WP_Customize_Control( $wp_customize,
            'cnt_ordersteps_text_1', array(
                'label'       => __( 'První krok', 'singleproduct' ),
                'description' => __( 'Text pro první krok', 'singleproduct' ),
                'section'     => 'singleproduct_ordersteps_options',
                'settings'    => 'ordersteps_text_1',
            )
        ) );

        $wp_customize->add_control( new WP_Customize_Control( $wp_customize,
            'cnt_ordersteps_text_2', array(
                'label'       => __( 'Druhý krok', 'singleproduct' ),
                'description' => __( 'Text pro druhý krok', 'singleproduct' ),
                'section'     => 'singleproduct_ordersteps_options',
                'settings'    => 'ordersteps_text_2',
            )
        ) );

        $wp_customize->add_control( new WP_Customize_Control( $wp_customize,
            'cnt_ordersteps_text_3', array(
                'label'       => __( 'Třetí krok', 'singleproduct' ),
                'description' => __( 'Text pro třetí krok', 'singleproduct' ),
                'section'     => 'singleproduct_ordersteps_options',
                'settings'    => 'ordersteps_text_3',
            )
        ) );
    }

    /**
     * @internal Register partials for the order steps panel.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_ordersteps_partial( \WP_Customize_Manager $wp_customize ) {

        if ( ! isset( $wp_customize->selective_refresh ) ) {
            return;
        }

        $wp_customize->selective_refresh->add_partial( 'ordersteps', array(
            'selector'        => '.hp-help-banner',
            'settings'        => array( 'ordersteps_show', 'ordersteps_foreground_color', 'ordersteps_background_color_1', 'ordersteps_background_color_2', 'ordersteps_text_1', 'ordersteps_text_2', 'ordersteps_text_3' ),
            'render_callback' => array( 'Singleproduct_Customizer' , 'callback_ordersteps' ),
        ) );
    }

    /**
     * @internal Register section for other theme options.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_other_section( \WP_Customize_Manager $wp_customize ) {
        $wp_customize->add_section( 'singleproduct_other_options', array(
            'title'       => __( 'Další volby', 'singleproduct' ),
            'priority'    => 40,
            'capability'  => 'edit_theme_options',
            'description' => __( 'Další nastavení šablony.', 'singleproduct' ),
            'panel'       => self::THEME_PANEL_ID,
        ) );
    }

    /**
     * @internal Register other theme options.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_other_options( \WP_Customize_Manager $wp_customize ) {
        $wp_customize->add_setting( 'product_order_btn_text' , self::get_default_setting_options( __( 'Objednat PRODUKT', 'singleproduct' ), 'option', 'postMessage' ) );
        $wp_customize->add_setting( 'product_order_btn_link' , self::get_default_setting_options( '#', 'option', 'postMessage') );
        $wp_customize->add_setting( 'homepage_post_excerpts_show' , self::get_default_setting_options( 'yes' ) );
        $wp_customize->add_setting( 'posts_per_page' , self::get_default_setting_options( 6  ) );
        $wp_customize->add_setting( 'homepage_show_posts_pagination' , self::get_default_setting_options( 'yes' ) );
    }

    /**
     * @internal Register controls for other theme options.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_other_controls( \WP_Customize_Manager $wp_customize ) {
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize,
            'cnt_product_order_btn_text', array(
                'label'       => __( 'Text tlačítka objednat', 'singleproduct' ),
                'description' => __( 'Tato změna se projeví u všech obednávacích tlačítek.   ', 'singleproduct' ),
                'section'     => 'singleproduct_other_options',
                'settings'    => 'product_order_btn_text',
                'type'        => 'text',
            )
        ) );

        $wp_customize->add_control( new WP_Customize_Control( $wp_customize,
            'cnt_product_order_btn_link', array(
                'label'    => __( 'Odkaz tlačítka objednat', 'singleproduct' ),
                'section'  => 'singleproduct_other_options',
                'settings' => 'product_order_btn_link',
                'type'     => 'url',
            )
        ) );

        $wp_customize->add_control( new WP_Customize_Control( $wp_customize,
            'cnt_homepage_post_excerpts_show', array(
                'label'       => __( 'Zobrazit texty příspěvků', 'singleproduct' ),
                'description' => __( 'Zobrazit texty příspěvků blogu na úvodní stránce?', 'singleproduct' ),
                'section'     => 'singleproduct_other_options',
                'settings'    => 'homepage_post_excerpts_show',
                'type'        => 'select',
                'choices'     => array(
                    'yes'     => __( 'Ano', 'singleproduct' ),
                    'no'      => __( 'Ne', 'singleproduct' ),
                )
            )
        ) );

        $wp_customize->add_control( new WP_Customize_Control( $wp_customize,
            'cnt_posts_per_page', array(
                'label'       => __( 'Počet přísěvků', 'singleproduct' ),
                'description' => __( 'Počet přípěvků, které se mají na úvodní stránce zobrazit.', 'singleproduct' ),
                'section'     => 'singleproduct_other_options',
                'settings'    => 'posts_per_page',
                'type'        => 'number',
                'input_attrs' => array( 'min' => 2, 'step' => 1 ),
            )
        ) );

        $wp_customize->add_control( new WP_Customize_Control( $wp_customize,
            'cnt_homepage_show_posts_pagination', array(
                'label'       => __( 'Zobrazit stránkování', 'singleproduct' ),
                'description' => __( 'Zobrazi stránkováí pokud počet příspěvků překročí daný počet k zobrazení?', 'singleproduct' ),
                'section'     => 'singleproduct_other_options',
                'settings'    => 'homepage_show_posts_pagination',
                'type'        => 'select',
                'choices'     => array(
                    'yes'     => __( 'Ano', 'singleproduct' ),
                    'no'      => __( 'Ne', 'singleproduct' ),
                )
            )
        ) );
    }

    /**
     * @internal Register partials for theme's other settings pane.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    public static function register_other_partials( \WP_Customize_Manager $wp_customize ) {

        if ( ! isset( $wp_customize->selective_refresh ) ) {
            return;
        }

        $wp_customize->selective_refresh->add_partial( 'hp_post_excerpts_show', array(
            'selector'        => 'article.post:first-child div.entry-content p:first-child',
            'settings'        => array( 'homepage_post_excerpts_show' ),
        ) );

        $wp_customize->selective_refresh->add_partial( 'product_order_button', array(
            'selector'        => '.site-product-order-button',
            'settings'        => array( 'product_order_btn_text', 'product_order_btn_link' ),
            'render_callback' => array( 'Singleproduct_Customizer' , 'callback_order_button' ),
        ) );

        $wp_customize->selective_refresh->add_partial( 'pagination', array(
            'selector'        => 'nav.pagination',
            'settings'        => array( 'homepage_show_posts_pagination' ),
        ) );
    }

    /**
     * @internal Register section for header/footer options.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_footer_section( \WP_Customize_Manager $wp_customize ) {
        $wp_customize->add_section( 'singleproduct_footer_options', array(
            'title'       => __( 'Hlavička & Patička', 'singleproduct' ),
            'priority'    => 20,
            'capability'  => 'edit_theme_options',
            'description' => __( 'Nastavení barev pro hlavičku a patičku webu.', 'singleproduct' ),
            'panel'       => self::THEME_PANEL_ID,
        ) );
    }

    /**
     * @internal Register header/footer options.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_footer_options( \WP_Customize_Manager $wp_customize ) {
        $wp_customize->add_setting( 'header_foreground_color' , self::get_default_setting_options( '#000000' ) );
        $wp_customize->add_setting( 'header_background_color' , self::get_default_setting_options( '#ecd9d9' ) );
        $wp_customize->add_setting( 'footer_foreground_color' , self::get_default_setting_options( '#ffffff' ) );
        $wp_customize->add_setting( 'footer_background_color' , self::get_default_setting_options( '#2f1b1b' ) );
    }

    /**
     * @internal Register controls for header/footer options.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_footer_controls( \WP_Customize_Manager $wp_customize ) {
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
            'cnt_header_foreground_color', array(
                'label'       => __( 'Barva textu', 'singleproduct' ),
                'description' => __( 'Barva textu <strong>hlavičky</strong> webu.', 'singleproduct' ),
                'section'     => 'singleproduct_footer_options',
                'settings'    => 'header_foreground_color',
            )
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
            'cnt_header_background_color', array(
                'label'       => __( 'Barva pozadí', 'singleproduct' ),
                'description' => __( 'Barva pozadí <strong>hlavičky</strong> webu.', 'singleproduct' ),
                'section'     => 'singleproduct_footer_options',
                'settings'    => 'header_background_color',
            )
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
            'cnt_footer_foreground_color', array(
                'label'       => __( 'Barva textu', 'singleproduct' ),
                'description' => __( 'Barva text <strong>patičky</strong> webu.', 'singleproduct' ),
                'section'     => 'singleproduct_footer_options',
                'settings'    => 'footer_foreground_color',
            )
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
            'cnt_footer_background_color', array(
                'label'       => __( 'Barva pozadí', 'singleproduct' ),
                'description' => __( 'Barva pozadí <strong>patičky</strong> webu.', 'singleproduct' ),
                'section'     => 'singleproduct_footer_options',
                'settings'    => 'footer_background_color',
            )
        ) );
    }

    /**
     * @internal Register section for Bootstrap related options.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_bootstrap_section( \WP_Customize_Manager $wp_customize ) {
        $wp_customize->add_section( 'singleproduct_bootstrap_options', array(
            'title'       => __( 'Bootstrap', 'singleproduct' ),
            'priority'    => 20,
            'capability'  => 'edit_theme_options',
            'description' => __( 'Nastavení pro knihovnu <a href="https://getbootstrap.com/" target="_blank">Bootstrap</a>.', 'singleproduct' ),
            'panel'       => self::THEME_PANEL_ID,
        ) );
    }

    /**
     * @internal Register Bootstrap related options.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_bootstrap_options( \WP_Customize_Manager $wp_customize ) {
        $wp_customize->add_setting( 'bootstrap_theme_option' , self::get_default_setting_options( '---' ) );
        $wp_customize->add_setting( 'bootstrap_typography' , self::get_default_setting_options( '---' ) );
    }

    /**
     * @internal Register controls for Bootstrap related options.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_bootstrap_controls( \WP_Customize_Manager $wp_customize ) {
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize,
            'cnt_bootstrap_theme_option', array(
                'label'       => __( 'Možnost tématu', 'singleproduct' ),
                'description' => __( 'Vyberte si jednu z před-definovaných možností knihovny <strong>Bootstrap</strong>.', 'singleproduct' ),
                'section'     => 'singleproduct_bootstrap_options',
                'settings'    => 'bootstrap_theme_option',
                'type'        => 'select',
                'choices'     => array(
                    '---'       => __( '--- Vyberte ---', 'singleproduct' ),
                    'cerulean'  => __( 'Cerulean', 'singleproduct' ),
                    'cosmo'     => __( 'Cosmo', 'singleproduct' ),
                    'cyborg'    => __( 'Cyborg', 'singleproduct' ),
                    'darkly'    => __( 'Darkly', 'singleproduct' ),
                    'flatly'    => __( 'Flatly', 'singleproduct' ),
                    'journal'   => __( 'Journal', 'singleproduct' ),
                    'litera'    => __( 'Litera', 'singleproduct' ),
                    'lumen'     => __( 'Lumen', 'singleproduct' ),
                    'lux'       => __( 'Lux', 'singleproduct' ),
                    'materia'   => __( 'Materia', 'singleproduct' ),
                    'minty'     => __( 'Minty', 'singleproduct' ),
                    'pulse'     => __( 'Pulse', 'singleproduct' ),
                    'sandstone' => __( 'Sandstone', 'singleproduct' ),
                    'simplex'   => __( 'Simplex', 'singleproduct' ),
                    'sketchy'   => __( 'Sketchy', 'singleproduct' ),
                    'slate'     => __( 'Slate', 'singleproduct' ),
                    'solar'     => __( 'Solar', 'singleproduct' ),
                    'spacelab'  => __( 'SpaceLab', 'singleproduct' ),
                    'superhero' => __( 'SuperHero', 'singleproduct' ),
                    'united'    => __( 'United', 'singleproduct' ),
                    'yeti'      => __( 'Yeti', 'singleproduct' ),
                )
            )
        ) );

        $wp_customize->add_control( new WP_Customize_Control( $wp_customize,
            'cnt_bootstrap_typography', array(
                'label'       => __( 'Typografie', 'singleproduct' ),
                'description' => __( 'Vyberte si jednu z před-definovaných typografických standardů knihovny <strong>Bootstrap</strong>.', 'singleproduct' ),
                'section'     => 'singleproduct_bootstrap_options',
                'settings'    => 'bootstrap_typography',
                'type'        => 'select',
                'choices'     => array(
                    '---' => __( '--- Vyberte ---', 'singleproduct' ),
                    'arbutusslab-opensans'    => __( 'ArbutussLab - OpenSans', 'singleproduct' ),
                    'montserrat-merriweather' => __( 'MontSerrat - MerriWeather', 'singleproduct' ),
                    'montserrat-opensans'     => __( 'MontSerrat - OpenSans', 'singleproduct' ),
                    'oswald-muli'             => __( 'Oswald - Muli', 'singleproduct' ),
                    'poppins-lora'            => __( 'Poppins - Lora', 'singleproduct' ),
                    'poppins-poppins'         => __( 'Poppins - Poppins', 'singleproduct' ),
                    'roboto-roboto'           => __( 'Roboto - Roboto', 'singleproduct' ),
                    'robotoslab-roboto'       => __( 'RobotoSlab - Roboto', 'singleproduct' ),
                )
            )
        ) );
    }

    /**
     * @internal Register partials for blogame.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_blogname_partials( \WP_Customize_Manager $wp_customize ) {

        if ( ! isset( $wp_customize->selective_refresh ) ) {
            return;
        }

        $wp_customize->selective_refresh->add_partial( 'header_site_title', array(
            'selector'        => '.site-title',
            'settings'        => array( 'blogname' ),
            'render_callback' => array( 'Singleproduct_Customizer' , 'callback_site_title' ),
        ) );

        $wp_customize->selective_refresh->add_partial( 'document_title', array(
            'selector'        => 'head > title',
            'settings'        => array( 'blogname' ),
            'render_callback' => 'wp_get_document_title',
        ) );
    }

    /**
     * Hook for `wp_head` action.
     *
     * @return void
     * @since 1.0.0
     * @uses get_option()
     */
    public static function header_output() {
        echo '<style type="text/css">' . PHP_EOL;

        // Header background/foreground color
        echo '.site-title { color: ' . get_option( 'header_foreground_color' ) . '; }' . PHP_EOL;
        echo '#page-header { background-color: ' . get_option( 'header_background_color' ) . '; }' . PHP_EOL;

        // Product logos
        echo '.site-product-logos { display: ' . ( get_option( 'show_product_logos' ) == 'yes' ? 'block' : 'none' ) . '; }' . PHP_EOL;

        // "Order steps" panel
        // TODO Rename it to "ordersteps-banner"!
        echo '.hp-help-banner { background-color: ' . get_option( 'ordersteps_background_color_1' ) . '; }' . PHP_EOL;
        echo '.hp-help-banner span.help-banner-num  {' .
                'background-color: ' . get_option( 'ordersteps_background_color_2' ) . ';' .
                'border-color: ' . get_option( 'ordersteps_foreground_color' ) . ';' .
                'color: ' . get_option( 'ordersteps_foreground_color' ) . ';' .
            '}' . PHP_EOL;
        echo '.hp-help-banner span.help-banner-lbl { color: ' . get_option( 'ordersteps_foreground_color' ) . '; }' . PHP_EOL;

        // Footer background/foreground color
        echo '.site-footer {' .
                'background-color: ' . get_option( 'footer_background_color' ) . ';' .
                'color: ' . get_option( 'footer_foreground_color' ) . ';' .
            '}' . PHP_EOL;
        echo '.site-footer ul.menu li a { color: ' . get_option( 'footer_background_color' ) . '; }';

        // There are some invisible edit icons in preview mode and nothing other works...
        echo '.customize-partial-edit-shortcut-product_logos { left: 50%; }' . PHP_EOL;
        echo '.customize-partial-edit-shortcut-header_site_title { left: 31px; top: 0px; }' . PHP_EOL;
        echo '.customize-partial-edit-shortcut-product { left: 50%; }' . PHP_EOL;
        echo '.customize-partial-edit-shortcut-pagination { left: 45%; }' . PHP_EOL;
        echo '.customize-partial-edit-shortcut-ordersteps { left: 31px; }' . PHP_EOL;

        echo '</style>';
?>
<?php
    }

    /**
     * Hook for `customize_preview_init` action.
     *
     * @return void
     * @since 1.0.0
     * @uses get_template_directory_uri()
     * @uses wp_enqueue_script()
     */
    public static function live_preview() {
	    wp_enqueue_script(
		      'martindemko-themecustomizer',
		      get_template_directory_uri() . '/assets/js/theme-customizer.js',
		      array( 'jquery', 'customize-preview' ),
		      '',
		      true
        );
    }

    /**
     * @internal Active callback for controls around product logos.
     * @param \WP_Customize_Control $control
     * @return boolean
     * @see Singleproduct_Customizer::register_product_options()
     * @since 1.0.0
     */
    public static function callback_logos( \WP_Customize_Control $control ) {
        return ( $control->manager->get_setting( 'show_product_logos' )->value() == 'yes' );
    }

    /**
     * @internal Callback for partial with order steps.
     * @return void
     * @see Singleproduct_Customizer::register_productlogos_partial()
     * @since 1.0.0
     */
    public static function callback_logos_render() {
        return singleproduct_product_logos( false );
    }

    /**
     * @internal Callback for blogname partial.
     * @return void
     * @see Singleproduct_Customizer::register_blogname_partials()
     * @since 1.0.0
     * @uses get_bloginfo()
     */
    public static function callback_site_title() {
        return get_bloginfo( 'name', 'display' );
    }

    /**
     * @internal Callback for product order button parial.
     * @return void
     * @see Singleproduct_Customizer::register_orderbtn_partial()
     * @since 1.0.0
     * @uses esc_attr()
     * @uses esc_html()
     * @uses get_option()
     */
    public static function callback_order_button() {
        return ''
            . '<span class="site-product-order-button">'
            .   '<a href="' . esc_attr( get_option( 'product_order_btn_link', '#' ) ) .'" class="btn btn-primary">'
            .     esc_html( get_option( 'product_order_btn_text' ) )
            .   '</a>'
            . '</span>';
    }

    /**
     * @internal Callback for partial with order steps.
     * @return void
     * @see Singleproduct_Customizer::register_ordersteps_partial()
     * @since 1.0.0
     */
    public static function callback_ordersteps() {
        return singleproduct_hp_help_banner( false );
    }

    /**
     * @internal Return array with setting options.
     * @param mixed $default Default value of WP customizer setting. Default value is 0.
     * @param string $type Type of WP customizer setting. Default value is 'option'.
     * @param string $transport Option "transport" of WP customizer setting. Default value is NULL. Occasionally you want to set it on "postMessage".
     * @param array $additional Additional options. Default value is empty array.
     * @return array
     * @since 1.0.0
     */
    protected static function get_default_setting_options( $default = 0, $type = 'option', $transport = null, $additional = array() ) {
        $defaults = array(
            'capability' => 'edit_theme_options',
            'default'    => $default,
            'type'       => $type,
        );

        if ( !is_nul( $transport ) ) {
            $defaults['transport'] = $transport;
        }

        return array_merge( $defaults, $additional );
    }

}

endif;

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'Singleproduct_Customizer' , 'register' ), 999 );
add_action( 'wp_head' , array( 'Singleproduct_Customizer' , 'header_output' ), 999 );
add_action( 'customize_preview_init' , array( 'Singleproduct_Customizer' , 'live_preview' ), 999 );

