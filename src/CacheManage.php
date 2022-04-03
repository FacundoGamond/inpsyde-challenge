<?php

declare(strict_types=1);

namespace Facundogamond\InpsydeChallenge;

class CacheManage
{
    // phpcs:disable
    public static function WPREST($data)
    {
        $result = new \WP_REST_Response($data, 200);

        // Set headers.
        $result->set_headers(['Cache-Control' => 'max-age=3600']);

        return $result;
    }
}
