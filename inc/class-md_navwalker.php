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

if( ! defined( 'ABSPATH' ) ) {
    exit;
}


if( ! class_exists( 'martindemko_navwalker' ) ) :

/**
 * Navigation walker.
 * @author Ondřej Doněk, <ondrejd@gmail.com>
 * @since 1.0.0
 */
class martindemko_navwalker extends Walker_Nav_Menu {

	/**
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 * @see Walker::start_lvl()
	 * @since 1.0.0
	 *
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "t", $depth );
		$output .= "\n$indent<ul role=\"nav\" class=\"nav flex-column\">\n";
	}

	/**
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 * @see Walker::start_el()
	 * @since 1.0.0
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		// Dividers, headers or disabled
		if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
		} else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
			$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
		} else {
			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

            if( $args->has_children && $depth === 0 ) {
                $class_names .= ' dropdown';
            }
            elseif( $args->has_children && $depth > 0 ) {
                $class_names .= ' dropdown dropdown-submenu';
            }

			if ( in_array( 'current-menu-item', $classes ) ) {
				$class_names .= ' active';
            }

			$class_names = $class_names ? ' class="nav-item ' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names .'>';

			$atts = array();
			$atts['title']  = ! empty( $item->title )  ? $item->title	: '';
			$atts['target'] = ! empty( $item->target ) ? $item->target	: '';
			$atts['rel']    = ! empty( $item->xfn )    ? $item->xfn	    : '';
            $atts['href']   = ! empty( $item->url )    ? $item->url     : '';

			// If item has_children add atts to a.
			if( $args->has_children ) {
				$atts['href'] = '#';
				$atts['data-toggle'] = 'dropdown';
				$atts['class'] = 'dropdown-toggle nav-link';
				$atts['aria-haspopup'] = 'true';
			} else {
				$atts['href'] = ! empty( $item->url ) ? $item->url : '';
                $atts['class'] = 'nav-link';
			}
            
            if( $depth > 0 && ! in_array( 'menu-item-has-children', $classes ) ) {
                $atts['class'] = 'dropdown-item';
            }
            elseif( $depth > 0 && in_array( 'menu-item-has-children', $classes ) ){
                $atts['data-toggle'] = 'dropdown';
                $atts['class'] = 'dropdown-toggle dropdown-item';
            }
            else {

            }

            $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
			$attributes = '';
            
            // Transform array to string of HTML attributes
			foreach( $atts as $attr => $value ) {
				if( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before . $item->title . $args->link_after;
			$item_output .= $args->has_children ? ' <span class="caret"></span></a>' : '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}

	/**
	 * @param object $element Data object
	 * @param array $children_elements List of elements to continue traversing.
	 * @param int $max_depth Max depth to traverse.
	 * @param int $depth Depth of current element.
	 * @param array $args
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 * @see Walker::start_el()
	 * @since 2.5.0
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if( ! $element ) {
            return;
        }

        $id_field = $this->db_fields['id'];

        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
        }

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

	/**
	 * @param array $args passed from the wp_nav_menu function.
     * @since 1.0.0
	 */
    public static function fallback( $args ) {
        extract( $args );

        $out = '';

        if( $container ) {
            $out .= sprintf(
                '<%1$s%2$s%3$s>',
                $container,
                $container_id ? ' id="' . $container_id . '"' : '',
                $container_class ? ' class="' . $container_class . '"' : ''
            );
        }

        $out .= ''
            . '<ul role="nav" class="nav flex-column">'
            .   '<li class="nav-item"><a href="#" class="nav-link">' . __( 'Domů', 'singleproduct' ) . '</a></li>'
            .   '<li class="nav-item"><a href="#" class="nav-link">' . __( 'O nás', 'singleproduct' ) . '</a></li>'
            .   '<li class="nav-item"><a href="#" class="nav-link">' . __( 'Kontakt', 'singleproduct' ) . '</a></li>'
            . '</ul>';

        if( $container ) {
            $out .= '</' . $container . '>';
        }

        echo $out;
    }
}

endif;