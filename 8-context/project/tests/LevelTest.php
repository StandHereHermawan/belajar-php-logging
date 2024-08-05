<?php

namespace AriefKarditya\LocalDomainPhp;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Test\TestCase;

class LevelTest extends TestCase
{
    /**
     * @test
     */
    public function level() # level
    {
        $logger = new Logger(LevelTest::class);
        $logger->pushHandler(new StreamHandler("php://stderr"));

        $logger->debug("This is debug");
        $logger->info("This is info");
        $logger->notice("This is notice");
        $logger->warning("This is warning");
        $logger->error("This is error");
        $logger->critical("This is critical");
        $logger->alert("This is alert");
        $logger->emergency("This is emergency");

        TestCase::assertNotNull($logger);
    }

    /**
     * @test
     */
    public function streamHandler() # StreamHandler Level
    {
        $logger = new Logger(LevelTest::class);
        $logger->pushHandler(new StreamHandler("php://stderr"));
        $logger->pushHandler(new StreamHandler(__DIR__ . "/../error.log", Logger::ERROR));
        $logger->pushHandler(new StreamHandler(__DIR__ . "/../application-info.log", Logger::INFO));
        $logger->pushHandler(new StreamHandler(__DIR__ . "/../application-debug.log", Logger::DEBUG));

        $logger->debug("This is debug");
        $logger->info("This is info");
        $logger->notice("This is notice");
        $logger->warning("This is warning");
        $logger->error("This is error");
        $logger->critical("This is critical");
        $logger->alert("This is alert");
        $logger->emergency("This is emergency");

        TestCase::assertNotNull($logger);
    }
}
