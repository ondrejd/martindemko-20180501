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

$is_page_type = ( get_post_type() == 'page' );
$additional_class = ( is_single() || $is_page_type ) ? 'col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xs-12' : 'col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-6';

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $additional_class ); ?>>
    <header class="entry-header"><?php
        if ( is_single() || $is_page_type ) {
            the_title( '<h2 class="entry-title">', '</h2>' );
        } else {
            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        }
    ?></header><!-- .entry-header -->

    <div class="post-thumbnail">
        <a href="<?php the_permalink(); ?>"><?php
            if( '' !== get_the_post_thumbnail() ) {
                if( is_single() ) {
                    the_post_thumbnail( 'singleproduct-featured-image' );
                } else {
                    the_post_thumbnail( 'singleproduct-featured-image-small' );
                }
            } else {
                if( ! $is_page_type && ! is_single() ) {
                    echo '<span class="no-post-thumbnail"></span>';
                }
            }
        ?></a>
    </div><!-- .post-thumbnail -->

    <div class="entry-content">
    <?php
        if ( is_single() ) {
            the_content( sprintf(
                __( 'Pokračujte ve čtení<span class="screen-reader-text"> "%s"</span>', 'singleproduct' ),
                get_the_title()
            ) );

            wp_link_pages( array(
                'before'      => '<div class="page-links">' . __( 'Stránky:', 'singleproduct' ),
                'after'       => '</div>',
                'link_before' => '<span class="page-number">',
                'link_after'  => '</span>',
            ) );
        }
        elseif( get_option( 'homepage_post_excerpts_show' ) == 'yes' ) {
            the_content( sprintf(
                __( 'Pokračujte ve čtení<span class="screen-reader-text"> "%s"</span>', 'singleproduct' ),
                get_the_title()
            ) );
        }
    ?>
    </div><!-- .entry-content -->

    <?php
    if ( is_single() ) {
        singleproduct_entry_footer();
        comments_template();
    }
    ?>
</article><!-- #post-## -->
