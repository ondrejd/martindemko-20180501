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


if ( ! class_exists( 'Single_Product_Cpt' ) ) :

/**
 * Class that implements all what necessary for our CPT.
 * @author Ondřej Doněk, <ondrejd@gmail.com>
 * @since 1.0.0
 */
class Single_Product_Cpt {

    const SLUG = 'singleproduct';

    /**
     * Constructor.
     * @return void
     * @since 1.0.0
     */
    function __construct() {
        add_action( 'init', array( $this, 'init' ) );
    }

    /**
     * Initialize our CPT.
     * @return void
     * @since 1.0.0
     * @todo Add more labels!
     */
    function init() {
        register_post_type( self::SLUG, array(
            'labels' => array(
                'name' => __( 'Products', 'singleproduct' ),
                'singular_name' => __( 'Product', 'singleproduct' )
            ),
            'description' => __( 'Products custom post type', 'singleproduct' ),
            'public' => true,
            'has_archive' => true,
            'menu_positions' => 21,
            'menu_icon' => 'dashicons-paperclip',
            'hierarchical' => false,
            'supports' => array( 'title', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'comments', 'revisions', 'page-attributes' ),
            'delete_with_user' => false,
            'show_in_rest' => false,
            'slug' => array( __( 'product', 'singleproduct' ) )
        ) );
    }

}

endif;

// Initialize CPT
new Single_Product_Cpt();

