<?php

declare(strict_types=1);

namespace Kin29\TicketHunter\Seller;

use PHPUnit\Framework\TestCase;
use Goutte\Client;

/**
 * @SuppressWarnings(PHPMD.CamelCaseMethodName)
 */
class AbstractTicketVendorTest extends TestCase
{
    public $abstractTicket;

    protected function setUp() : void
    {
        $this->abstractTicket = $this->getMockForAbstractClass(AbstractTicketVendor::class, [new Client]);
    }

    public function test_stub() : void
    {
        $this->assertSame(1, 1);
    }
}
