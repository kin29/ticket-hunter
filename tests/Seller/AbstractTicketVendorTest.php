<?php

declare(strict_types=1);

namespace Kin29\TicketHunter\Seller;

use Goutte\Client;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CamelCaseMethodName)
 */
class AbstractTicketVendorTest extends TestCase
{
    public $abstractTicket;

    protected function setUp() : void
    {
        $mockClient = $this->getMockBuilder(Client::class)
            ->getMock();
        $this->abstractTicket = $this->getMockForAbstractClass(AbstractTicketVendor::class, [$mockClient, 'https://test.com?keyword=']);
    }

    public function test__construct() : void
    {
        $this->assertInstanceOf(Client::class, $this->abstractTicket->client);
        $this->assertSame('https://test.com?keyword=', $this->abstractTicket->requestUrl);
    }

    public function test_setKeyword_引数セットなし() : void
    {
        $this->abstractTicket->setKeyword();
        $this->assertSame('https://test.com?keyword=', $this->abstractTicket->requestUrl);
    }

    public function test_setKeyword_引数セットあり() : void
    {
        $this->abstractTicket->setKeyword('test');
        $this->assertSame('https://test.com?keyword=test', $this->abstractTicket->requestUrl);
    }
}
