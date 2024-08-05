<?php

namespace AriefKarditya\LocalDomainPhp;

use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\GitProcessor;
use Monolog\Processor\HostnameProcessor;
use Monolog\Processor\MemoryUsageProcessor;
use Monolog\Test\TestCase;

class FormatterTest extends TestCase
{
    /**
     * @test
     */
    public function formatterJson() # formatter
    {
        $logger = new Logger(LoggingTest::class);

        $handler = new StreamHandler("php://stderr");
        $handler->setFormatter(new JsonFormatter());

        $logger->pushHandler($handler);

        $logger->pushProcessor(new GitProcessor());
        $logger->pushProcessor(new MemoryUsageProcessor());
        $logger->pushProcessor(new HostnameProcessor());

        $logger->info("Selamat belajar PHP Logging", ["username" => "Terry"]);
        $logger->info("Selamat belajar PHP Logging", ["username" => "Terry"]);

        TestCase::assertNotNull($logger);
    }
}
