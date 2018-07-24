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

?>

    </div><!-- #content -->

    <footer class="site-footer" role="contentinfo">
        <div class="container">
            <div class="row justify-content-md-center" ><!-- justify-content-md-center -->
                <div class="col col-lg-4 site-footer-pane site-footer-left">
                    <?php wp_nav_menu( array( 
                        'theme_location' => 'footer-languages-menu',
                        'menu_class'     => 'nav flex-column menu footer-menu',
                        'depth'          => 1,
                        'fallback_cb'    => 'singleproduct_navwalker::fallback',
                        'walker'         => new singleproduct_navwalker()
                    ) ); ?>
                </div>
                <div class="col col-lg-4 site-footer-pane site-footer-right">
                    <?php wp_nav_menu( array(
                        'theme_location' => 'footer-contact-menu',
                        'menu_class'     => 'nav flex-column footer-menu menu',
                        'depth'          => 1,
                        'fallback_cb'    => 'singleproduct_navwalker::fallback',
                        'walker'         => new singleproduct_navwalker()
                    ) ); ?>
                </div>
            </div>
        </div>
    </footer><!-- #colophon -->

</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>
