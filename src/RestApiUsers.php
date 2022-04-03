<?php

namespace Facundogamond\InpsydeChallenge;

use GuzzleHttp\Client;
use Facundogamond\InpsydeChallenge\CacheManage;

class RestApiUsers
{
    function __construct()
    {
        add_action('rest_api_init', array($this, 'getAllUsersRoute'));
        add_action('rest_api_init', array($this, 'getUserDetailRoute'));
    }

    /**
     * Get all Users Data
     */
    public function getAllUsersRoute()
    {
        register_rest_route('inpsyde-challenge', 'get-all-users', array(
            'methods' => \WP_REST_SERVER::READABLE,
            'callback' => array($this, 'getAllUsersResponse'),
            'permission_callback' => '__return_true'
        ));
    }

    public function getAllUsersResponse()
    {
        // Get Users
        $client = new Client();
        $response = $client->get('https://jsonplaceholder.typicode.com/users');
        $users = json_decode((string) $response->getBody(), true);

        return CacheManage::WPREST($this->buildTableGrid($users));
    }

    protected function buildTableGrid($users)
    {
        ob_start();
?>
        <div class="inpsyde-challenge__table">
            <?php foreach ($users as $user) : ?>
                <article class="inpsyde-challenge__table-article">
                    <a class="inpsyde-challenge__id" href="<?php echo esc_attr($user['id']) ?>">
                        <?php echo esc_html($user['id']) ?>
                    </a>
                    <a class="inpsyde-challenge__name" href="<?php echo esc_attr($user['id']) ?>">
                        <?php echo esc_html($user['name']); ?>
                    </a>
                    <a class="inpsyde-challenge__username" href="<?php echo esc_attr($user['id']) ?>">
                        <?php echo esc_html($user['username']); ?>
                    </a>
                </article>

    <?php
            endforeach;
            return ob_get_clean();
        }

        /**
         * Get User Detail Data
         */
        public function getUserDetailRoute()
        {
            register_rest_route('inpsyde-challenge', 'get-user-detail', array(
                'methods' => \WP_REST_SERVER::READABLE,
                'callback' => array($this, 'getUserDetailResponse'),
                'permission_callback' => '__return_true'
            ));
        }

        public function getUserDetailResponse($data)
        {
            // Get id param
            $id = $data['id'];

            // Get user data
            $client = new Client();
            $response = $client->get("https://jsonplaceholder.typicode.com/users/{$id}");
            $userDetails = json_decode((string) $response->getBody(), true);
            
            return CacheManage::WPREST($userDetails);
        }
    }
