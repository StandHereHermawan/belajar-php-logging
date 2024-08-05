<?php

namespace AriefKarditya\LocalDomainPhp;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\GitProcessor;
use Monolog\Processor\HostnameProcessor;
use Monolog\Processor\MemoryPeakUsageProcessor;
use Monolog\Processor\MemoryUsageProcessor;
use Monolog\Test\TestCase;


class ProcessorTest extends TestCase
{
    /**
     * @test
     */
    public function processor()
    {
        $logger = new Logger(ProcessorTest::class);
        $logger->pushHandler(new StreamHandler("php://stderr"));
        $logger->pushProcessor(function ($record) {
            $record['extra']['admin'] = [
                "author" => "Arief Karditya Hermawan",
                "app" => "Belajar PHP Logging"
            ];
            return $record;
        });

        for ($i = 0; $i < 10; $i++) {
            $logger->info("Test ke-" . ($i + 1) . ".");
        }

        TestCase::assertNotNull($logger);
    }

    /**
     * @test
     */
    public function againProcessorMonolog()
    {
        $logger = new Logger(ProcessorTest::class);
        $logger->pushHandler(new StreamHandler("php://stderr"));
        $logger->pushProcessor(new GitProcessor());
        $logger->pushProcessor(new MemoryPeakUsageProcessor());
        $logger->pushProcessor(new MemoryUsageProcessor());
        $logger->pushProcessor(new HostnameProcessor());
        $logger->pushProcessor(function ($record) {
            $record['extra']['admin'] = [
                "author" => "Arief Karditya Hermawan",
                "app" => "Belajar PHP Logging"
            ];
            return $record;
        });

        for ($i = 0; $i < 3; $i++) {
            $logger->info("Test ke-" . ($i + 1) . ".");
        }

        TestCase::assertNotNull($logger);
    }
}
