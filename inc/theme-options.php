<?php
/**
 * @package dc-circle
 * @author Paweł Nosko
 * @copyright 2026 Design Cart
 * @license GPL-2.0-or-later
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'DesignCart_Checkbox_Multiple_Control' ) ) {
	class DesignCart_Checkbox_Multiple_Control extends WP_Customize_Control {
		public $type = 'checkbox-multiple';

		public function render_content() {
			if ( empty( $this->choices ) ) { return; }

			// Obsługa wartości z bazy (array lub JSON string)
			$value = $this->value();
			if ( is_string( $value ) ) {
				$decoded = json_decode( $value, true );
				if ( json_last_error() === JSON_ERROR_NONE ) { $value = $decoded; }
			}
			if ( ! is_array( $value ) ) { $value = array(); }

			?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
			<?php endif; ?>

			<div class="designcart-checkbox-multiple dc-circle-checkbox-multiple customize-control-checkbox-multiple" style="max-height:150px; overflow-y:auto; border:1px solid #ddd; padding:6px; border-radius:4px;">
				<?php
				$selected = array_map( 'strval', $value );
				foreach ( $this->choices as $val => $label ) : ?>
					<label style="display:block; margin:4px 0;">
						<input type="checkbox" value="<?php echo esc_attr( $val ); ?>" <?php checked( in_array( (string) $val, $selected, true ) ); ?> />
						<?php echo esc_html( $label ); ?>
					</label>
				<?php endforeach; ?>
			</div>

			<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( wp_json_encode( array_values( array_map( 'intval', $value ) ) ) ); ?>" />
			<?php
		}
	}
}


function dc_circle_customize_controls_scripts() {
	wp_enqueue_script(
		'dc-circle-customizer-controls',
		get_template_directory_uri() . '/assets/js/customizer-checkbox-multiple.js',
		array( 'jquery', 'customize-controls' ),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'dc_circle_customize_controls_scripts' );


function designcart_customize_register( $wp_customize ) {

    $wp_customize->add_section( 'designcart_topbar', array(
        'title'    => __( 'Top info bar', 'dc-circle' ),
        'priority' => 10,
    ) );

    $wp_customize->add_setting( 'designcart_topbar_text', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
    ) );

    $wp_customize->add_control( 'designcart_topbar_text', array(
        'label'   => __( 'Top bar text', 'dc-circle' ),
        'section' => 'designcart_topbar',
        'type'    => 'text',
    ) );

	$wp_customize->add_setting( 'designcart_logo', array( 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'designcart_logo', array(
		'label'    => __( 'Logo', 'dc-circle' ),
		'section'  => 'title_tagline',
		'settings' => 'designcart_logo',
	) ) );

	$wp_customize->add_section( 'designcart_banner', array(
		'title'    => __( 'Hero banner', 'dc-circle' ),
		'priority' => 20,
	) );

	$wp_customize->add_setting( 'designcart_banner_image', array( 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'designcart_banner_image', array(
		'label'    => __( 'Homepage banner', 'dc-circle' ),
		'section'  => 'designcart_banner',
		'settings' => 'designcart_banner_image',
	) ) );

    $wp_customize->add_setting( 'designcart_mobile_banner_image', array( 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'designcart_mobile_banner_image', array(
		'label'    => __( 'Homepage banner (mobile)', 'dc-circle' ),
		'section'  => 'designcart_banner',
		'settings' => 'designcart_mobile_banner_image',
	) ) );

	$wp_customize->add_setting( 'designcart_banner_h1', array(
		'default'           => __( 'Welcome to our store', 'dc-circle' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'designcart_banner_h1', array(
		'label'   => __( 'H1 heading', 'dc-circle' ),
		'section' => 'designcart_banner',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'designcart_banner_subtitle', array(
		'default'           => __( 'Discover curated products for everyday living.', 'dc-circle' ),
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'designcart_banner_subtitle', array(
		'label'   => __( 'Subtitle', 'dc-circle' ),
		'section' => 'designcart_banner',
		'type'    => 'textarea',
	) );

	$wp_customize->add_setting( 'designcart_banner_btn1_text', array(
		'default'           => __( 'Shop now', 'dc-circle' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_setting( 'designcart_banner_btn1_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'designcart_banner_btn1_text', array(
		'label'   => __( 'Button 1 text', 'dc-circle' ),
		'section' => 'designcart_banner',
		'type'    => 'text',
	) );
	$wp_customize->add_control( 'designcart_banner_btn1_url', array(
		'label'       => __( 'Button 1 URL', 'dc-circle' ),
		'description' => __( 'Leave empty to link to the shop page.', 'dc-circle' ),
		'section'     => 'designcart_banner',
		'type'        => 'url',
	) );

	$wp_customize->add_setting( 'designcart_banner_btn2_text', array(
		'default'           => __( 'Learn more', 'dc-circle' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_setting( 'designcart_banner_btn2_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'designcart_banner_btn2_text', array(
		'label'   => __( 'Button 2 text', 'dc-circle' ),
		'section' => 'designcart_banner',
		'type'    => 'text',
	) );
	$wp_customize->add_control( 'designcart_banner_btn2_url', array(
		'label'       => __( 'Button 2 URL', 'dc-circle' ),
		'description' => __( 'Leave empty to link to the homepage.', 'dc-circle' ),
		'section'     => 'designcart_banner',
		'type'        => 'url',
	) );

	$wp_customize->add_section( 'designcart_colors', array(
		'title'    => __( 'Colors', 'dc-circle' ),
		'priority' => 30,
	) );

	for ( $i = 1; $i <= 4; $i++ ) {

        $wp_customize->add_setting( "designcart_button_style_{$i}_bg", array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color' ) );
        $wp_customize->add_setting( "designcart_button_style_{$i}_text", array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color' ) );

        $wp_customize->add_setting( "designcart_button_style_{$i}_bg_hover", array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color' ) );
        $wp_customize->add_setting( "designcart_button_style_{$i}_text_hover", array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color' ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "designcart_button_style_{$i}_bg", array(
            'label'   => sprintf( __( 'Button style %d background', 'dc-circle' ), $i ),
            'section' => 'designcart_colors',
        ) ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "designcart_button_style_{$i}_text", array(
            'label'   => sprintf( __( 'Button style %d text', 'dc-circle' ), $i ),
            'section' => 'designcart_colors',
        ) ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "designcart_button_style_{$i}_bg_hover", array(
            'label'   => sprintf( __( 'Button style %d background (hover)', 'dc-circle' ), $i ),
            'section' => 'designcart_colors',
        ) ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "designcart_button_style_{$i}_text_hover", array(
            'label'   => sprintf( __( 'Button style %d text (hover)', 'dc-circle' ), $i ),
            'section' => 'designcart_colors',
        ) ) );
    }

	$wp_customize->add_setting( 'designcart_font_color', array( 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'designcart_font_color', array(
		'label'   => __( 'Main text color', 'dc-circle' ),
		'section' => 'designcart_colors',
	) ) );

	$wp_customize->add_setting( 'designcart_footer_bg', array( 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'designcart_footer_bg', array(
		'label'   => __( 'Footer background', 'dc-circle' ),
		'section' => 'designcart_colors',
	) ) );

	$wp_customize->add_setting( 'designcart_footer_text', array( 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'designcart_footer_text', array(
		'label'   => __( 'Footer text color', 'dc-circle' ),
		'section' => 'designcart_colors',
	) ) );

	$wp_customize->add_setting( 'designcart_link_color', array( 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'designcart_link_color', array(
		'label'   => __( 'Link color', 'dc-circle' ),
		'section' => 'designcart_colors',
	) ) );

	$wp_customize->add_setting( 'designcart_link_hover', array( 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'designcart_link_hover', array(
		'label'   => __( 'Link color (hover)', 'dc-circle' ),
		'section' => 'designcart_colors',
	) ) );

	// Sliderki
	$wp_customize->add_section( 'designcart_sliders', array(
    	'title'    => __( 'Product sliders', 'dc-circle' ),
    	'priority' => 40,
	) );

	// Pobranie kategorii WooCommerce
	if ( ! function_exists( 'designcart_get_product_categories' ) ) {
		function designcart_get_product_categories() {
			$terms = get_terms( array(
				'taxonomy'   => 'product_cat',
				'hide_empty' => false,
			) );

			$cats = array();
			if ( ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {
					$cats[$term->term_id] = $term->name;
				}
			}
			return $cats;
		}
	}

	$categories = designcart_get_product_categories();

	// Sanitizer dla checkboxów
	if ( ! function_exists( 'designcart_sanitize_checkbox_multiple' ) ) {
		function designcart_sanitize_checkbox_multiple( $input ) {
			$decoded = json_decode( $input, true );
			if ( is_array( $decoded ) ) {
				return array_map( 'intval', $decoded );
			}
			return array();
		}
	}

	// === New arrivals slider ===
	// Włącz/wyłącz
	$wp_customize->add_setting( 'designcart_slider_new_enabled', array(
		'default'           => false,
		'sanitize_callback' => 'wp_validate_boolean',
	) );
	$wp_customize->add_control( 'designcart_slider_new_enabled', array(
		'label'   => __( 'Enable slider: New arrivals', 'dc-circle' ),
		'section' => 'designcart_sliders',
		'type'    => 'checkbox',
	) );

	// Tytuł
	$wp_customize->add_setting( 'designcart_slider_new_title', array(
		'default'           => __( 'New arrivals', 'dc-circle' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'designcart_slider_new_title', array(
		'label'   => __( 'New arrivals slider title', 'dc-circle' ),
		'section' => 'designcart_sliders',
		'type'    => 'text',
	) );

	// Kategorie (checkboxy) – wymaga klasy kontrolki
	$wp_customize->add_setting( 'designcart_slider_new_cats', array(
		'default'           => array(),
		'sanitize_callback' => 'designcart_sanitize_checkbox_multiple',
	) );

	$wp_customize->add_control( new DesignCart_Checkbox_Multiple_Control( $wp_customize, 'designcart_slider_new_cats', array(
		'label'    => __( 'New arrivals slider categories', 'dc-circle' ),
		'section'  => 'designcart_sliders',
		'choices'  => $categories,
	) ) );

	// === Sale slider ===
	// Włącz/wyłącz
	$wp_customize->add_setting( 'designcart_slider_sale_enabled', array(
		'default'           => false,
		'sanitize_callback' => 'wp_validate_boolean',
	) );
	$wp_customize->add_control( 'designcart_slider_sale_enabled', array(
		'label'   => __( 'Enable slider: Sale', 'dc-circle' ),
		'section' => 'designcart_sliders',
		'type'    => 'checkbox',
	) );

	// Tytuł
	$wp_customize->add_setting( 'designcart_slider_sale_title', array(
		'default'           => __( 'Sale', 'dc-circle' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'designcart_slider_sale_title', array(
		'label'   => __( 'Sale slider title', 'dc-circle' ),
		'section' => 'designcart_sliders',
		'type'    => 'text',
	) );

	// Kategorie (checkboxy)
	$wp_customize->add_setting( 'designcart_slider_sale_cats', array(
		'default'           => array(),
		'sanitize_callback' => 'designcart_sanitize_checkbox_multiple',
	) );
	$wp_customize->add_control( new DesignCart_Checkbox_Multiple_Control( $wp_customize, 'designcart_slider_sale_cats', array(
		'label'    => __( 'Sale slider categories', 'dc-circle' ),
		'section'  => 'designcart_sliders',
		'choices'  => $categories,
	) ) );

	// === Bestsellers slider ===
	// Włącz/wyłącz
	$wp_customize->add_setting( 'designcart_slider_best_enabled', array(
		'default'           => false,
		'sanitize_callback' => 'wp_validate_boolean',
	) );
	$wp_customize->add_control( 'designcart_slider_best_enabled', array(
		'label'   => __( 'Enable slider: Bestsellers', 'dc-circle' ),
		'section' => 'designcart_sliders',
		'type'    => 'checkbox',
	) );

	// Tytuł
	$wp_customize->add_setting( 'designcart_slider_best_title', array(
		'default'           => __( 'Bestsellers', 'dc-circle' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'designcart_slider_best_title', array(
		'label'   => __( 'Bestsellers slider title', 'dc-circle' ),
		'section' => 'designcart_sliders',
		'type'    => 'text',
	) );

	// Kategorie (checkboxy)
	$wp_customize->add_setting( 'designcart_slider_best_cats', array(
		'default'           => array(),
		'sanitize_callback' => 'designcart_sanitize_checkbox_multiple',
	) );
	$wp_customize->add_control( new DesignCart_Checkbox_Multiple_Control( $wp_customize, 'designcart_slider_best_cats', array(
		'label'    => __( 'Bestsellers slider categories', 'dc-circle' ),
		'section'  => 'designcart_sliders',
		'choices'  => $categories,
	) ) );

	// === Featured slider ===
	// Włącz/wyłącz
	$wp_customize->add_setting( 'designcart_slider_feat_enabled', array(
		'default'           => false,
		'sanitize_callback' => 'wp_validate_boolean',
	) );
	$wp_customize->add_control( 'designcart_slider_feat_enabled', array(
		'label'   => __( 'Enable slider: Featured', 'dc-circle' ),
		'section' => 'designcart_sliders',
		'type'    => 'checkbox',
	) );

	// Tytuł
	$wp_customize->add_setting( 'designcart_slider_feat_title', array(
		'default'           => __( 'Featured', 'dc-circle' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'designcart_slider_feat_title', array(
		'label'   => __( 'Featured slider title', 'dc-circle' ),
		'section' => 'designcart_sliders',
		'type'    => 'text',
	) );

	// Kategorie (checkboxy)
	$wp_customize->add_setting( 'designcart_slider_feat_cats', array(
		'default'           => array(),
		'sanitize_callback' => 'designcart_sanitize_checkbox_multiple',
	) );
	$wp_customize->add_control( new DesignCart_Checkbox_Multiple_Control( $wp_customize, 'designcart_slider_feat_cats', array(
		'label'    => __( 'Featured slider categories', 'dc-circle' ),
		'section'  => 'designcart_sliders',
		'choices'  => $categories,
	) ) );
}

add_action( 'customize_register', 'designcart_customize_register' );
