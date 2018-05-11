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


if( !class_exists( 'MD_Customize' ) ) :

/**
 * Contains methods for customizing the theme customization screen.
 * @author Ondřej Doně, <ondejd@gmil.com>
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since 1.0.0
 */
class MD_Customize {
    const THEME_PANEL_ID = 'martindemko_theme_panel';

    /**
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    public static function register( \WP_Customize_Manager $wp_customize ) {
        $wp_customize->add_panel( self::THEME_PANEL_ID, array(
            'title' => __( 'Vzhled tématu', 'martindemko' ),
            'description' => __( 'Sdružuje nastavení vzhledu tématu <strong>martindemko-20180501</strong>', 'martindemko' ),
            'priority' => 15,
        ) );

        self::register_product_options( $wp_customize );
        self::register_ordersteps_options( $wp_customize );
        self::register_other_options( $wp_customize );
        self::register_footer_options( $wp_customize );
        self::register_bootstrap_options( $wp_customize );

        self::register_blogname_partials( $wp_customize );
        self::register_orderbtn_partial( $wp_customize );
        self::register_product_partials( $wp_customize );
        self::register_productlogos_partial( $wp_customize );
        self::register_footer_partial( $wp_customize );
        self::register_ordersteps_partial( $wp_customize );

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
        $wp_customize->add_section( 'martindemko_product_options', 
            array(
                'title'       => __( 'Produkt', 'martindemko' ),
                'priority'    => 10,
                'capability'  => 'edit_theme_options',
                'description' => __( 'Nastavení pro produkt, kterému je web věnován.', 'martindemko' ),
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
                    'label'       => __( 'Produkt', 'martindemko' ),
                    'description' => __( 'Vyberte defaultní produkt tématu', 'martindemko' ),
                    'section'     => 'martindemko_product_options',
                    'settings'    => 'site_product_id',
                )
            ) );
        } else {

            // Failsafe control
            $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
                'cnt_site_product_id', array(
                    'label'       => __( 'ID produktu', 'martindemko' ),
                    'description' => __( 'Zadejte ID defaultního produktu', 'martindemko' ),
                    'section'     => 'martindemko_product_options',
                    'settings'    => 'site_product_id',
                    'type'        => 'number',
                )
            ) );
        }

        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
            'cnt_show_product_logos', array(
	            'label'       => __( 'Zobrazit loga produktu', 'martindemko' ),
	            'description' => __( 'Zobrazí panel s třemi logy - ty musí být nastaveny v šabloně v souboru <code>header.php</code>', 'martindemko' ),
	            'section'     => 'martindemko_product_options',
	            'settings'    => 'show_product_logos',
                'type'        => 'select',
                'choices' => array(
                    'yes' => __( 'Ano', 'martindemko' ),
                    'no'  => __( 'Ne', 'martindemko' ),
                )
            )
        ) );
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
            'cnt_product_logo_url_1', array(
	            'label'           => __( 'Odkaz prvního loga', 'martindemko' ),
	            'section'         => 'martindemko_product_options',
	            'settings'        => 'product_logo_url_1',
                'type'            => 'url',
                'active_callback' => array( 'MD_Customize', 'callback_product_logos' ),
            )
        ) );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize,
            'cnt_product_logo_img_1', array(
                'label'    => __( 'První logo', 'martindemko' ),
                'section'  => 'martindemko_product_options',
                'settings' => 'product_logo_img_1',
                'active_callback' => array( 'MD_Customize', 'callback_product_logos' ),
            )
        ) );
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
            'cnt_product_logo_url_2', array(
	            'label'       => __( 'Odkaz druhého loga', 'martindemko' ),
	            'section'     => 'martindemko_product_options',
	            'settings'    => 'product_logo_url_2',
                'type'        => 'url',
                'active_callback' => array( 'MD_Customize', 'callback_product_logos' ),
            )
        ) );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize,
            'cnt_product_logo_img_2', array(
                'label'    => __( 'Druhé logo', 'martindemko' ),
                'section'  => 'martindemko_product_options',
                'settings' => 'product_logo_img_2',
                'active_callback' => array( 'MD_Customize', 'callback_product_logos' ),
            )
        ) );
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
            'cnt_product_logo_url_3', array(
	            'label'       => __( 'Odkaz třetího loga', 'martindemko' ),
	            'section'     => 'martindemko_product_options',
	            'settings'    => 'product_logo_url_3',
                'type'        => 'url',
                'active_callback' => array( 'MD_Customize', 'callback_product_logos' ),
            )
        ) );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize,
            'cnt_product_logo_img_3', array(
                'label'    => __( 'Třetí logo', 'martindemko' ),
                'section'  => 'martindemko_product_options',
                'settings' => 'product_logo_img_3',
                'active_callback' => array( 'MD_Customize', 'callback_product_logos' ),
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
        $wp_customize->add_section( 'martindemko_ordersteps_options', 
            array(
                'title'       => __( 'Postup objednávky', 'martindemko' ),
                'description' => __( 'Nastavení pro panel s postupem objednávky.', 'martindemko' ),
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
            'transport'  => 'postMessage',
        ) );
        $wp_customize->add_setting( 'ordersteps_foreground_color' , array(
            'capability' => 'edit_theme_options',
            'default'    => '#98a0a6',
            'type'       => 'option',
            'transport'  => 'postMessage',
        ) );
        $wp_customize->add_setting( 'ordersteps_background_color_1' , array(
            'capability' => 'edit_theme_options',
            'default'    => '#ecd9d9',
            'type'       => 'option',
            'transport'  => 'postMessage',
        ) );
        $wp_customize->add_setting( 'ordersteps_background_color_2' , array(
            'capability' => 'edit_theme_options',
            'default'    => '#ffffff',
            'type'       => 'option',
            'transport'  => 'postMessage',
        ) );
        $wp_customize->add_setting( 'ordersteps_text_1' , array(
            'capability' => 'edit_theme_options',
            'default'    => __( 'Klikněte na "Objednat PRODUKT"', 'martindemko' ),
            'type'       => 'option',
            'transport'  => 'postMessage',
        ) );
        $wp_customize->add_setting( 'ordersteps_text_2' , array(
            'capability' => 'edit_theme_options',
            'default'    => __( 'Vyplňte formulář', 'martindemko' ),
            'type'       => 'option',
            'transport'  => 'postMessage',
        ) );
        $wp_customize->add_setting( 'ordersteps_text_3' , array(
            'capability' => 'edit_theme_options',
            'default'    => __( 'Počkejte, až Vám zavoláme', 'martindemko' ),
            'type'       => 'option',
            'transport'  => 'postMessage',
        ) );
        
        // Controls
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
            'cnt_ordersteps_show', array(
	            'label'       => __( 'Zobrazit postup objednávky', 'martindemko' ),
	            'section'     => 'martindemko_ordersteps_options',
	            'settings'    => 'ordersteps_show',
                'type'        => 'select',
                'choices' => array(
                    'yes' => __( 'Ano', 'martindemko' ),
                    'no'  => __( 'Ne', 'martindemko' ),
                )
            )
        ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 
            'cnt_ordersteps_foreground_color', array(
	            'label'    => __( 'Barva textu', 'martindemko' ),
	            'section'  => 'martindemko_ordersteps_options',
	            'settings' => 'ordersteps_foreground_color',
            )
        ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 
            'cnt_ordersteps_background_color_1', array(
	            'label'    => __( 'Barva hlavního pozadí', 'martindemko' ),
	            'section'  => 'martindemko_ordersteps_options',
	            'settings' => 'ordersteps_background_color_1',
            )
        ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 
            'cnt_ordersteps_background_color_2', array(
	            'label'    => __( 'Barva pozadí kruhů', 'martindemko' ),
	            'section'  => 'martindemko_ordersteps_options',
	            'settings' => 'ordersteps_background_color_2',
            )
        ) );
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
            'cnt_ordersteps_text_1', array(
	            'label'       => __( 'První krok', 'martindemko' ),
	            'description' => __( 'Text pro první krok', 'martindemko' ),
	            'section'     => 'martindemko_ordersteps_options',
	            'settings'    => 'ordersteps_text_1',
            )
        ) );
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
            'cnt_ordersteps_text_2', array(
	            'label'       => __( 'Druhý krok', 'martindemko' ),
	            'description' => __( 'Text pro druhý krok', 'martindemko' ),
	            'section'     => 'martindemko_ordersteps_options',
	            'settings'    => 'ordersteps_text_2',
            )
        ) );
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
            'cnt_ordersteps_text_3', array(
	            'label'       => __( 'Třetí krok', 'martindemko' ),
	            'description' => __( 'Text pro třetí krok', 'martindemko' ),
	            'section'     => 'martindemko_ordersteps_options',
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
        $wp_customize->add_section( 'martindemko_other_options', 
            array(
                'title'       => __( 'Další volby', 'martindemko' ),
                'priority'    => 40,
                'capability'  => 'edit_theme_options',
                'description' => __( 'Další nastavení šablony.', 'martindemko' ),
                'panel'       => self::THEME_PANEL_ID,
            )
        );
        
        // Settings
        $wp_customize->add_setting( 'product_order_btn_text' , array(
            'capability' => 'edit_theme_options',
            'default'    => __( 'Objednat PRODUKT', 'martindemko' ),
            'type'       => 'option',
            'transport'  => 'postMessage',
        ) );
        $wp_customize->add_setting( 'product_order_btn_link' , array(
            'capability' => 'edit_theme_options',
            'default'    => __( '#', 'martindemko' ),
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
	            'label'       => __( 'Text tlačítka objednat', 'martindemko' ),
                'description' => __( 'Tato změna se projeví u všech obednávacích tlačítek.   ', 'martindemko' ),
	            'section'     => 'martindemko_other_options',
	            'settings'    => 'product_order_btn_text',
                'type'        => 'text',
            )
        ) );
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
            'cnt_product_order_btn_link', array(
	            'label'    => __( 'Odkaz tlačítka objednat', 'martindemko' ),
	            'section'  => 'martindemko_other_options',
	            'settings' => 'product_order_btn_link',
                'type'     => 'url',
            )
        ) );
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
            'cnt_homepage_post_excerpts_show', array(
	            'label'       => __( 'Zobrazit texty příspěvků', 'martindemko' ),
	            'description' => __( 'Zobrazit texty příspěvků blogu na úvodní stránce?', 'martindemko' ),
	            'section'     => 'martindemko_other_options',
	            'settings'    => 'homepage_post_excerpts_show',
                'type'        => 'select',
                'choices'     => array(
                    'yes'     => __( 'Ano', 'martindemko' ),
                    'no'      => __( 'Ne', 'martindemko' ),
                )
            )
        ) );
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
            'cnt_posts_per_page', array(
	            'label'       => __( 'Počet přísěvků', 'martindemko' ),
	            'description' => __( 'Počet přípěvků, které se mají na úvodní stránce zobrazit.', 'martindemko' ),
	            'section'     => 'martindemko_other_options',
	            'settings'    => 'posts_per_page',
                'type'        => 'number',
                'input_attrs' => array( 'min' => 2, 'step' => 1 ),
            )
        ) );
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
            'cnt_homepage_show_posts_pagination', array(
	            'label'       => __( 'Zobrazit stránkování', 'martindemko' ),
	            'description' => __( 'Zobrazi stránkováí pokud počet příspěvků překročí daný počet k zobrazení?', 'martindemko' ),
	            'section'     => 'martindemko_other_options',
	            'settings'    => 'homepage_show_posts_pagination',
                'type'        => 'select',
                'choices'     => array(
                    'yes'     => __( 'Ano', 'martindemko' ),
                    'no'      => __( 'Ne', 'martindemko' ),
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
        $wp_customize->add_section( 'martindemko_footer_options', 
            array(
                'title'       => __( 'Hlavička & Patička', 'martindemko' ),
                'priority'    => 20,
                'capability'  => 'edit_theme_options',
                'description' => __( 'Nastavení pro patičku webu.', 'martindemko' ),
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
	            'label'    => __( 'Barva textu hlavního nadpisu', 'martindemko' ),
	            'section'  => 'martindemko_footer_options',
	            'settings' => 'header_foreground_color',
            )
        ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 
            'cnt_header_background_color', array(
	            'label'    => __( 'Barva pozadí hlavičky', 'martindemko' ),
	            'section'  => 'martindemko_footer_options',
	            'settings' => 'header_background_color',
            )
        ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 
            'cnt_footer_foreground_color', array(
	            'label'    => __( 'Barva textu', 'martindemko' ),
	            'section'  => 'martindemko_footer_options',
	            'settings' => 'footer_foreground_color',
            )
        ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 
            'cnt_footer_background_color', array(
	            'label'    => __( 'Barva pozadí', 'martindemko' ),
	            'section'  => 'martindemko_footer_options',
	            'settings' => 'footer_background_color',
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
        $wp_customize->add_section( 'martindemko_bootstrap_options', 
            array(
                'title'       => __( 'Bootstrap', 'martindemko' ),
                'priority'    => 20,
                'capability'  => 'edit_theme_options',
                'description' => __( 'Nastavení pro knihovnu <a href="https://getbootstrap.com/" target="_blank">Bootstrap</a>.', 'martindemko' ),
                'panel'       => self::THEME_PANEL_ID,
            )
        );
        
        // Settings
        $wp_customize->add_setting( 'bootstrap_color_theme' , array(
            'capability' => 'edit_theme_options',
            'default'    => '---',
            'type'       => 'option',
        ) );
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
            'cnt_bootstrap_color_theme', array(
                'label'       => __( 'Barevné schéma', 'martindemko' ),
                'description' => __( 'Vyberte si jedno z před-definovaných barevných schémat knihovny <strong>Bootstrap</strong>.', 'martindemko' ),
                'section'     => 'martindemko_bootstrap_options',
                'settings'    => 'bootstrap_color_theme',
                'type'        => 'select',
                'choices'     => array(
                    '---'     => __( '--- Vyberte ---', 'martindemko' ),
                    'red'     => __( 'Červená', 'martindemko' ),
                    'blue'    => __( 'Modrá', 'martindemko' ),
                    'orange'  => __( 'Oranžová', 'martindemko' ),
                    'pink'    => __( 'Růžová', 'martindemko' ),
                    'green'   => __( 'Zelená', 'martindemko' ),
                )
            )
        ) );
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
            'cnt_bootstrap_theme_option', array(
                'label'       => __( 'Možnost tématu', 'martindemko' ),
                'description' => __( 'Vyberte si jednu z před-definovaných možností knihovny <strong>Bootstrap</strong>.', 'martindemko' ),
                'section'     => 'martindemko_bootstrap_options',
                'settings'    => 'bootstrap_theme_option',
                'type'        => 'select',
                'choices'     => array(
                    '---'       => __( '--- Vyberte ---', 'martindemko' ),
                    'cerulean'  => __( 'Cerulean', 'martindemko' ),
                    'cosmo'     => __( 'Cosmo', 'martindemko' ),
                    'cyborg'    => __( 'Cyborg', 'martindemko' ),
                    'darkly'    => __( 'Darkly', 'martindemko' ),
                    'flatly'    => __( 'Flatly', 'martindemko' ),
                    'journal'   => __( 'Journal', 'martindemko' ),
                    'litera'    => __( 'Litera', 'martindemko' ),
                    'lumen'     => __( 'Lumen', 'martindemko' ),
                    'lux'       => __( 'Lux', 'martindemko' ),
                    'materia'   => __( 'Materia', 'martindemko' ),
                    'minty'     => __( 'Minty', 'martindemko' ),
                    'pulse'     => __( 'Pulse', 'martindemko' ),
                    'sandstone' => __( 'Sandstone', 'martindemko' ),
                    'simplex'   => __( 'Simplex', 'martindemko' ),
                    'sketchy'   => __( 'Sketchy', 'martindemko' ),
                    'slate'     => __( 'Slate', 'martindemko' ),
                    'solar'     => __( 'Solar', 'martindemko' ),
                    'spacelab'  => __( 'SpaceLab', 'martindemko' ),
                    'superhero' => __( 'SuperHero', 'martindemko' ),
                    'united'    => __( 'United', 'martindemko' ),
                    'yeti'      => __( 'Yeti', 'martindemko' ),
                )
            )
        ) );
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
            'cnt_bootstrap_typography', array(
                'label'       => __( 'Typografie', 'martindemko' ),
                'description' => __( 'Vyberte si jednu z před-definovaných typografických standardů knihovny <strong>Bootstrap</strong>.', 'martindemko' ),
                'section'     => 'martindemko_bootstrap_options',
                'settings'    => 'bootstrap_typography',
                'type'        => 'select',
                'choices'     => array(
                    '---' => __( '--- Vyberte ---', 'martindemko' ),
                    'a-o' => __( 'ArbutussLab - OpenSans', 'martindemko' ),
                    'm-m' => __( 'MontSerrat - MerriWeather', 'martindemko' ),
                    'm-o' => __( 'MontSerrat - OpenSans', 'martindemko' ),
                    'o-m' => __( 'Oswald - Muli', 'martindemko' ),
                    'p-l' => __( 'Poppins - Lora', 'martindemko' ),
                    'p-p' => __( 'Poppins - Poppins', 'martindemko' ),
                    'r-r' => __( 'Roboto - Roboto', 'martindemko' ),
                    's-r' => __( 'RobotoSlab - Roboto', 'martindemko' ),
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
    .customize-partial-edit-shortcut-product_logos { left: 50%; float: none; }
    .customize-partial-edit-shortcut-header_site_title { left: 31px; top: 0px; }
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
            'render_callback' => array( 'MD_Customize' , 'callback_site_title' ),
        ) );

        $wp_customize->selective_refresh->add_partial( 'document_title', array(
            'selector'        => 'head > title',
            'settings'        => array( 'blogname' ),
            'render_callback' => 'wp_get_document_title',
        ) );
    }

    /**
     * @internal Register partials for product order button.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    public static function register_orderbtn_partial( \WP_Customize_Manager $wp_customize ) {
        if( ! isset( $wp_customize->selective_refresh ) ) {
            return;
        }

        $wp_customize->selective_refresh->add_partial( 'product_order_button', array(
            'selector'        => '.site-product-order-button',
            'settings'        => array( 'product_order_btn_text', 'product_order_btn_link' ),
            'render_callback' => array( 'MD_Customize' , 'callback_order_button' ),
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

        $wp_customize->selective_refresh->add_partial( 'product_thumbnail', array(
            'selector'        => '.site-product .post-thumbnail',
            'settings'        => array( 'site_product_id' ),
            'render_callback' => array( 'MD_Customize' , 'callback_product_thumbnail' ),
        ) );

        $wp_customize->selective_refresh->add_partial( 'product_title', array(
            'selector'        => '.site-product .entry-title',
            'settings'        => array( 'site_product_id' ),
            'render_callback' => array( 'MD_Customize' , 'callback_product_title' ),
        ) );

        $wp_customize->selective_refresh->add_partial( 'product_excerpt', array(
            'selector'        => '.site-product .entry-content',
            'settings'        => array( 'site_product_id' ),
            'render_callback' => array( 'MD_Customize' , 'callback_product_excerpt' ),
        ) );
    }

    /**
     * @internal Register partial for the logos beneath the product.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    public static function register_productlogos_partial( \WP_Customize_Manager $wp_customize ) {
        if( ! isset( $wp_customize->selective_refresh ) ) {
            return;
        }

        $wp_customize->selective_refresh->add_partial( 'product_logos', array(
            'selector'        => '.site-product-logos',
            'settings'        => array( 'show_product_logos', 'product_logo_img_1', 'product_logo_url_1', 'product_logo_img_2', 'product_logo_url_2', 'product_logo_img_3', 'product_logo_url_3' ),
            'render_callback' => array( 'MD_Customize' , 'callback_productlogos' ),
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
            'render_callback' => array( 'MD_Customize' , 'callback_ordersteps' ),
        ) );
    }

    /**
     * @internal Register partials for the footer.
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    public static function register_footer_partial( \WP_Customize_Manager $wp_customize ) {
        if( ! isset( $wp_customize->selective_refresh ) ) {
            return;
        }

        //...
    }

    /**
     * @internal Active callback for controls around product logos.
     * @param \WP_Customize_Control $control
     * @return boolean
     * @see MD_Customize::register_product_options()
     * @since 1.0.0
     */
    public static function callback_product_logos( \WP_Customize_Control $control ) {
        return ( $control->manager->get_setting( 'show_product_logos' )->value() == 'yes' );
    }

    /**
     * @internal Callback for blogname parial.
     * @return void
     * @see MD_Customize::register_blogname_partials()
     * @since 1.0.0
     * @uses get_bloginfo()
     */
    public static function callback_site_title() {
        return get_bloginfo( 'name', 'display' );
    }

    /**
     * @internal Callback for product order button parial.
     * @return void
     * @see MD_Customize::register_orderbtn_partial()
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
     * @internal Callback for partial with thumbnail of theme's default product.
     * @return void
     * @see MD_Customize::register_product_partials()
     * @since 1.0.0
     * @uses get_option()
     * @uses get_post()
     * @uses get_the_post_thumbnail()
     */
    public static function callback_product_thumbnail() {
        $product_ID = get_option( 'site_product_id', null );
        $product = get_post( $product_ID, OBJECT, 'display' );

        if( ! ( $product instanceof \WP_Post ) ) {
            return '';
        }

        $html = '<a href="#">';

        if( '' !== get_the_post_thumbnail( $product_ID ) ) {
            $html .= get_the_post_thumbnail( $product_ID, 'martindemko-default-product' );
        } else {
            $html .= '<span class="no-post-thumbnail"></span>';
        }

        $html .= '</a>';

        return $html;
    }

    /**
     * @internal Callback for partial with title of theme's default product.
     * @return void
     * @see MD_Customize::register_product_partials()
     * @since 1.0.0
     * @uses get_option()
     * @uses get_post()
     */
    public static function callback_product_title() {
        $product_ID = get_option( 'site_product_id', null );
        $product = get_post( $product_ID, OBJECT, 'display' );

        if( ! ( $product instanceof \WP_Post ) ) {
            return '';
        }

        return esc_html( $product->post_title );
    }

    /**
     * @internal Callback for partial with excerpt of theme's default product.
     * @return void
     * @see MD_Customize::register_product_partials()
     * @since 1.0.0
     * @uses esc_html()
     * @uses get_option()
     * @uses get_post()
     */
    public static function callback_product_excerpt() {
        $product_ID = get_option( 'site_product_id', null );
        $product = get_post( $product_ID, OBJECT, 'display' );

        if( ! ( $product instanceof \WP_Post ) ) {
            return '';
        }

        return '<p>' . esc_html( $product->post_excerpt ) . '</p>';
    }

    /**
     * @internal Callback for partial with order steps.
     * @return void
     * @see MD_Customize::register_productlogos_partial()
     * @since 1.0.0
     */
    public static function callback_productlogos() {
        return martindemko_product_logos( false );
    }

    /**
     * @internal Callback for partial with order steps.
     * @return void
     * @see MD_Customize::register_ordersteps_partial()
     * @since 1.0.0
     */
    public static function callback_ordersteps() {
        return martindemko_hp_help_banner( false );
    }

}

endif;

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'MD_Customize' , 'register' ), 999 );
add_action( 'wp_head' , array( 'MD_Customize' , 'header_output' ), 999 );
add_action( 'customize_preview_init' , array( 'MD_Customize' , 'live_preview' ), 999 );
