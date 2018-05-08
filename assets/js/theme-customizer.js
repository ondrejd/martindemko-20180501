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

( function( $ ) {

	wp.customize( 'header_foreground_color', function( value ) {
		value.bind( function( newval ) {
			$( '.navbar-brand' ).css( 'color', newval + '!important' );
		} );
	} );

	wp.customize( 'header_background_color', function( value ) {
		value.bind( function( newval ) {
			$( '.navbar' ).css( 'background-color', newval );
		} );
	} );

	wp.customize( 'show_product_logos', function( value ) {
		value.bind( function( newval ) {
            if( newval == 'yes' ) {
                $( '.site-product-logos' ).show();
            } else {
                $( '.site-product-logos' ).hide();
            }
		} );
	} );

	wp.customize( 'ordersteps_show', function( value ) {
		value.bind( function( newval ) {
            if( newval == 'yes' ) {
                $( '.hp-help-banner' ).show();
            } else {
                $( '.hp-help-banner' ).hide();
            }
		} );
	} );

	wp.customize( 'ordersteps_foreground_color', function( value ) {
		value.bind( function( newval ) {
			$( '.hp-help-banner .help-banner-num' ).css( 'color', newval );
			$( '.hp-help-banner .help-banner-num' ).css( 'border-color', newval );
			$( '.hp-help-banner .help-banner-lbl' ).css( 'color', newval );
		} );
	} );

	wp.customize( 'ordersteps_background_color_1', function( value ) {
		value.bind( function( newval ) {
			$( '.hp-help-banner' ).css( 'background-color', newval );
		} );
	} );

	wp.customize( 'ordersteps_background_color_2', function( value ) {
		value.bind( function( newval ) {
			$( '.hp-help-banner .help-banner-num' ).css( 'background-color', newval );
		} );
	} );

	wp.customize( 'ordersteps_text_1', function( value ) {
		value.bind( function( newval ) {
			$( '.hp-help-banner .help-banner-lbl-1' ).html( newval );
		} );
	} );

	wp.customize( 'ordersteps_text_2', function( value ) {
		value.bind( function( newval ) {
			$( '.hp-help-banner .help-banner-lbl-2' ).html( newval );
		} );
	} );

	wp.customize( 'ordersteps_text_3', function( value ) {
		value.bind( function( newval ) {
			$( '.hp-help-banner .help-banner-lbl-3' ).html( newval );
		} );
	} );

	wp.customize( 'footer_foreground_color', function( value ) {
		value.bind( function( newval ) {
			$( '.site-footer' ).css( 'color', newval );
            $( '.site-footer ul.menu li a' ).css( 'color', newval );
		} );
	} );

	wp.customize( 'footer_background_color', function( value ) {
		value.bind( function( newval ) {
			$( '.site-footer' ).css( 'background-color', newval );
		} );
	} );

	wp.customize( 'product_logo_url_1', function( value ) {
		value.bind( function( newval ) {
			$( '.site-product-logo-1 > a' ).attr( 'href', newval );
		} );
	} );

	wp.customize( 'product_logo_url_2', function( value ) {
		value.bind( function( newval ) {
			$( '.site-product-logo-2 > a' ).attr( 'href', newval );
		} );
	} );

	wp.customize( 'product_logo_url_3', function( value ) {
		value.bind( function( newval ) {
			$( '.site-product-logo-3 > a' ).attr( 'href', newval );
		} );
	} );
	
} )( jQuery );
