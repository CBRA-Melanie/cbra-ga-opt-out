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
		'property'      => 'default',
        'text'          => 'Erfassung von Daten durch Google Analytics für diese Website deaktivieren',
        'alert'         => 'Google Analytics wurde deaktiviert',
        'color'         => 'black'
	), $atts, 'cb_ga_opt_out' );

    ob_start();
    ?>
    <a href="#" id="cb-ga-opt-out" style="color: <?= $atts['color'] ?>; font-weight: bold; text-decoration: none"><?= $atts['text'] ?></a>
    <?php
    wp_register_script('ga-opt-out', WP_PLUGIN_URL . '/cbra-ga-opt-out/cbra-ga-opt-out.js');
    wp_localize_script('ga-opt-out', 'data', array(
        'property'  =>  $atts['property'],
        'alert'     => $atts['alert']
    ));
    wp_enqueue_script('ga-opt-out');

    return ob_get_clean();
};

 ?>