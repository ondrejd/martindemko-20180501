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

get_header(); ?>

<div class="wrap">
	<?php if ( is_home() && ! is_front_page() ) : ?>
	<header class="page-header">
		<h1 class="page-title"><?php single_post_title(); ?></h1>
	</header>
	<?php else : ?>
    <?php martindemko_hp_help_banner(); ?>
	<?php endif; ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <div class="row justify-content-center">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xs-6">
                    <div class="row">
                    <?php
			            if( have_posts() ) {
				            while( have_posts() ) :
					            the_post();
					            get_template_part( 'content', get_post_format() );
				            endwhile;

                            if( $wp_query->post_count % 2 != 0 ) {
                                echo '<article class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-6"> </article>';
                            }
			            } else {
				            get_template_part( 'content', 'none' );
			            }
                    ?>
                    </div>
                </div>
            </div>
            <?php martindemko_hp_pagination(); ?>
		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php
get_footer();

