<?php 

namespace Facundogamond\InpsydeChallenge\Tests;

use Facundogamond\InpsydeChallenge\RestApiUsers;

class CustomEndpointsTest extends SetupMonkey{

    public function testHooks(){
        (new RestApiUsers());
        self::assertNotFalse( add_action('rest_api_init', [ RestApiUsers::class, 'allUsersRoute' ]) );
        self::assertNotFalse( add_action('rest_api_init', [ RestApiUsers::class, 'userDetailRoute' ]) );
    }
}

?>