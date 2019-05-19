<?php

declare(strict_types=1);

namespace Kin29\TicketHunter;

use PHPUnit\Framework\TestCase;

class EplusTest extends TestCase
{
    /** @var Eplus */
    public $eplus;

    protected function setUp() : void
    {
        $this->eplus = new Eplus('test');
    }

    public function testIsInstanceOfEplus() : void
    {
        $actual = $this->eplus;
        $this->assertInstanceOf(AbstractTicketVendor::class, $actual);
    }
}
