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
     * @param boolean $echo (Optional.)
     * @return void
     * @since 1.0.0
     * @uses get_option()
     * @uses wp_get_attachment_image()
     */
    function martindemko_product_logos( $echo = true ) {
        $logo_url_1 = get_option( 'product_logo_url_1', '#' );
        $logo_url_2 = get_option( 'product_logo_url_2', '#' );
        $logo_url_3 = get_option( 'product_logo_url_3', '#' );

        $logo_img_1 = wp_get_attachment_image( get_option( 'product_logo_img_1' ), 'full', false );
        $logo_img_2 = wp_get_attachment_image( get_option( 'product_logo_img_2' ), 'full', false );
        $logo_img_3 = wp_get_attachment_image( get_option( 'product_logo_img_3' ), 'full', false );

        $logo_out_1 = ! empty( $logo_img_1 ) ? '<a href="' . esc_attr( $logo_url_1 ) . '" target="_blank">' . $logo_img_1 . '</a>' : '';
        $logo_out_2 = ! empty( $logo_img_2 ) ? '<a href="' . esc_attr( $logo_url_2 ) . '" target="_blank">' . $logo_img_2 . '</a>' : '';
        $logo_out_3 = ! empty( $logo_img_3 ) ? '<a href="' . esc_attr( $logo_url_3 ) . '" target="_blank">' . $logo_img_3 . '</a>' : '';

        $out = <<<EOC
<div class="site-product-logos">
    <div class="row justify-content-center">
        <div class="col-xs-8 col-sm-8 col-md-4 col-lg-3 col-xl-2 site-product-logo site-product-logo-1">$logo_out_1</div>
        <div class="col-xs-8 col-sm-8 col-md-4 col-lg-3 col-xl-2 site-product-logo site-product-logo-2">$logo_out_2</div>
        <div class="col-xs-8 col-sm-8 col-md-4 col-lg-3 col-xl-2 site-product-logo site-product-logo-3">$logo_out_3</div>
    </div>
</div><!-- .site-product-logos -->
EOC;

        if( $echo === true ) {
            echo $out;
        } else {
            return $out;
        }
    }
endif;


if ( ! function_exists( 'martindemko_hp_help_banner' ) ) :
    /**
     * Prints help banner with steps how to order.
     * @param boolean $echo (Optional.)
     * @return string|void
     * @since 1.0.0
     * @uses esc_html()
     * @uses get_option()
     */
    function martindemko_hp_help_banner( $echo = true ) {

        // Should be order steps visible?
        if( get_option( 'ordersteps_show' ) != 'yes' ) {
            if( $echo === true ) {
                return;
            } else {
                return '';
            }
        }

        $text1 = esc_html( get_option( 'ordersteps_text_1', '' ) );
        $text2 = esc_html( get_option( 'ordersteps_text_2', '' ) );
        $text3 = esc_html( get_option( 'ordersteps_text_3', '' ) );

        $out = <<<EOC
<div class="hp-help-banner">
    <div class="row justify-content-center">
        <div class="col-xs-10 col-sm-8 col-md-10 col-lg-8 col-xs-6">
            <div class="row justify-content-center">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xs-2 hp-help-banner-item">
                    <span class="rounded-circle help-banner-num">1</span>
                    <p class="help-banner-lbl help-banner-lbl-1">$text1</p>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xs-2 hp-help-banner-item">
                    <span class="rounded-circle help-banner-num">2</span>
                    <p class="help-banner-lbl help-banner-lbl-2">$text2</p>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xs-2 hp-help-banner-item">
                    <span class="rounded-circle help-banner-num">3</span>
                    <p class="help-banner-lbl help-banner-lbl-3">$text3</p>
                </div>
            </div>
        </div>
    </div>
</div>
EOC;

        if( $echo === true ) {
            echo $out;
        } else {
            return $out;
        }
    }
endif;


if ( ! function_exists( 'martindemko_posts_pagination' ) ) :
    /**
     * Prints pagination for blog posts on HP.
     * @param boolean $echo (Optional.)
     * @return string|void
     * @since 1.0.0
     * @uses get_option()
     * @uses get_the_posts_pagination()
     */
    function martindemko_posts_pagination( $echo = true ) {
        if( get_option( 'homepage_show_posts_pagination' ) != 'yes' ) {
            if( $echo === true ) {
                return;
            } else {
                return '';
            }
        }

        $nav = get_the_posts_pagination( array(
            'prev_text' => '<span>' . __( '«', 'martindemko' ) . '</span>',
            'next_text' => '<span>' . __( '»', 'martindemko' ) . '</span>',
        ) );

        $out = $out = <<<EOC
<div class="row justify-content-center">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xs-6">$nav</div>
</div>
EOC;

        if( $echo === true ) {
            echo $out;
        } else {
            return $out;
        }
    }
endif;


if ( ! function_exists( 'martindemko_post_navigation' ) ) :
    /**
     * Prints post navigation.
     * @param boolean $echo (Optional.)
     * @return string|void
     * @since 1.0.0
     * @uses get_option()
     * @uses get_the_posts_navigation()
     */
    function martindemko_post_navigation( $echo = true ) {
        if( get_option( 'show_post_navigation' ) != 'yes' ) {
            if( $echo === true ) {
                return;
            } else {
                return '';
            }
        }

        $nav = get_the_post_navigation( array(
            'prev_text' => '<span>' . __( '«', 'martindemko' ) . '</span>',
            'next_text' => '<span>' . __( '»', 'martindemko' ) . '</span>',
        ) );

        $out = $out = <<<EOC
<div class="row justify-content-center">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xs-6">$nav</div>
</div>
EOC;

        if( $echo === true ) {
            echo $out;
        } else {
            return $out;
        }
    }
endif;


if ( ! function_exists( 'martindemko_product_order_button' ) ) :
    /**
     * Prints product order button.
     * @param boolean $echo (Optional.)
     * @return string|void
     * @since 1.0.0
     * @uses esc_attr()
     * @uses esc_html()
     * @uses get_option()
     */
    function martindemko_product_order_button( $echo = true ) {
        $url = esc_attr( get_option( 'product_order_btn_link', '#' ) );
        $lbl = esc_html( get_option( 'product_order_btn_text' ) );
        $out = <<<EOC
<span class="site-product-order-button">
    <a href="$url" class="btn btn-primary">$lbl</a>
</span>
EOC;

        if( $echo === true ) {
            echo $out;
        } else {
            return $out;
        }
    }
endif;


if ( ! function_exists( 'martindemko_site_product' ) ) :
    /**
     * Prints section of site product.
     * @return void
     * @since 1.0.0
     * @uses esc_html()
     * @uses get_option()
     * @uses get_post()
     * @uses get_the_post_thumbnail()
     */
    function martindemko_site_product() {
        $product_ID = get_option( 'site_product_id', null );
        $product = get_post( $product_ID, OBJECT, 'display' );

        if( ! ( $product instanceof \WP_Post ) ) {
            return;
        }

?>
    <div class="site-product">
        <div class="row justify-content-center">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 site-product-card">
            	<div class="post-thumbnail">
		            <a href="<?php the_permalink(); ?>">
                    	<?php if ( '' !== get_the_post_thumbnail( $product_ID ) ) : ?>
			            <?php echo get_the_post_thumbnail( $product_ID, 'martindemko-default-product' ); ?>
                        <?php else: ?>
                        <span class="no-post-thumbnail"></span>
                    	<?php endif; ?>
		            </a>
	            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 site-product-card">
                <h2 class="entry-title">
                    <?php echo esc_html( $product->post_title ); ?>
                </h2>
                <div class="entry-content">
                    <p><?php echo esc_html( $product->post_excerpt ); ?></p>
                </div>
                <div class="entry-footer">
                    <p><?php martindemko_product_order_button(); ?></p>
                </div>
            </div>
        </div>
        <?php martindemko_product_logos(); ?>
    </div><!-- .site-product -->
<?php
    }
endif;

