<?php

declare(strict_types=1);

namespace Facundogamond\InpsydeChallenge;

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
     * All Users Endpoint
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
        $request = wp_remote_get('https://jsonplaceholder.typicode.com/users');
        $response = $request['response'];
        $body = json_decode((string) $request['body'], true);

        if ($response['code'] != 200) {
            return CacheManage::WPREST($response);
        }

        return CacheManage::WPREST($this->buildTableGrid($body));
    }

    /**
     * Build html table
     */
    protected function buildTableGrid(array $users): ?string
    {
        ob_start();
        include plugin_dir_path(__FILE__) . '../templates/table.php';
        return ob_get_clean();
    }

    /**
     * User Detail Endpoint
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
        $id = $data['id'];
        $request = wp_remote_get("https://jsonplaceholder.typicode.com/users/{$id}");
        $response = $request['response'];
        $body = json_decode((string) $request['body'], true);

        if ($response['code'] != 200) {
            return CacheManage::WPREST($response);
        }

        return CacheManage::WPREST($body);
    }
}
