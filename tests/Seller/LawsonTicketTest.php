<?php

declare(strict_types=1);

namespace Kin29\TicketHunter\Seller;

use Kin29\TicketHunter\Fake\Client;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CamelCaseMethodName)
 */
class LawsonTicketTest extends TestCase
{
    /** @var LawsonTicket */
    public $lawsonTicket;

    protected function setUp() : void
    {
        $this->lawsonTicket = new LawsonTicket;
        $this->lawsonTicket->setKeyword('test');
        $this->lawsonTicket->client = new Client\LawsonTicket;
    }

    public function testIsInstanceOfEplus() : void
    {
        $actual = $this->lawsonTicket;
        $this->assertInstanceOf(AbstractTicketVendor::class, $actual);
    }

    public function test_getList() : void
    {
        //todo
        $this->assertSame(1, 1);
    }
}
