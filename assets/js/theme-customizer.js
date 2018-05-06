/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
( function( $ ) {

	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			$( 'h1.site-title a' ).html( newval );
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
			$( '.site-header .site-title a', '' ).css( 'color', newval + '!important' );
		} );
	} );

	wp.customize( 'header_background_color', function( value ) {
		value.bind( function( newval ) {
			$( '.site-header' ).css( 'background-color', newval );
		} );
	} );
	
} )( jQuery );
