<?php
/**
 * Plugin Name:     CBRA Google Analytics Opt Out
 * Plugin URI:      https://cbra.digital
 * Description:     Sets a cookie that tells Google not to track. Use Shortcode [cb_ga_opt_out property="G-..."]
 * Author:          CBRA Digital
 */

add_shortcode('cb_ga_opt_out', 'cb_shortcode_opt_out');
function cb_shortcode_opt_out($atts) {
    ?>
    <a href="javascript:gaOptout();" onclick="alert('Google Analytics wurde deaktiviert');">Erfassung von Daten durch Google Analytics für diese Website deaktivieren</a>
    <?php
};

function cb_do_opt_out() {
   echo "<script>
            var gaProperty = 'G-XXXXXX';
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