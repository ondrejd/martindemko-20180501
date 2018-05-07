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


if ( ! function_exists( 'martindemko_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
     * 
     * Based on `twentyseventeen_entry_footer()` from Twentyseventeen theme.
	 */
	function martindemko_entry_footer() {

		/* translators: used between list items, there is a space after the comma */
		$separate_meta = __( ', ', 'martindemko' );

		$categories_list = get_the_category_list( $separate_meta );
		$tags_list = get_the_tag_list( '', $separate_meta );

		echo '<footer class="entry-footer">';

        echo '<span class="posted-on">'
                . '<span>' . __( 'Publikováno:', 'martindemko' ) . '</span>'
                . martinemko_time_link() . '</span>';

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


if ( ! function_exists( 'martinemko_time_link' ) ) :
	/**
	 * Gets a nicely formatted string for the published date.
     * 
     * Based on `twentyseventeen_time_link()` from Twentyseventeen theme.
	 */
	function martinemko_time_link() {
		return sprintf(
			'<time class="entry-date published updated" datetime="%1$s">%2$s</time>',
			get_the_date( DATE_W3C ),
			get_the_date()
		);
	}
endif;
