<?php

declare(strict_types=1);

namespace Kin29\TicketHunter;

use PHPStan\Testing\TestCase;

class TicketPiaTest extends TestCase
{
    /** @var TicketPia */
    public $ticketPia;

    protected function setUp() : void
    {
        $this->ticketPia = new TicketPia('test');
    }

    public function testIsInstanceOfEplus() : void
    {
        $actual = $this->ticketPia;
        $this->assertInstanceOf(AbstractTicketVendor::class, $actual);
    }
}
