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


if ( ! function_exists( 'martindemko_entry_footer' ) ) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     * Based on `twentyseventeen_entry_footer()` from Twentyseventeen theme.
     * @return void
     * @since 1.0.0
     * @uses get_the_category_list()
     * @uses get_the_tag_list()
     * @uses get_the_author()
     * @uses get_post_type()
     * @uses is_wp_error()
     */
    function martindemko_entry_footer() {

        /* translators: used between list items, there is a space after the comma */
        $separate_meta = __( ', ', 'martindemko' );

        $categories_list = get_the_category_list( $separate_meta );
        $tags_list = get_the_tag_list( '', $separate_meta );

        echo '<footer class="entry-footer">';

        echo '<span class="posted-on">'
            . '<span>' . __( 'Publikováno:', 'martindemko' ) . '</span>'
            . martindemko_time_link() . '</span>';

        echo '<span class="posted-by">'
            . '<span>' . __( 'Autor:', 'martindemko' ) . '</span>'
            . get_the_author() . '</span>';

        if ( 'post' === get_post_type() ) {
            if ( $categories_list || $tags_list ) {
                echo '<span class="cat-tags-links">';

                if ( $categories_list ) {
                    echo '<span class="cat-links">'
                        . '<span>' . __( 'Kategorie:', 'martindemko' ) . '</span>'
                        . $categories_list . '</span>';
                }

                if ( $tags_list && ! is_wp_error( $tags_list ) ) {
                    echo '<span class="tags-links">'
                        . '<span>' . __( 'Tagy:', 'martindemo' ) . '</span>'
                        . $tags_list . '</span>';
                }

                echo '</span>';
            }
        }

        echo '</footer><!-- .entry-footer -->';
    }
endif;


if ( ! function_exists( 'martindemko_time_link' ) ) :
    /**
     * Gets a nicely formatted string for the published date.
     * Based on `twentyseventeen_time_link()` from Twentyseventeen theme.
     * @return void
     * @since 1.0.0
     * @uses get_the_date()
     */
    function martindemko_time_link() {
        return sprintf(
            '<time class="entry-date published updated" datetime="%1$s">%2$s</time>',
            get_the_date( DATE_W3C ),
            get_the_date()
        );
    }
endif;


if ( ! function_exists( 'martindemko_product_logos' ) ) :
    /**
     * Prints product logos.
     * @return void
     * @since 1.0.0
     * @uses get_option()
     * @uses wp_get_attachment_image()
     */
    function martindemko_product_logos() {
        $product_logo_url_1 = get_option( 'product_logo_url_1', '#' );
        $product_logo_url_2 = get_option( 'product_logo_url_2', '#' );
        $product_logo_url_3 = get_option( 'product_logo_url_3', '#' );

        $product_logo_img_1 = wp_get_attachment_image( get_option( 'product_logo_img_1' ), 'full', false );
        $product_logo_img_2 = wp_get_attachment_image( get_option( 'product_logo_img_2' ), 'full', false );
        $product_logo_img_3 = wp_get_attachment_image( get_option( 'product_logo_img_3' ), 'full', false );
?>
        <div class="site-product-logos">
            <div class="row justify-content-center">
                <div class="col-xs-8 col-sm-8 col-md-4 col-lg-3 col-xl-2 site-product-logo site-product-logo-1">
                    <?php if( ! empty( $product_logo_img_1 ) ) : ?>
                    <a href="<?php echo esc_attr( $product_logo_url_1 ) ?>" target="_blank">
                        <?php echo $product_logo_img_1; ?>
                    </a>
                    <?php endif; ?>
                </div>
                <div class="col-xs-8 col-sm-8 col-md-4 col-lg-3 col-xl-2 site-product-logo site-product-logo-2">
                    <?php if( ! empty( $product_logo_img_2 ) ) : ?>
                    <a href="<?php echo esc_attr( $product_logo_url_2 ) ?>" target="_blank">
                        <?php echo $product_logo_img_2; ?>
                    </a>
                    <?php endif; ?>
                </div>
                <div class="col-xs-8 col-sm-8 col-md-4 col-lg-3 col-xl-2 site-product-logo site-product-logo-3">
                    <?php if( ! empty( $product_logo_img_3 ) ) : ?>
                    <a href="<?php echo esc_attr( $product_logo_url_3 ) ?>" target="_blank">
                        <?php echo $product_logo_img_3; ?>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div><!-- .site-product-logos -->
<?php
    }
endif;
