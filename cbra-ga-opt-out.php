<?php
/**
 * Plugin Name:     CBRA Google Analytics Opt Out
 * Plugin URI:      https://cbra.digital
 * Description:     Sets a cookie that tells Google not to track. Use Shortcode [cb_ga_opt_out property="G-..."]
 * Author:          CBRA Digital
 */

add_shortcode('cb_ga_opt_out', 'cb_shortcode_opt_out');
function cb_shortcode_opt_out($atts) {
    $atts = shortcode_atts(array(
		'property' => 'default'
	), $atts, 'cb_ga_opt_out' );

    ob_start();
    ?>
    <a href="javascript:gaOptout();" onclick="alert('Google Analytics wurde deaktiviert');">Erfassung von Daten durch Google Analytics für diese Website deaktivieren</a>
    <?php
    wp_register_script('ga-opt-out', WP_PLUGIN_URL . '/cbra-ga-opt-out/cbra-ga-opt-out.js');
    wp_localize_script('ga-opt-out', 'data', array(
        'property'  =>  $atts['property'],
    ));
    wp_enqueue_script('ga-opt-out');

    return ob_get_clean();
};

 ?>