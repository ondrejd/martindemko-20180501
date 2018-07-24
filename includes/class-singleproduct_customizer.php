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


if( !class_exists( 'Singleproduct_Customizer' ) ) :

/**
 * Contains methods for customizing the theme customization screen.
 * @author Ondřej Doně, <ondejd@gmil.com>
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since 1.0.0
 */
class Singleproduct_Customizer {
    const THEME_PANEL_ID = 'singleproduct_theme_panel';

    /**
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    public static function register( \WP_Customize_Manager $wp_customize ) {
        $wp_customize->add_panel( self::THEME_PANEL_ID, array(
            'title' => __( 'Vzhled tématu', 'singleproduct' ),
            'description' => __( 'Sdružuje nastavení vzhledu tématu <strong>martindemko-20180501</strong>', 'singleproduct' ),
            'priority' => 15,
        ) );

        self::register_product_options( $wp_customize );
        self::register_ordersteps_options( $wp_customize );
        self::register_other_options( $wp_customize );
        self::register_footer_options( $wp_customize );
        self::register_bootstrap_options( $wp_customize );

        self::register_blogname_partials( $wp_customize );
        self::register_ordersteps_partial( $wp_customize );
        self::register_product_partials( $wp_customize );
        self::register_other_partials( $wp_customize );

        $wp_customize->remove_section( 'static_front_page' );
    }

    /**
     * @internal Register options for theme's default product.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_product_options( \WP_Customize_Manager $wp_customize ) {

        // Section
        $wp_customize->add_section( 'singleproduct_product_options', 
            array(
                'title'       => __( 'Produkt', 'singleproduct' ),
                'priority'    => 10,
                'capability'  => 'edit_theme_options',
                'description' => __( 'Nastavení pro produkt, kterému je web věnován.', 'singleproduct' ),
                'panel'       => self::THEME_PANEL_ID,
            )
        );

        // Settings
        $wp_customize->add_setting( 'site_product_id' , array(
            'capability' => 'edit_theme_options',
            'default'    => 0,
            'type'       => 'option',
        ) );
        $wp_customize->add_setting( 'show_product_logos' , array(
            'capability' => 'edit_theme_options',
            'default'    => 'yes',
            'type'       => 'option',
        ) );
        $wp_customize->add_setting( 'product_logo_img_1' , array(
            'capability' => 'edit_theme_options',
            'default'    => 0,
            'type'       => 'option',
        ) );
        $wp_customize->add_setting( 'product_logo_url_1' , array(
            'capability' => 'edit_theme_options',
            'default'    => 0,
            'type'       => 'option',
        ) );
        $wp_customize->add_setting( 'product_logo_img_2' , array(
            'capability' => 'edit_theme_options',
            'default'    => 0,
            'type'       => 'option',
        ) );
        $wp_customize->add_setting( 'product_logo_url_2' , array(
            'capability' => 'edit_theme_options',
            'default'    => 0,
            'type'       => 'option',
        ) );
        $wp_customize->add_setting( 'product_logo_img_3' , array(
            'capability' => 'edit_theme_options',
            'default'    => 0,
            'type'       => 'option',
        ) );
        $wp_customize->add_setting( 'product_logo_url_3' , array(
            'capability' => 'edit_theme_options',
            'default'    => 0,
            'type'       => 'option',
        ) );

        // Controls

        include( dirname( __FILE__ ) . '/class-md_product_dropdown_wp_customize_control.php' );
        if( class_exists( 'MD_Product_Dropdown_WP_Customize_Control' ) ) {

            // Our products dropdown control
            $wp_customize->add_control( new MD_Product_Dropdown_WP_Customize_Control( $wp_customize, 
                'cnt_site_product_id', array(
                    'label'       => __( 'Produkt', 'singleproduct' ),
                    'description' => __( 'Vyberte defaultní produkt tématu', 'singleproduct' ),
                    'section'     => 'singleproduct_product_options',
                    'settings'    => 'site_product_id',
                )
            ) );
        } else {

            // Failsafe control
            $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
                'cnt_site_product_id', array(
                    'label'       => __( 'ID produktu', 'singleproduct' ),
                    'description' => __( 'Zadejte ID defaultního produktu', 'singleproduct' ),
                    'section'     => 'singleproduct_product_options',
                    'settings'    => 'site_product_id',
                    'type'        => 'number',
                )
            ) );
        }

        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
            'cnt_show_product_logos', array(
	            'label'       => __( 'Zobrazit loga produktu', 'singleproduct' ),
	            'description' => __( 'Zobrazí panel s třemi logy - ty musí být nastaveny v šabloně v souboru <code>header.php</code>', 'singleproduct' ),
	            'section'     => 'singleproduct_product_options',
	            'settings'    => 'show_product_logos',
                'type'        => 'select',
                'choices' => array(
                    'yes' => __( 'Ano', 'singleproduct' ),
                    'no'  => __( 'Ne', 'singleproduct' ),
                )
            )
        ) );
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
            'cnt_product_logo_url_1', array(
	            'label'           => __( 'Odkaz prvního loga', 'singleproduct' ),
	            'section'         => 'singleproduct_product_options',
	            'settings'        => 'product_logo_url_1',
                'type'            => 'url',
                'active_callback' => array( 'Singleproduct_Customizer', 'callback_product_logos' ),
            )
        ) );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize,
            'cnt_product_logo_img_1', array(
                'label'    => __( 'První logo', 'singleproduct' ),
                'section'  => 'singleproduct_product_options',
                'settings' => 'product_logo_img_1',
                'active_callback' => array( 'Singleproduct_Customizer', 'callback_product_logos' ),
            )
        ) );
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
            'cnt_product_logo_url_2', array(
	            'label'       => __( 'Odkaz druhého loga', 'singleproduct' ),
	            'section'     => 'singleproduct_product_options',
	            'settings'    => 'product_logo_url_2',
                'type'        => 'url',
                'active_callback' => array( 'Singleproduct_Customizer', 'callback_product_logos' ),
            )
        ) );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize,
            'cnt_product_logo_img_2', array(
                'label'    => __( 'Druhé logo', 'singleproduct' ),
                'section'  => 'singleproduct_product_options',
                'settings' => 'product_logo_img_2',
                'active_callback' => array( 'Singleproduct_Customizer', 'callback_product_logos' ),
            )
        ) );
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
            'cnt_product_logo_url_3', array(
	            'label'       => __( 'Odkaz třetího loga', 'singleproduct' ),
	            'section'     => 'singleproduct_product_options',
	            'settings'    => 'product_logo_url_3',
                'type'        => 'url',
                'active_callback' => array( 'Singleproduct_Customizer', 'callback_product_logos' ),
            )
        ) );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize,
            'cnt_product_logo_img_3', array(
                'label'    => __( 'Třetí logo', 'singleproduct' ),
                'section'  => 'singleproduct_product_options',
                'settings' => 'product_logo_img_3',
                'active_callback' => array( 'Singleproduct_Customizer', 'callback_product_logos' ),
            )
        ) );
    }

    /**
     * @internal Register ordersteps banner options.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_ordersteps_options( \WP_Customize_Manager $wp_customize ) {
        
        // Section
        $wp_customize->add_section( 'singleproduct_ordersteps_options', 
            array(
                'title'       => __( 'Postup objednávky', 'singleproduct' ),
                'description' => __( 'Nastavení pro panel s postupem objednávky.', 'singleproduct' ),
                'priority'    => 30,
                'capability'  => 'edit_theme_options',
                'panel'       => self::THEME_PANEL_ID,
            )
        );
        
        // Settings
        $wp_customize->add_setting( 'ordersteps_show' , array(
            'capability' => 'edit_theme_options',
            'default'    => 'yes',
            'type'       => 'option',
        ) );
        $wp_customize->add_setting( 'ordersteps_foreground_color' , array(
            'capability' => 'edit_theme_options',
            'default'    => '#98a0a6',
            'type'       => 'option',
        ) );
        $wp_customize->add_setting( 'ordersteps_background_color_1' , array(
            'capability' => 'edit_theme_options',
            'default'    => '#ecd9d9',
            'type'       => 'option',
        ) );
        $wp_customize->add_setting( 'ordersteps_background_color_2' , array(
            'capability' => 'edit_theme_options',
            'default'    => '#ffffff',
            'type'       => 'option',
        ) );
        $wp_customize->add_setting( 'ordersteps_text_1' , array(
            'capability' => 'edit_theme_options',
            'default'    => __( 'Klikněte na "Objednat PRODUKT"', 'singleproduct' ),
            'type'       => 'option',
        ) );
        $wp_customize->add_setting( 'ordersteps_text_2' , array(
            'capability' => 'edit_theme_options',
            'default'    => __( 'Vyplňte formulář', 'singleproduct' ),
            'type'       => 'option',
        ) );
        $wp_customize->add_setting( 'ordersteps_text_3' , array(
            'capability' => 'edit_theme_options',
            'default'    => __( 'Počkejte, až Vám zavoláme', 'singleproduct' ),
            'type'       => 'option',
        ) );
        
        // Controls
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
     * @internal Register other theme options.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_other_options( \WP_Customize_Manager $wp_customize ) {
        
        // Section
        $wp_customize->add_section( 'singleproduct_other_options', 
            array(
                'title'       => __( 'Další volby', 'singleproduct' ),
                'priority'    => 40,
                'capability'  => 'edit_theme_options',
                'description' => __( 'Další nastavení šablony.', 'singleproduct' ),
                'panel'       => self::THEME_PANEL_ID,
            )
        );
        
        // Settings
        $wp_customize->add_setting( 'product_order_btn_text' , array(
            'capability' => 'edit_theme_options',
            'default'    => __( 'Objednat PRODUKT', 'singleproduct' ),
            'type'       => 'option',
            'transport'  => 'postMessage',
        ) );
        $wp_customize->add_setting( 'product_order_btn_link' , array(
            'capability' => 'edit_theme_options',
            'default'    => __( '#', 'singleproduct' ),
            'type'       => 'option',
            'transport'  => 'postMessage',
        ) );
        $wp_customize->add_setting( 'homepage_post_excerpts_show' , array(
            'capability' => 'edit_theme_options',
            'default'    => 'yes',
            'type'       => 'option',
        ) );
        $wp_customize->add_setting( 'posts_per_page' , array(
            'capability' => 'edit_theme_options',
            'default'    => 6,
            'type'       => 'option',
        ) );
        $wp_customize->add_setting( 'homepage_show_posts_pagination' , array(
            'capability' => 'edit_theme_options',
            'default'    => 'yes',
            'type'       => 'option',
        ) );
        
        // Controls
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
     * @internal Register header/footer options.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_footer_options( \WP_Customize_Manager $wp_customize ) {
        
        // Section
        $wp_customize->add_section( 'singleproduct_footer_options', 
            array(
                'title'       => __( 'Hlavička & Patička', 'singleproduct' ),
                'priority'    => 20,
                'capability'  => 'edit_theme_options',
                'description' => __( 'Nastavení barev pro hlavičku a patičku webu.', 'singleproduct' ),
                'panel'       => self::THEME_PANEL_ID,
            )
        );
        
        // Settings
        $wp_customize->add_setting( 'header_foreground_color' , array(
            'capability' => 'edit_theme_options',
            'default'    => '#000000',
            'type'       => 'option',
        ) );
        $wp_customize->add_setting( 'header_background_color' , array(
            'capability' => 'edit_theme_options',
            'default'    => '#ecd9d9',
            'type'       => 'option',
        ) );
        $wp_customize->add_setting( 'footer_foreground_color' , array(
            'capability' => 'edit_theme_options',
            'default'    => '#ffffff',
            'type'       => 'option',
        ) );
        $wp_customize->add_setting( 'footer_background_color' , array(
            'capability' => 'edit_theme_options',
            'default'    => '#2f1b1b',
            'type'       => 'option',
        ) );
        
        // Controls
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
     * @internal Register Bootstrap related options.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_bootstrap_options( \WP_Customize_Manager $wp_customize ) {

        // Section
        $wp_customize->add_section( 'singleproduct_bootstrap_options', 
            array(
                'title'       => __( 'Bootstrap', 'singleproduct' ),
                'priority'    => 20,
                'capability'  => 'edit_theme_options',
                'description' => __( 'Nastavení pro knihovnu <a href="https://getbootstrap.com/" target="_blank">Bootstrap</a>.', 'singleproduct' ),
                'panel'       => self::THEME_PANEL_ID,
            )
        );
        
        // Settings
        $wp_customize->add_setting( 'bootstrap_theme_option' , array(
            'capability' => 'edit_theme_options',
            'default'    => '---',
            'type'       => 'option',
        ) );
        $wp_customize->add_setting( 'bootstrap_typography' , array(
            'capability' => 'edit_theme_options',
            'default'    => '---',
            'type'       => 'option',
        ) );

        // Controls
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
     * Hook for `wp_head` action.
     * @return void
     * @since 1.0.0
     */
    public static function header_output() {
?>
<style type="text/css">
    .site-title { color: <?php echo get_option( 'header_foreground_color' ) ?>; }
    #page-header { background-color: <?php echo get_option( 'header_background_color' ) ?>; }
    .site-product-logos { display: <?php echo get_option( 'show_product_logos' ) == 'yes' ? 'block' : 'none' ?>; }
    .hp-help-banner {
        background-color: <?php echo get_option( 'ordersteps_background_color_1' ) ?>;
    }
    .hp-help-banner span.help-banner-num {
        background-color: <?php echo get_option( 'ordersteps_background_color_2' ) ?>;
        border-color: <?php echo get_option( 'ordersteps_foreground_color' ) ?>;
        color: <?php echo get_option( 'ordersteps_foreground_color' ) ?>;
    }
    .hp-help-banner span.help-banner-lbl { color: <?php echo get_option( 'ordersteps_foreground_color' ) ?>; }
    .site-footer {
        background-color: <?php echo get_option( 'footer_background_color' ) ?>;
        color: <?php echo get_option( 'footer_foreground_color' ) ?>;
    }
    .site-footer ul.menu li a { color: <?php echo get_option( 'footer_foreground_color' ) ?>; }

    /* There are some invisible edit icons in preview mode and nothing other works... */
    .customize-partial-edit-shortcut-product_logos { left: 50%; }
    .customize-partial-edit-shortcut-header_site_title { left: 31px; top: 0px; }
    .customize-partial-edit-shortcut-product { left: 50%; }
    .customize-partial-edit-shortcut-pagination { left: 45%; }
    .customize-partial-edit-shortcut-ordersteps { left: 31px; }
</style> 
<?php
    }
   
    /**
     * Hook for `customize_preview_init` action.
     * @return void
     * @since 1.0.0
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
     * @internal Register partials for blogame.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    public static function register_blogname_partials( \WP_Customize_Manager $wp_customize ) {
        if( ! isset( $wp_customize->selective_refresh ) ) {
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
     * @internal Register partials for theme's default product.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    public static function register_product_partials( \WP_Customize_Manager $wp_customize ) {
        if( ! isset( $wp_customize->selective_refresh ) ) {
            return;
        }

        $wp_customize->selective_refresh->add_partial( 'product', array(
            'selector'        => '.site-product',
            'settings'        => array( 'site_product_id' ),
        ) );

        $wp_customize->selective_refresh->add_partial( 'product_logos', array(
            'selector'        => '.site-product-logos',
            'settings'        => array( 'show_product_logos', 'product_logo_img_1', 'product_logo_url_1', 'product_logo_img_2', 'product_logo_url_2', 'product_logo_img_3', 'product_logo_url_3' ),
            'render_callback' => array( 'Singleproduct_Customizer' , 'callback_productlogos' ),
        ) );
    }

    /**
     * @internal Register partials for the order steps widget.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    public static function register_ordersteps_partial( \WP_Customize_Manager $wp_customize ) {
        if( ! isset( $wp_customize->selective_refresh ) ) {
            return;
        }

        $wp_customize->selective_refresh->add_partial( 'ordersteps', array(
            'selector'        => '.hp-help-banner',
            'settings'        => array( 'ordersteps_show', 'ordersteps_foreground_color', 'ordersteps_background_color_1', 'ordersteps_background_color_2', 'ordersteps_text_1', 'ordersteps_text_2', 'ordersteps_text_3' ),
            'render_callback' => array( 'Singleproduct_Customizer' , 'callback_ordersteps' ),
        ) );
    }

    /**
     * @internal Register partials for theme's other settings pane.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    public static function register_other_partials( \WP_Customize_Manager $wp_customize ) {
        if( ! isset( $wp_customize->selective_refresh ) ) {
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
     * @internal Active callback for controls around product logos.
     * @param \WP_Customize_Control $control
     * @return boolean
     * @see Singleproduct_Customizer::register_product_options()
     * @since 1.0.0
     */
    public static function callback_product_logos( \WP_Customize_Control $control ) {
        return ( $control->manager->get_setting( 'show_product_logos' )->value() == 'yes' );
    }

    /**
     * @internal Callback for blogname parial.
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
     * @see Singleproduct_Customizer::register_productlogos_partial()
     * @since 1.0.0
     */
    public static function callback_productlogos() {
        return singleproduct_product_logos( false );
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

}

endif;

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'Singleproduct_Customizer' , 'register' ), 999 );
add_action( 'wp_head' , array( 'Singleproduct_Customizer' , 'header_output' ), 999 );
add_action( 'customize_preview_init' , array( 'Singleproduct_Customizer' , 'live_preview' ), 999 );

