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

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

$comments_count = get_comments_number();

?>

<div id="comments" class="comments-area">
    <?php if ( have_comments() ) : ?>

	<h2 class="comments-title">
        <?php esc_html_e( 'Komentáře', 'singleproduct' ); ?>
        <?php if( $comments_count == 1 ) : ?>
        <small>(<?php printf( __( '%1$s odpověď', 'singleproduct' ), $comments_count ); ?>)</small>
        <?php elseif( $comments_count > 1 && $comments_count < 5 ) : ?>
        <small>(<?php printf( __( '%1$s odpovědi', 'singleproduct' ), $comments_count ); ?>)</small>
        <?php elseif( $comments_count > 4 ) : ?>
        <small>(<?php printf( __( '%1$s odpovědí', 'singleproduct' ), $comments_count ); ?>)</small>
        <?php endif; ?>
    </h2>
	<ol class="comment-list">
		<?php wp_list_comments( array(
				'avatar_size' => 100,
				'style'       => 'ol',
				'short_ping'  => true,
				'reply_text'  => __( 'Odpovědět', 'singleproduct' ),
		) ); ?>
	</ol>
	<?php the_comments_pagination( array(
		'prev_text' => '<span class="prev-text">' . __( 'Předchozí', 'singleproduct' ) . '</span>',
		'next_text' => '<span class="next-text">' . __( 'Následující', 'singleproduct' ) . '</span>',
	) ); ?>
	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
	<p class="no-comments">
        <?php _e( 'Další komentáře již nejsou povoleny.', 'singleproduct' ); ?>
    </p>
    <?php endif ; ?>

    <?php else : ?>

	<h2 class="comments-title">
        <?php esc_html_e( 'Komentáře', 'singleproduct' ); ?>
    </h2>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
	<p class="no-comments">
        <?php _e( 'Komentáře nejsou povoleny.', 'singleproduct' ); ?>
    </p>
    <?php else : ?>
	<p class="no-comments">
        <?php _e( 'Prozatím nebyly přidány žádné komentáře.', 'singleproduct' ); ?>
    </p>
	<?php endif; ?>

    <?php endif ; ?>

	<?php comment_form(); ?>
</div><!-- #comments -->
