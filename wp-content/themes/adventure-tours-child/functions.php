<?php

/**
 * Includes 'style.css'.
 * Disable this filter if you don't use child style.css file.
 *
 * @param  assoc $default_set set of styles that will be loaded to the page
 * @return assoc
 */
function filter_adventure_tours_get_theme_styles( $default_set ) {
	$default_set['child-style'] = get_stylesheet_uri();
	return $default_set;
}
add_filter( 'get-theme-styles', 'filter_adventure_tours_get_theme_styles' );

function adventure_tours_render_tour_booking_form( $product = null ) {
    if( $product ) {
	if(ICL_LANGUAGE_CODE=='de'){
	        $form_html = do_shortcode( '[contact-form-7 id="2207"]' );
	} else {
	        $form_html = do_shortcode( '[contact-form-7 id="1468"]' );
	}

        if ( $form_html ) {
            // uncomment line below, if you are going to use form without tour booking form style
            // return sprintf('<div class="widget block-after-indent"><h3 class="widget__title">%s</h3>%s</div>', 'Request a quote', $form_html ); 

            return $form_html;
        }
    }

    return '';
}