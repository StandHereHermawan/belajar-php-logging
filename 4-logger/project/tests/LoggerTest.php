<?php

namespace AriefKarditya\LocalDomainPhp;

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
}
