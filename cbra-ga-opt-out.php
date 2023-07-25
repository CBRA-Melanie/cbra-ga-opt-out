<?php
/**
 * Plugin Name:     CBRA Google Analytics Opt Out
 * Plugin URI:      https://cbra.digital
 * Description:     Allow users to prevent being tracked by Google Analytics through the click of a button.
 * Author:          CBRA Digital
 */

/**
 * Renders a button to set an opt-out cookie for Google Analytics.
 * 
 * The shortcode also enqueues an external JS file which is necessary to actually
 * set the cookie. 
 * 
 * Accepted parameters: 'property', 'text', 'alert' & 'color'
 *
 * @see             /cbra-ga-opt-out.js     location of the external JS file
 * 
 * @since           1.0.0
 * 
 * @param           array                   $atts           the attributes for the shortcode
 * 
 * @return          string                  the HTML for the clickable button
 */
function cb_shortcode_opt_out($atts) {

    $defaults = array(
        'property'      => 'default',
        'text'          => 'Erfassung von Daten durch Google Analytics für diese Website deaktivieren',
        'alert'         => 'Google Analytics wurde deaktiviert',
        'color'         => 'black',
    );
    $atts = shortcode_atts($defaults, $atts);

    ob_start();

    // output the button to activate the JS
    ?>
    <a href="#" id="cb-ga-opt-out" style="color: <?= $atts['color'] ?>; font-weight: bold; text-decoration: none"><?= $atts['text'] ?></a><?php

    // enqueue the JS
    wp_register_script('ga-opt-out', WP_PLUGIN_URL . '/cbra-ga-opt-out/cbra-ga-opt-out.js');
    wp_localize_script('ga-opt-out', 'data', array(
        'property'  =>  $atts['property'],
        'alert'     =>  $atts['alert']
    ));
    wp_enqueue_script('ga-opt-out');

    return ob_get_clean();
}
add_shortcode('cb_ga_opt_out', 'cb_shortcode_opt_out');