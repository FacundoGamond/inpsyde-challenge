<?php

declare(strict_types=1);

namespace Facundogamond\InpsydeChallenge\Tests;

use Brain\Monkey;
use PHPUnit\Framework\TestCase;

abstract class SetupMonkey extends TestCase
{
    /**
     * Sets up the environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        Monkey\setUp();
    }

    /**
     * Tears down the environment.
     *
     * @return void
     */
    protected function tearDown(): void
    {
        Monkey\tearDown();
        parent::tearDown();
    }
}
