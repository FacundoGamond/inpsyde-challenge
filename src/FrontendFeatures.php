<?php

namespace Facundogamond\InpsydeChallenge;

class FrontendFeatures
{
    function __construct()
    {
        add_shortcode('inpsyde-challenge', array($this, 'inpsydeChallegeFrontend'));
    }

    function inpsydeChallegeFrontend()
    {
        if (!is_admin()) {
            wp_enqueue_script('inpsyde-challenge-functions', plugins_url('../assets/build/inpsyde-challenge.min.js', __FILE__), array());
            wp_localize_script('inpsyde-challenge-function', 'inpsydeChallenge', array(
                'rootapiurl' => esc_url_raw(rest_url()),
                'nonce' => wp_create_nonce('wp_rest')
            ));
            wp_enqueue_style('inpsyde-challenge-styles', plugins_url('../assets/build/inpsyde-challenge.min.css', __FILE__));
        } ?>

        <h1><?php _e('Hello Inpsyde!!', 'inpsydechallenge'); ?></h1>
        <div class="inpsyde-challenge js-inpsyde-challenge">
        </div>

<?php
    }
}

?>