<?php

namespace Facundogamond\InpsydeChallenge;

use GuzzleHttp\Client;

class RestApiUsers
{
    function __construct()
    {
        add_action('rest_api_init', array($this, 'getAllUsersRoute'));
        add_action('rest_api_init', array($this, 'getUserDetailRoute'));
    }

    function getAllUsersRoute()
    {
        register_rest_route('inpsyde-challenge', 'get-all-users', array(
            'methods' => \WP_REST_SERVER::READABLE,
            'callback' => array($this, 'getAllUsersResponse'),
            'permission_callback' => '__return_true'
        ));
    }

    public function getAllUsersResponse()
    {
        $client = new Client();

        $response = $client->get('https://jsonplaceholder.typicode.com/users');

        $users = json_decode((string) $response->getBody(), true);

        return $this->buildTableGrid($users);
    }

    protected function buildTableGrid($users)
    {
        ob_start(); ?>
        <div class="inpsyde-challenge__table" style="display: grid; grid-template-columns: repeat(3, 1fr);">
            <span>ID</span>
            <span>Name</span>
            <span>Username</span>

            <?php foreach ($users as $user) : ?>
                <a href="https://jsonplaceholder.typicode.com/posts/<?php echo esc_attr($user['id']) ?>">
                    <?php echo esc_html($user['id']) ?>
                </a>
                <a href="https://jsonplaceholder.typicode.com/posts/<?php echo esc_attr($user['id']) ?>">
                    <?php echo esc_html($user['name']); ?>
                </a>
                <a href="https://jsonplaceholder.typicode.com/posts/<?php echo esc_attr($user['id']) ?>">
                    <?php echo esc_html($user['username']); ?>
                </a>
                }

    <?php
            endforeach;
            return ob_get_clean();
        }

        /*function getUserDetailRoute()
        {
            register_rest_route('inpsyde-challenge', 'get-user-detail', array(
                'methods' => \WP_REST_SERVER::READABLE,
                'callback' => array($this, 'getAllUsersResponse'),
                'permission_callback' => '__return_true'
            ));
        }*/
    }
