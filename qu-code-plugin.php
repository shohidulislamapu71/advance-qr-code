<?php
/**
 * Plugin Name: QR Code Plugin
 * Plugin URI: https://wordpress.org/plugins/our-first-plugin
 * Description: This is a basic practice plugin for generating QR codes.
 * Version: 1.0.0
 * Author: Sohidul Islam Apu
 * Author URI: https://wordpress.org/plugins/our-first-plugin
 */

class Qu_code_plugin {

    function __construct() {
        add_action('init', [$this, 'init']);
    }

    function init() {
        add_filter('the_content', [$this, 'the_content_qr_code']);
        
    }

    function the_content_qr_code($the_content) {
        $color = 'ffff00';
        $size = 200;
        $data = get_permalink();

        $color = apply_filters('change_color', $color);
        $size = apply_filters('change_size', $size);
        $data = apply_filters('change_data', $data);

        $all_info = [$size, $data, $color];
        $all_info = apply_filters_ref_array('modify_filter', [$all_info]);

        $qr_code_api = sprintf(
            "<img src='https://api.qrserver.com/v1/create-qr-code/?size=%dx%d&data=%s&bgcolor=%s'>",
            $all_info[0],
            $all_info[0],
            urlencode($all_info[1]),
            $all_info[2]
        );

        return $the_content . "<p>$qr_code_api</p>";
    }
}

new Qu_code_plugin();
?>
