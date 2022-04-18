<?php

declare(strict_types=1);

namespace Facundogamond\InpsydeChallenge;

use Facundogamond\InpsydeChallenge\CacheManage;

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

    /**
     * Response for all users
     * @return object
     */
    public function allUsersResponse(): object
    {
        $request = wp_remote_get('https://jsonplaceholder.typicode.com/users');
        $response = $request['response'];
        $body = json_decode((string) $request['body'], true);

        if ($response['code'] !== 200) {
            return new \WP_Error(
                __('Error', 'inpsydechallenge'),
                $response['message'],
                ['status' => $response['code']]
            );
        }

        return CacheManage::WPREST($this->buildTableGrid($body));
    }

    /**
     * Build html table
     * @param array $users
     * @return string
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

    /**
     * Response for user details
     * @return object
     */
    public function userDetailResponse(object $data): object
    {
        $id = $data->get_params()['id'];
        $request = wp_remote_get("https://jsonplaceholder.typicode.com/users/{$id}");
        $response = $request['response'];
        $body = json_decode((string) $request['body'], true);

        if ($response['code'] !== 200) {
            return new \WP_Error(
                __('Error', 'inpsydechallenge'),
                $response['message'],
                ['status' => $response['code']]
            );
        }

        return CacheManage::WPREST($body);
    }
}
