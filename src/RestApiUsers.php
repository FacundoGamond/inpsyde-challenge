<?php

declare(strict_types=1);

namespace Facundogamond\InpsydeChallenge;

use GuzzleHttp\Client;
use Facundogamond\InpsydeChallenge\CacheManage;
use WP_REST_Response;

class RestApiUsers
{
    public function __construct()
    {
        add_action('rest_api_init', [$this, 'allUsersRoute']);
        add_action('rest_api_init', [$this, 'userDetailRoute']);
    }

    /**
     * Get all Users Data
     */
    public function allUsersRoute()
    {
        register_rest_route(
            'inpsyde-challenge',
            'get-all-users',
            [
                'methods' => \WP_REST_SERVER::READABLE,
                'callback' => [$this, 'allUsersResponse'],
                'permission_callback' => '__return_true',
            ]
        );
    }

    public function allUsersResponse(): ?WP_REST_Response
    {
        // Get Users
        $client = new Client();
        $response = $client->get('https://jsonplaceholder.typicode.com/users');
        $users = json_decode((string) $response->getBody(), true);

        return CacheManage::WPREST($this->buildTableGrid($users));
    }

    protected function buildTableGrid(array $users): ?string
    {
        ob_start();
        ?>
        <div class="inpsyde-challenge__table">
            <?php foreach ($users as $user) : ?>
                <article class="inpsyde-challenge__table-article">
                    <a class="inpsyde-challenge__id"
                        href="<?php echo esc_url("https://jsonplaceholder.typicode.com/users/{$user['id']}"); ?>"
                        data-id="<?php echo esc_attr($user['id']); ?>">                        
                        <?php echo esc_html($user['id']) ?>
                    </a>
                    <a class="inpsyde-challenge__name"
                        href="<?php echo esc_url("https://jsonplaceholder.typicode.com/users/{$user['id']}"); ?>"
                        data-id="<?php echo esc_attr($user['id']); ?>">
                        <?php echo esc_html($user['name']); ?>
                    </a>
                    <a class="inpsyde-challenge__username"
                        href="<?php echo esc_url("https://jsonplaceholder.typicode.com/users/{$user['id']}"); ?>"
                        data-id="<?php echo esc_attr($user['id']); ?>">
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
    public function userDetailRoute()
    {
        register_rest_route(
            'inpsyde-challenge',
            'get-user-detail',
            [
                'methods' => \WP_REST_SERVER::READABLE,
                'callback' => [$this, 'userDetailResponse'],
                'permission_callback' => '__return_true',
            ]
        );
    }

    public function userDetailResponse(object $data): ?WP_REST_Response
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
