<?php

namespace AriefKarditya\LocalDomainPhp;

use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;

class RollingFileTest extends TestCase
{
    /**
     * @test
     */
    public function rotating()
    {
        $logger = new Logger(RollingFileTest::class);
        $logger->pushHandler(new RotatingFileHandler(__DIR__ . "/../app.log", 10, Logger::INFO));

        for ($i = 0; $i < 10000; $i++) {
            $logger->info("Test ke-$i");
        }

        TestCase::assertNotNull($logger);
    }
}
