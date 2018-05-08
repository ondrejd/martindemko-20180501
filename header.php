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

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'martindemko' ); ?></a>
    <header id="page-header" class="site-header navbar-static-top <?php echo get_option( 'bootstrap_bg_class', '' ) ?>" role="banner">
        <div class="container">
            <nav class="navbar navbar-expand-xl justify-content-between p-0">
                <div class="navbar-brand">
                    <a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-orderbtn" aria-controls="" aria-expanded="false" aria-label="<?php echo esc_attr( 'Skrýt navigaci', 'martindemko' ) ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="navbar-orderbtn">
                    <?php martindemko_product_order_button(); ?>
                </div>
            </nav>
        </div>
    </header>
    <?php martindemko_site_product(); ?>
    <div id="content" class="site-content">
