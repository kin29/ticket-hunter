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

    public function test_存在する販売店オブジェクトのみを渡した時_単数() : void
    {
        $vendorName = 'TicketPia';
        $ticketHunter = new TicketHunter([$vendorName], 'test');
        $this->assertArrayHasKey($vendorName, $ticketHunter->arrVendorObj);
    }

    public function test_存在する販売店オブジェクトのみを渡した時_複数() : void
    {
        $vendorName1 = 'TicketPia';
        $vendorName2 = 'Eplus';
        $vendorName3 = 'LawsonTicket';
        $ticketHunter = new TicketHunter([$vendorName1, $vendorName2, $vendorName3], 'test');
        $this->assertArrayHasKey($vendorName1, $ticketHunter->arrVendorObj);
        $this->assertArrayHasKey($vendorName2, $ticketHunter->arrVendorObj);
        $this->assertArrayHasKey($vendorName3, $ticketHunter->arrVendorObj);
    }

    public function test_存在しない販売店オブジェクトを渡した時_単数() : void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('Class "Kin29\\TicketHunter\\Seller\\not_exist_vendor_name" not found');

        new TicketHunter(['not_exist_vendor_name'], 'test');
    }

    public function test_存在しない販売店オブジェクトを渡した時_複数() : void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('Class "Kin29\\TicketHunter\\Seller\\not_exist_vendor_name" not found');

        new TicketHunter(['TicketPia', 'not_exist_vendor_name'], 'test');
    }
}
