<?php

namespace Facundogamond\InpsydeChallenge;

class CacheManage
{
    static function WPREST($data)
    {
        $result = new \WP_REST_Response($data, 200);
        
        // Set headers.
        $result->set_headers(array('Cache-Control' => 'max-age=3600'));

        return $result;
    }
}
