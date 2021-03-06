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
 * 
 * @todo Remove this in favor of in PHP written partials.
 */

( function( $ ) {

	wp.customize( 'header_foreground_color', function( value ) {
		value.bind( function( val ) {
			$( '.navbar-brand' ).css( 'color', val + '!important' );
		} );
	} );

	wp.customize( 'header_background_color', function( value ) {
		value.bind( function( val ) {
			$( '.navbar' ).css( 'background-color', val );
		} );
	} );

	wp.customize( 'footer_foreground_color', function( value ) {
		value.bind( function( val ) {
			$( '.site-footer' ).css( 'color', val );
            $( '.site-footer ul.menu li a' ).css( 'color', val );
		} );
	} );

	wp.customize( 'footer_background_color', function( value ) {
		value.bind( function( val ) {
			$( '.site-footer' ).css( 'background-color', val );
		} );
	} );

	// Some icons for editing partials are hidden...
	//$( '.customize-partial-edit-shortcut-product_logos' ).css( 'left', '50% !important' ).css( 'float', 'none' );
	
} )( jQuery );
