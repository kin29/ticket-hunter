<?php

declare(strict_types=1);

namespace Kin29\TicketHunter\Seller;

//use Kin29\TicketHunter\Fake\Client;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CamelCaseMethodName)
 */
class TicketPiaTest extends TestCase
{
    /** @var TicketPia */
    public $ticketPia;

    protected function setUp() : void
    {
        $this->ticketPia = new TicketPia;
        $this->ticketPia->setKeyword('test');
        //$this->ticketPia->client = new Client\TicketPia;
    }

    public function testIsInstanceOfTicketPia() : void
    {
        $actual = $this->ticketPia;
        $this->assertInstanceOf(AbstractTicketVendor::class, $actual);
    }

    public function test_getList() : void
    {
        //todo
        $this->assertSame(1, 1);
    }
}
