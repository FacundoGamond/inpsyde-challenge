<?php

declare(strict_types=1);

namespace Facundogamond\InpsydeChallenge;

class FrontendFeatures
{
    public function __construct()
    {
        add_action('init', [$this, 'rewriteRules']);
        add_filter('query_vars', [$this, 'queryVars']);
        add_action('template_include', [$this, 'setTemplate']);
    }

    /**
     * Register Rewrite Rules
     */
    public function rewriteRules()
    {
        add_rewrite_rule('users/?$', 'index.php?my_page=user', 'top');
        flush_rewrite_rules();
    }

    /**
     * Adding query vars
     */
    public function queryVars($queryVars)
    {
        $queryVars[] = 'my_page';
        return $queryVars;
    }

    /**
     * Templates
     */
    public function setTemplate($template)
    {
        $page = get_query_var('my_page');

        if ($page == 'user') {
            $this->scripts();
            include(plugin_dir_path(__FILE__) . '/../templates/users.php');
            die();
            return;
        } else {
            return $template;
        }
    }

    /**
     * Enqueue Scripts
     */
    protected function scripts()
    {
        wp_enqueue_script(
            'inpsyde-challenge-functions',
            plugins_url('../assets/build/inpsyde-challenge.min.js', __FILE__),
            null,
            '1.0',
            true
        );
        wp_localize_script(
            'inpsyde-challenge-functions',
            'inpsydeChallenge',
            [
                'rootapiurl' => esc_url_raw(rest_url()),
                'nonce' => wp_create_nonce('wp_rest'),
            ]
        );
        wp_enqueue_style(
            'inpsyde-challenge-styles',
            plugins_url('../assets/build/inpsyde-challenge.min.css', __FILE__),
            null,
            '1.0'
        );
    }
}
