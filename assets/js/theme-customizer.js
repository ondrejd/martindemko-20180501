/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
( function( $ ) {

	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			$( 'a.navbar-brand' ).html( newval );
		} );
	} );

	wp.customize( 'product_order_btn_text', function( value ) {
		value.bind( function( newval ) {
			$( '.site-product-order-button' ).html( newval );
		} );
	} );

	wp.customize( 'product_order_btn_link', function( value ) {
		value.bind( function( newval ) {
			$( '.site-product-order-button' ).html( newval );
		} );
	} );

	wp.customize( 'header_foreground_color', function( value ) {
		value.bind( function( newval ) {
			$( '.navbar-brand', '' ).css( 'color', newval + '!important' );
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
	
} )( jQuery );
