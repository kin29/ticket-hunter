<?php

declare(strict_types=1);

namespace Kin29\TicketHunter;

use PHPUnit\Framework\TestCase;

class TicketHunterTest extends TestCase
{
    /**
     * @var TicketHunter
     */
    protected $ticketHunter;

    protected function setUp() : void
    {
        $this->ticketHunter = new TicketHunter;
    }

    public function testIsInstanceOfTicketHunter() : void
    {
        $actual = $this->ticketHunter;
        $this->assertInstanceOf(TicketHunter::class, $actual);
    }
}
