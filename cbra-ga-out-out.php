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

    cb_do_opt_out($atts['property']);
    
    return '<a href="javascript:gaOptout();">Erfassung von Daten durch Google Analytics für diese Website deaktivieren</a>';
};

function cb_do_opt_out($property) {
   echo "<script>
            var gaProperty = '" . $property . "';
            var disableStr = 'ga-disable-' + gaProperty;

            if (document.cookie.indexOf(disableStr + '=true') > -1) {
                window[disableStr] = true;
            }
            
            function gaOptout() {
                document.cookie = disableStr + '=true; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';
                window[disableStr] = true;
            }
    </script>"; 
}
add_action('wp_head', 'cb_do_opt_out');
 ?>