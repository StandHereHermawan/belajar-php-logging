<?php

namespace AriefKarditya\LocalDomainPhp;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Test\TestCase;

class ContextTest extends TestCase
{
    /**
     * @test
     */
    public function context()
    {
        $logger = new Logger(ContextTest::class);
        $logger->pushHandler(new StreamHandler("php://stderr"));

        $logger->info("Request user login", ["username" => "Arief"]);
        $logger->info("Try user login", ["username" => "Arief"]);
        $logger->info("Success user login", ["username" => "Arief"]);
        $logger->info("Log info tanpa konteks");

        TestCase::assertNotNull($logger);
    }
}
