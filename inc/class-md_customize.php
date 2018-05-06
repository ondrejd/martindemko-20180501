<?php
/**
 * WordPress plugin "odwp-mdct" that customizes WordPress with 
 * Twentyseventeen theme installed.
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
 * @link https://github.com/ondrejd/odwp-mdct for the canonical source repository
 * @package odwp-mdct
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
    /**
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     * @since 1.0.0
     */
    public static function register( $wp_customize ) {
        self::register_product_options( $wp_customize );
        self::register_other_options( $wp_customize );

        $wp_customize->remove_section( 'static_front_page' );

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
                'priority'    => 35,
                'capability'  => 'edit_theme_options',
                'description' => __( 'Nastavení pro produkt, kterému je web věnován.', 'martindemko' ),
            )
        );
        // Settings
        $wp_customize->add_setting( 'site_product_id' , array(
            'capability' => 'edit_theme_options',
            'default'    => 0,
            'type'       => 'option',
        ) );
        // Controls
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
            'cnt_site_product_id', array(
	            'label'    => __( 'ID produktu', 'martindemko' ),
	            'section'  => 'martindemko_product_options',
	            'settings' => 'site_product_id',
                'type'     => 'number',
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
                'title'       => __( 'Volby tématu', 'martindemko' ),
                'priority'    => 35,
                'capability'  => 'edit_theme_options',
                'description' => __( 'Nastavení pro téma Martin Demko Produktová šablona.', 'martindemko' ),
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
        $wp_customize->add_setting( 'header_foreground_color' , array(
            'capability' => 'edit_theme_options',
            'default'    => '000000',
            'type'       => 'option',
            'transport'  => 'postMessage',
        ) );
        $wp_customize->add_setting( 'header_background_color' , array(
            'capability' => 'edit_theme_options',
            'default'    => 'ecd9d9',
            'type'       => 'option',
            'transport'  => 'postMessage',
        ) );
        // Controls
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
            'cnt_product_order_btn_text', array(
	            'label'    => __( 'Text tlačítka objednat', 'martindemko' ),
                'description' => __( 'Tato změna se projeví u obou tlačítek objednat.', 'martindemko' ),
	            'section'  => 'martindemko_other_options',
	            'settings' => 'product_order_btn_text',
                'type'     => 'text',
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

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 
            'cnt_header_foreground_color', array(
	            'label'    => __( 'Barva textu hlavního nadpisu', 'martindemko' ),
	            'section'  => 'martindemko_other_options',
	            'settings' => 'header_foreground_color',
            )
        ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 
            'cnt_header_background_color', array(
	            'label'    => __( 'Barva pozadí hlavičky', 'martindemko' ),
	            'section'  => 'martindemko_other_options',
	            'settings' => 'header_background_color',
            )
        ) );
    }

    /**
     * @return void
     * @since 1.0.0
     */
    public static function header_output() {
?>
<!--Customizer CSS--> 
<style type="text/css">
    .site-header .site-title a { color: <?php echo get_option( 'header_foreground_color', '#000000' ) ?>; }
    .site-header { background-color: <?php echo get_option( 'header_background_color', '#ecd9d9' ) ?>; }
</style> 
<!--/Customizer CSS-->
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
add_action( 'customize_register' , array( 'MD_Customize' , 'register' ) );
add_action( 'wp_head' , array( 'MD_Customize' , 'header_output' ) );
add_action( 'customize_preview_init' , array( 'MD_Customize' , 'live_preview' ) );

