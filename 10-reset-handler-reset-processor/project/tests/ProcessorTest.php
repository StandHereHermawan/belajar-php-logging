<?php

namespace AriefKarditya\LocalDomainPhp;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\GitProcessor;
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

        $logger->info("Test");

        TestCase::assertNotNull($logger);
    }

    /**
     * @test
     */
    public function processorMonolog()
    {
        $logger = new Logger(ProcessorTest::class);
        $logger->pushHandler(new StreamHandler("php://stderr"));
        $logger->pushProcessor(new GitProcessor());
        $logger->pushProcessor(new MemoryUsageProcessor());
        $logger->pushProcessor(function ($record) {
            $record['extra']['admin'] = [
                "author" => "Arief Karditya Hermawan",
                "app" => "Belajar PHP Logging"
            ];
            return $record;
        });

        $logger->debug("Test");

        TestCase::assertNotNull($logger);
    }

    /**
     * @test
     */
    public function processorMonologLooping()
    {
        $logger = new Logger(ProcessorTest::class);
        // $logger->pushHandler(new StreamHandler("php://stderr"));
        $logger->pushHandler(new StreamHandler(__DIR__ . "/../application.log"));
        $logger->pushProcessor(new GitProcessor());
        $logger->pushProcessor(new MemoryUsageProcessor());
        $logger->pushProcessor(function ($record) {
            $record['extra']['admin'] = [
                "author" => "Arief Karditya Hermawan",
                "app" => "Belajar PHP Logging"
            ];
            return $record;
        });

        for ($i = 0; $i < 5000; $i++) {
            $logger->info("Loop ke-" . ($i + 1) . ".");
            if ($i % 100 == 0) {
                $logger->reset();
            }
        }

        TestCase::assertNotNull($logger);
    }
}
