<?php

namespace AriefKarditya\LocalDomainPhp;

use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Test\TestCase;

class LoggingTest extends TestCase
{
    /**
     * @test
     */
    public function logging()
    {
        $logger = new Logger(LoggingTest::class);
        $logger->pushHandler(new StreamHandler("php://stderr"));
        $logger->pushHandler(new StreamHandler(__DIR__ . "/../application.log"));

        $logger->info("Selamat Belajar PHP Logging");

        TestCase::assertNotNull($logger);
    }
}
