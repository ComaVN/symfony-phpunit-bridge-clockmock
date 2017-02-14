<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bridge\PhpUnit\ClockMock;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        ClockMock::register(__CLASS__);
    }

    /**
     * @group time-sensitive
     */
    public function testTimeMock_annotation()
    {
        $time = time();
        sleep(5);
        $this->assertSame(5, time() - $time);
    }

    public function testTimeMock_explicit()
    {
        ClockMock::withClockMock(true);
        try {
            $time = time();
            sleep(5);
            $this->assertSame(5, time() - $time);
        } finally {
            ClockMock::withClockMock(false);
        }
    }
}
