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
	<header class="page-header hp-help-banner">
        <div class="row justify-content-center">
            <div class="col-xs-10 col-sm-8 col-md-10 col-lg-8 col-xs-6">
                <div class="row justify-content-center">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xs-2 hp-help-banner-item"><span class="help-banner-num">1</span><p class="help-banner-lbl help-banner-lbl-1"><?php echo esc_html( get_option( 'ordersteps_text_1' ) ) ?></p></div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xs-2 hp-help-banner-item"><span class="help-banner-num">2</span><p class="help-banner-lbl help-banner-lbl-2"><?php echo esc_html( get_option( 'ordersteps_text_2' ) ) ?></p></div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xs-2 hp-help-banner-item"><span class="help-banner-num">3</span><p class="help-banner-lbl help-banner-lbl-3"><?php echo esc_html( get_option( 'ordersteps_text_3' ) ) ?></p></div>
                </div>
            </div>
        </div>
	</header>
	<?php endif; ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <div class="row justify-content-center">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xs-6">
                    <div class="row"><?php
			        if ( have_posts() ) :
				        while ( have_posts() ) :
					        the_post();
					        get_template_part( 'content', get_post_format() );
				        endwhile;

				        the_posts_pagination(
					        array(
						        'prev_text' => '<span class="screen-reader-text">' . __( 'Předchozí', 'martindemko' ) . '</span>',
						        'next_text' => '<span class="screen-reader-text">' . __( 'Následující', 'martindemko' ) . '</span>',
						        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Stránka', 'martindemko' ) . ' </span>',
					        )
				        );
			        else :
				        get_template_part( 'content', 'none' );
			        endif;
?>                    </div>
                </div>
            </div>
		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php
get_footer();

