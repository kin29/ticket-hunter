<?php

declare(strict_types=1);

namespace Kin29\TicketHunter;

use PHPUnit\Framework\TestCase;

class LawsonTicketTest extends TestCase
{
    /** @var LawsonTicket */
    public $lawsonTicket;

    protected function setUp() : void
    {
        $this->lawsonTicket = new LawsonTicket('test');
    }

    public function testIsInstanceOfEplus() : void
    {
        $actual = $this->lawsonTicket;
        $this->assertInstanceOf(AbstractTicketVendor::class, $actual);
    }
}
