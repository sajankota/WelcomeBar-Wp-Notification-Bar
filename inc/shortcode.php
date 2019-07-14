<?php

// register TinyMCE buttons
add_filter( 'mce_buttons', 'welcomebar_wpnb_register_mce_buttons' );
function welcomebar_wpnb_register_mce_buttons( $buttons ) {
    $buttons[] = 'btn_trigger';
    return $buttons;
}

// add new buttons to tinymce
add_filter( 'mce_external_plugins', 'welcomebar_wpnb_register_mce_plugin' );
function welcomebar_wpnb_register_mce_plugin( $plugin_array ) {
   $plugin_array['btn_trigger'] = WELCOMEBAR_WPNB_URI.'/admin/js/shortcode.js';
   return $plugin_array;
}


add_shortcode( 'welcomebar_btn', 'welcomebar_wpnb_btn_shortcode' );
function welcomebar_wpnb_btn_shortcode($atts){
    $atts = shortcode_atts( 
        array(
            'btn_text'  => 'DOWNLOAD NOW!',
            'btn_link'  => 'https://devitems.com/',
            'btn_target'  => '',
            'btn_bg_color'  => '',
            'btn_text_color'  => '',
            'btn_style'  => 'style_2',
        ),
        $atts,
        $shortcode = 'welcomebar_btn'
    );
    extract($atts);

    $css = '';
    $css .= $btn_bg_color ? 'background-color:'.$btn_bg_color.';' : '';
    $css .= $btn_text_color ? 'color:'.$btn_text_color.';' : '';

    return '<a class="ht_btn '.$btn_style.'" href="'.$btn_link.'" target="'.$btn_target.'" style="'.$css.'">'.$btn_text.'</a>';
}