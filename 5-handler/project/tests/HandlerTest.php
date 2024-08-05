<?php

namespace AriefKarditya\LocalDomainPhp;

use Monolog\Handler\Handler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Test\TestCase;

class HandlerTest extends TestCase
{
    /**
     * @test
     */
    public function HandlerName() # Menambah Handler
    {
        $logger = new Logger(HandlerTest::class);
        $logger->pushHandler(new StreamHandler("php://stderr"));
        $logger->pushHandler(new StreamHandler(__DIR__ . "/../application.log"));

        TestCase::assertNotNull($logger);
        TestCase::assertEquals(2, sizeof($logger->getHandlers()));
    }
}
