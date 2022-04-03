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
            wp_localize_script('inpsyde-challenge-functions', 'inpsydeChallenge', array(
                'rootapiurl' => esc_url_raw(rest_url()),
                'nonce' => wp_create_nonce('wp_rest')
            ));
            wp_enqueue_style('inpsyde-challenge-styles', plugins_url('../assets/build/inpsyde-challenge.min.css', __FILE__));
        } ?>

        <div class="inpsyde-challenge">
            <h1 class="inpsyde-challenge__title"><?php _e('Users Table', 'inpsydechallenge'); ?></h1>
            <div class="inpsyde-challenge__table-wrapper js-inpsyde-challenge">
                <div class="inpsyde-challenge__table-header">
                    <span class="inpsyde-challenge__col">ID</span>
                    <span class="inpsyde-challenge__col">Name</span>
                    <span class="inpsyde-challenge__col">Username</span>
                </div>
            </div>
            <div class="inpsyde-challenge__modal js-user-modal">
                <div class="inpsyde-challenge__modal-wrapper">
                    <button class="inpsyde-challenge__modal-closebtn js-user-modal-close">X</button>
                    <h4 class="js-user-name"></h4>
                    <h5 class="js-user-username"></h5>
                    <h6 class="inpsyde-challenge__job js-user-job"></h6>
                    <div class="inpsyde-challenge__modal-contact">
                        <a class="js-user-website" href="" target="_blank">Website</a>
                        <a class="js-user-phone" href="">Phone</a>
                        <a class="js-user-email" href="">Email</a>
                    </div>
                    <p class="inpsyde-challenge__modal-address js-user-address"></p>
                </div>
            </div>
        </div>

<?php
    }
}

?>