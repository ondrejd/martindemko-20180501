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

if( ! defined( 'ABSPATH' ) ) {
    exit;
}


// Includes
include( dirname( __FILE__ ) . '/class-md_product_dropdown_wp_customize_control.php' );


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
    public static function register( $wp_customize ) {
        $wp_customize->add_panel( self::THEME_PANEL_ID, array(
            'title' => __( 'Vzhled tématu', 'martindemko' ),
            'description' => __( 'Sdružuje nastavení vzhledu tématu <strong>martindemko-20180501</strong>', 'martindemko' ),
            'priority' => 15,
        ) );

        self::register_product_options( $wp_customize );
        self::register_ordersteps_options( $wp_customize );
        self::register_other_options( $wp_customize );
        self::register_footer_options( $wp_customize );

        $wp_customize->remove_section( 'static_front_page' );
        //$wp_customize->remove_panel( 'nav_menus' );

        $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
        $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
        $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
        $wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
    }

    /**
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_product_options( $wp_customize ) {
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
            'transport'  => 'postMessage',
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
            'transport'  => 'postMessage',
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
            'transport'  => 'postMessage',
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
            'transport'  => 'postMessage',
        ) );
        // Controls
        $wp_customize->add_control( new MD_Product_Dropdown_WP_Customize_Control( $wp_customize, 
            'cnt_site_product_id', array(
                'label'       => __( 'Produkt', 'martindemko' ),
                'description' => __( 'Vyberte defaultní produkt tématu', 'martindemko' ),
                'section'     => 'martindemko_product_options',
                'settings'    => 'site_product_id',
            )
        ) );
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
     * @internal Active callback for controls around product logos.
     * @param WP_Cusomize_Control $control
     * @return boolean
     * @since 1.0.0
     */
    public static function callback_product_logos( $control ) {
        return ( $control->manager->get_setting( 'show_product_logos' )->value() === 'yes' );
    }

    /**
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_ordersteps_options( $wp_customize ) {
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
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_other_options( $wp_customize ) {
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
        // Controls
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
            'cnt_product_order_btn_text', array(
	            'label'       => __( 'Text tlačítka objednat', 'martindemko' ),
                'description' => __( 'Tato změna se projeví u obou tlačítek objednat.   ', 'martindemko' ),
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
    }

    /**
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    protected static function register_footer_options( $wp_customize ) {
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
            'transport'  => 'postMessage',
        ) );
        $wp_customize->add_setting( 'header_background_color' , array(
            'capability' => 'edit_theme_options',
            'default'    => '#ecd9d9',
            'type'       => 'option',
            'transport'  => 'postMessage',
        ) );
        $wp_customize->add_setting( 'footer_foreground_color' , array(
            'capability' => 'edit_theme_options',
            'default'    => '#ffffff',
            'type'       => 'option',
            'transport'  => 'postMessage',
        ) );
        $wp_customize->add_setting( 'footer_background_color' , array(
            'capability' => 'edit_theme_options',
            'default'    => '#2f1b1b',
            'type'       => 'option',
            'transport'  => 'postMessage',
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
     * @return void
     * @since 1.0.0
     */
    public static function header_output() {
?>
<style type="text/css">
    .navbar-brand { color: <?php echo get_option( 'header_foreground_color' ) ?>; }
    .navbar { background-color: <?php echo get_option( 'header_background_color' ) ?>; }
    .site-product-logos { display: <?php echo get_option( 'show_product_logos' ) == 'yes' ? 'block' : 'none' ?>; }
    .hp-help-banner {
        background-color: <?php echo get_option( 'ordersteps_background_color_1' ) ?>;
        display: <?php echo get_option( 'ordersteps_show' ) == 'yes' ? 'block' : 'none' ?>;
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
</style> 
<?php
    }
   
    /**
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
}

endif;

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'MD_Customize' , 'register' ), 99 );
add_action( 'wp_head' , array( 'MD_Customize' , 'header_output' ), 99 );
add_action( 'customize_preview_init' , array( 'MD_Customize' , 'live_preview' ), 99 );

