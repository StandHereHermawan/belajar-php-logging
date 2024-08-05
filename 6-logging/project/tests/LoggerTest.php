<?php

namespace AriefKarditya\LocalDomainPhp;

use Monolog\Handler\Handler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;

class LoggerTest extends TestCase
{
    /**
     * @test
     */
    public function Logger() # Membuat logger
    {
        $logger = new Logger("AriefKarditya");

        TestCase::assertNotNull($logger);
    }

    /**
     * @test
     */
    public function LoggerName() # membuat logger dengan nama
    {
        $logger = new Logger(LoggerTest::class);

        TestCase::assertNotNull($logger);
    }

    /**
     * @test
     */
    public function HandlerName() # Menambah Handler
    {
        $logger = new Logger(Handler::class);
        $logger->pushHandler(new StreamHandler("php://stderr"));
        $logger->pushHandler(new StreamHandler(__DIR__ . "/../application.log"));

        TestCase::assertEquals(2, sizeof($logger->getHandlers()));
    }
}
