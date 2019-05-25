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
        $this->ticketHunter = new TicketHunter([], 'test');
    }

    public function test_stub() : void
    {
        $this->assertSame('1', '1');
    }
}
