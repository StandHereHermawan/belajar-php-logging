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

    /**
     * @test
     */
    public function formatterJson() # formatter
    {
        $logger = new Logger(LoggingTest::class);

        $handler = new StreamHandler("php://stderr");
        $handler->setFormatter(new JsonFormatter());

        $logger->pushHandler($handler);

        $logger->info("Selamat belajar PHP Logging");

        TestCase::assertNotNull($logger);
    }
}
