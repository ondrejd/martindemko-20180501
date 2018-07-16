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

<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xs-12 no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php _e( 'Nemůžeme najít to, co hledáte…', 'singleproduct' ); ?></h1>
	</header>
	<div class="page-content">
        <p><?php printf(
            __( 'Nemůžeme najít to, co hledáte - jste si jisti, že jste napsali URL adresu správně? Nejlepší bude, pokud přejdete na %1$sdomovskou stránku%2$s a zkusíte se podívat tam.', 'singleproduct' ),
            '<a href="' . home_url() . '" rel="home">', '</a>' 
        ); ?></p>
	</div><!-- .page-content -->
</section><!-- .no-results -->
