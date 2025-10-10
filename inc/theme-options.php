<?php

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

			<div class="designcart-checkbox-multiple" style="max-height:150px; overflow-y:auto; border:1px solid #ddd; padding:6px; border-radius:4px;">
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

			<script>
			(function($){
				var root = $('[data-customize-setting-link="<?php echo esc_js( $this->id ); ?>"]').closest('.customize-control');
				root.on('change', '.designcart-checkbox-multiple input[type="checkbox"]', function(){
					var vals = [];
					root.find('.designcart-checkbox-multiple input[type="checkbox"]:checked').each(function(){
						vals.push($(this).val());
					});
					root.find('input[type="hidden"][data-customize-setting-link]').val(JSON.stringify(vals)).trigger('change');
				});
			})(jQuery);
			</script>
			<?php
		}
	}
}


function designcart_customize_register( $wp_customize ) {

    $wp_customize->add_section( 'designcart_topbar', array(
        'title'    => __( 'Pasek informacyjny (top)', 'designcart' ),
        'priority' => 10,
    ) );

    $wp_customize->add_setting( 'designcart_topbar_text', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
    ) );

    $wp_customize->add_control( 'designcart_topbar_text', array(
        'label'   => __( 'Tekst paska informacyjnego', 'designcart' ),
        'section' => 'designcart_topbar',
        'type'    => 'text',
    ) );

	$wp_customize->add_setting( 'designcart_logo' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'designcart_logo', array(
		'label'    => __( 'Logo', 'designcart' ),
		'section'  => 'title_tagline',
		'settings' => 'designcart_logo',
	) ) );

	$wp_customize->add_section( 'designcart_banner', array(
		'title'    => __( 'Banner główny', 'designcart' ),
		'priority' => 20,
	) );

	$wp_customize->add_setting( 'designcart_banner_image' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'designcart_banner_image', array(
		'label'    => __( 'Baner na stronie głównej', 'designcart' ),
		'section'  => 'designcart_banner',
		'settings' => 'designcart_banner_image',
	) ) );

    $wp_customize->add_setting( 'designcart_mobile_banner_image' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'designcart_mobile_banner_image', array(
		'label'    => __( 'Baner na stronie głównej dla wersji mobilnej', 'designcart' ),
		'section'  => 'designcart_banner',
		'settings' => 'designcart_mobile_banner_image',
	) ) );

	$wp_customize->add_setting( 'designcart_banner_h1', array( 'default' => '' ) );
	$wp_customize->add_control( 'designcart_banner_h1', array(
		'label'   => __( 'Nagłówek H1', 'designcart' ),
		'section' => 'designcart_banner',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'designcart_banner_subtitle', array( 'default' => '' ) );
	$wp_customize->add_control( 'designcart_banner_subtitle', array(
		'label'   => __( 'Podtytuł', 'designcart' ),
		'section' => 'designcart_banner',
		'type'    => 'textarea',
	) );

	$wp_customize->add_setting( 'designcart_banner_btn1_text', array( 'default' => '' ) );
	$wp_customize->add_setting( 'designcart_banner_btn1_url', array( 'default' => '' ) );
	$wp_customize->add_control( 'designcart_banner_btn1_text', array(
		'label'   => __( 'Przycisk 1 – tekst', 'designcart' ),
		'section' => 'designcart_banner',
		'type'    => 'text',
	) );
	$wp_customize->add_control( 'designcart_banner_btn1_url', array(
		'label'   => __( 'Przycisk 1 – link', 'designcart' ),
		'section' => 'designcart_banner',
		'type'    => 'url',
	) );

	$wp_customize->add_setting( 'designcart_banner_btn2_text', array( 'default' => '' ) );
	$wp_customize->add_setting( 'designcart_banner_btn2_url', array( 'default' => '' ) );
	$wp_customize->add_control( 'designcart_banner_btn2_text', array(
		'label'   => __( 'Przycisk 2 – tekst', 'designcart' ),
		'section' => 'designcart_banner',
		'type'    => 'text',
	) );
	$wp_customize->add_control( 'designcart_banner_btn2_url', array(
		'label'   => __( 'Przycisk 2 – link', 'designcart' ),
		'section' => 'designcart_banner',
		'type'    => 'url',
	) );

	$wp_customize->add_section( 'designcart_colors', array(
		'title'    => __( 'Kolorystyka', 'designcart' ),
		'priority' => 30,
	) );

	for ( $i = 1; $i <= 4; $i++ ) {

        $wp_customize->add_setting( "designcart_button_style_{$i}_bg", [ 'default' => '' ] );
        $wp_customize->add_setting( "designcart_button_style_{$i}_text", [ 'default' => '' ] );

        $wp_customize->add_setting( "designcart_button_style_{$i}_bg_hover", [ 'default' => '' ] );
        $wp_customize->add_setting( "designcart_button_style_{$i}_text_hover", [ 'default' => '' ] );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "designcart_button_style_{$i}_bg", array(
            'label'   => __( "Przycisk Styl {$i} – tło", 'designcart' ),
            'section' => 'designcart_colors',
        ) ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "designcart_button_style_{$i}_text", array(
            'label'   => __( "Przycisk Styl {$i} – tekst", 'designcart' ),
            'section' => 'designcart_colors',
        ) ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "designcart_button_style_{$i}_bg_hover", array(
            'label'   => __( "Przycisk Styl {$i} – tło (hover)", 'designcart' ),
            'section' => 'designcart_colors',
        ) ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "designcart_button_style_{$i}_text_hover", array(
            'label'   => __( "Przycisk Styl {$i} – tekst (hover)", 'designcart' ),
            'section' => 'designcart_colors',
        ) ) );
    }

	$wp_customize->add_setting( 'designcart_font_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'designcart_font_color', array(
		'label'   => __( 'Główny kolor czcionki', 'designcart' ),
		'section' => 'designcart_colors',
	) ) );

	$wp_customize->add_setting( 'designcart_footer_bg' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'designcart_footer_bg', array(
		'label'   => __( 'Tło stopki', 'designcart' ),
		'section' => 'designcart_colors',
	) ) );

	$wp_customize->add_setting( 'designcart_footer_text' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'designcart_footer_text', array(
		'label'   => __( 'Kolor czcionki w stopce', 'designcart' ),
		'section' => 'designcart_colors',
	) ) );

	$wp_customize->add_setting( 'designcart_link_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'designcart_link_color', array(
		'label'   => __( 'Kolor linków', 'designcart' ),
		'section' => 'designcart_colors',
	) ) );

	$wp_customize->add_setting( 'designcart_link_hover' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'designcart_link_hover', array(
		'label'   => __( 'Kolor linków (hover)', 'designcart' ),
		'section' => 'designcart_colors',
	) ) );

	// Sliderki
	$wp_customize->add_section( 'designcart_sliders', array(
    	'title'    => __( 'Slidery produktów', 'designcart' ),
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

	// === Slider Nowości ===
	// Włącz/wyłącz
	$wp_customize->add_setting( 'designcart_slider_new_enabled', array(
		'default'           => false,
		'sanitize_callback' => 'wp_validate_boolean',
	) );
	$wp_customize->add_control( 'designcart_slider_new_enabled', array(
		'label'   => __( 'Włącz slider: Nowości', 'designcart' ),
		'section' => 'designcart_sliders',
		'type'    => 'checkbox',
	) );

	// Tytuł
	$wp_customize->add_setting( 'designcart_slider_new_title', array(
		'default'           => __( 'Nowości', 'designcart' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'designcart_slider_new_title', array(
		'label'   => __( 'Tytuł slidera: Nowości', 'designcart' ),
		'section' => 'designcart_sliders',
		'type'    => 'text',
	) );

	// Kategorie (checkboxy) – wymaga klasy kontrolki
	$wp_customize->add_setting( 'designcart_slider_new_cats', array(
		'default'           => array(),
		'sanitize_callback' => 'designcart_sanitize_checkbox_multiple',
	) );

	$wp_customize->add_control( new DesignCart_Checkbox_Multiple_Control( $wp_customize, 'designcart_slider_new_cats', array(
		'label'    => __( 'Kategorie dla slidera: Nowości', 'designcart' ),
		'section'  => 'designcart_sliders',
		'choices'  => $categories,
	) ) );

	// === Slider Promocje ===
	// Włącz/wyłącz
	$wp_customize->add_setting( 'designcart_slider_sale_enabled', array(
		'default'           => false,
		'sanitize_callback' => 'wp_validate_boolean',
	) );
	$wp_customize->add_control( 'designcart_slider_sale_enabled', array(
		'label'   => __( 'Włącz slider: Promocje', 'designcart' ),
		'section' => 'designcart_sliders',
		'type'    => 'checkbox',
	) );

	// Tytuł
	$wp_customize->add_setting( 'designcart_slider_sale_title', array(
		'default'           => __( 'Promocje', 'designcart' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'designcart_slider_sale_title', array(
		'label'   => __( 'Tytuł slidera: Promocje', 'designcart' ),
		'section' => 'designcart_sliders',
		'type'    => 'text',
	) );

	// Kategorie (checkboxy)
	$wp_customize->add_setting( 'designcart_slider_sale_cats', array(
		'default'           => array(),
		'sanitize_callback' => 'designcart_sanitize_checkbox_multiple',
	) );
	$wp_customize->add_control( new DesignCart_Checkbox_Multiple_Control( $wp_customize, 'designcart_slider_sale_cats', array(
		'label'    => __( 'Kategorie dla slidera: Promocje', 'designcart' ),
		'section'  => 'designcart_sliders',
		'choices'  => $categories,
	) ) );

	// === Slider Bestsellery ===
	// Włącz/wyłącz
	$wp_customize->add_setting( 'designcart_slider_best_enabled', array(
		'default'           => false,
		'sanitize_callback' => 'wp_validate_boolean',
	) );
	$wp_customize->add_control( 'designcart_slider_best_enabled', array(
		'label'   => __( 'Włącz slider: Bestsellery', 'designcart' ),
		'section' => 'designcart_sliders',
		'type'    => 'checkbox',
	) );

	// Tytuł
	$wp_customize->add_setting( 'designcart_slider_best_title', array(
		'default'           => __( 'Bestsellery', 'designcart' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'designcart_slider_best_title', array(
		'label'   => __( 'Tytuł slidera: Bestsellery', 'designcart' ),
		'section' => 'designcart_sliders',
		'type'    => 'text',
	) );

	// Kategorie (checkboxy)
	$wp_customize->add_setting( 'designcart_slider_best_cats', array(
		'default'           => array(),
		'sanitize_callback' => 'designcart_sanitize_checkbox_multiple',
	) );
	$wp_customize->add_control( new DesignCart_Checkbox_Multiple_Control( $wp_customize, 'designcart_slider_best_cats', array(
		'label'    => __( 'Kategorie dla slidera: Bestsellery', 'designcart' ),
		'section'  => 'designcart_sliders',
		'choices'  => $categories,
	) ) );

	// === Slider Wyróżnione ===
	// Włącz/wyłącz
	$wp_customize->add_setting( 'designcart_slider_feat_enabled', array(
		'default'           => false,
		'sanitize_callback' => 'wp_validate_boolean',
	) );
	$wp_customize->add_control( 'designcart_slider_feat_enabled', array(
		'label'   => __( 'Włącz slider: Wyróżnione', 'designcart' ),
		'section' => 'designcart_sliders',
		'type'    => 'checkbox',
	) );

	// Tytuł
	$wp_customize->add_setting( 'designcart_slider_feat_title', array(
		'default'           => __( 'Wyróżnione', 'designcart' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'designcart_slider_feat_title', array(
		'label'   => __( 'Tytuł slidera: Wyróżnione', 'designcart' ),
		'section' => 'designcart_sliders',
		'type'    => 'text',
	) );

	// Kategorie (checkboxy)
	$wp_customize->add_setting( 'designcart_slider_feat_cats', array(
		'default'           => array(),
		'sanitize_callback' => 'designcart_sanitize_checkbox_multiple',
	) );
	$wp_customize->add_control( new DesignCart_Checkbox_Multiple_Control( $wp_customize, 'designcart_slider_feat_cats', array(
		'label'    => __( 'Kategorie dla slidera: Wyróżnione', 'designcart' ),
		'section'  => 'designcart_sliders',
		'choices'  => $categories,
	) ) );
}

add_action( 'customize_register', 'designcart_customize_register' );
