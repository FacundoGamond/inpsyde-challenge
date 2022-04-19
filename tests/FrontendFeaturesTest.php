<?php

declare(strict_types=1);

namespace Facundogamond\InpsydeChallenge\Tests;

use Facundogamond\InpsydeChallenge\FrontendFeatures;

class FrontendFeaturesTest extends SetupMonkey
{
    public function testHooks()
    {
        (new FrontendFeatures());
        self::assertNotFalse(
            add_action('init', [ FrontendFeatures::class, 'rewriteRules' ])
        );
        self::assertNotFalse(
            add_filter('query_vars', [ FrontendFeatures::class, 'queryVars' ])
        );
        self::assertNotFalse(
            add_action('template_include', [ FrontendFeatures::class, 'template' ])
        );
        self::assertNotFalse(
            [ FrontendFeatures::class, 'scripts' ]
        );
    }
}
