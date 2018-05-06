<?php
/**
 * WordPress theme "martindemko-20180501" based on Twentyseventeen theme.
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

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php _e( 'Nothing Found', 'martindemko' ); ?></h1>
	</header>
	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :
		?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'martindemko' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php else : ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'martindemko' ); ?></p>
			<?php
				get_search_form();

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
