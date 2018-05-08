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

if( ! defined( 'ABSPATH' ) ) {
    exit;
}

if( ! class_exists( 'WP_Customize_Control' ) ) {
    return;
}

if( ! class_exists( 'MD_Product_Dropdown_WP_Customize_Control' ) ) :

/**
 * Class to create a custom post control
 * @since 1.0.0
 */
class MD_Product_Dropdown_WP_Customize_Control extends WP_Customize_Control {

    /**
     * Render the content on the theme customizer page
     * @return void
     * @since 1.0.0
     * @uses esc_html()
     * @uses get_posts()
     * @uses wp_parse_args()
     */
    public function render_content() {
?>
    <label class="customize-control-title" for="<?php echo $this->id; ?>">
        <?php echo esc_html( $this->label ); ?>
    </label>
    <?php if( ! empty( $this->description ) ) : ?>
    <span id="" class="description"><?php echo esc_html( $this->description ); ?></span>
    <?php endif; ?>
    <select id="<?php echo $this->id; ?>" data-customize-setting-link="<?php echo esc_attr( $this->setting->id, 'martindemko' ) ?>">
    <?php
        $args = wp_parse_args( $this->args, array(
            'numberposts' => '-1',
            'post_type'   => MD_Product::SLUG,
            'orderby'     => 'title',
            'order'       => 'asc',
        ) );
        $posts = get_posts( $args );

        echo '<option value="0">' . __( '--- Vyberte ---', 'martindemko' ) . '</option>';

        foreach ( $posts as $post ) {
            echo '<option value="' . $post->ID . '" '.selected( $this->value, $post->ID ) . '>' . $post->post_title . '</option>';
        }
    ?>
    </select>
</label>
<?php
    }
}

endif;
