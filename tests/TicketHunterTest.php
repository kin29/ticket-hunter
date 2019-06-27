<?php

declare(strict_types=1);

namespace Kin29\TicketHunter;

use Kin29\TicketHunter\Seller\AbstractTicketVendor;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CamelCaseMethodName)
 */
class TicketHunterTest extends TestCase
{
    /**
     * @var TicketHunter
     */
    protected $ticketHunter;

    protected function setUp() : void
    {
        $this->ticketHunter = new TicketHunter([]);
    }

    public function test_存在する販売店オブジェクトのみを渡した時_単数() : void
    {
        $vendorName = 'TicketPia';
        $ticketHunter = new TicketHunter([$vendorName]);
        $this->assertArrayHasKey($vendorName, $ticketHunter->arrVendorObj);
    }

    public function test_存在する販売店オブジェクトのみを渡した時_複数() : void
    {
        $vendorName1 = 'TicketPia';
        $vendorName2 = 'Eplus';
        $vendorName3 = 'LawsonTicket';
        $ticketHunter = new TicketHunter([$vendorName1, $vendorName2, $vendorName3]);
        $this->assertArrayHasKey($vendorName1, $ticketHunter->arrVendorObj);
        $this->assertArrayHasKey($vendorName2, $ticketHunter->arrVendorObj);
        $this->assertArrayHasKey($vendorName3, $ticketHunter->arrVendorObj);
    }

    public function test_存在しない販売店オブジェクトを渡した時_単数() : void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('Class "Kin29\\TicketHunter\\Seller\\not_exist_vendor_name" not found');

        new TicketHunter(['not_exist_vendor_name']);
    }

    public function test_存在しない販売店オブジェクトを渡した時_複数() : void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('Class "Kin29\\TicketHunter\\Seller\\not_exist_vendor_name" not found');

        new TicketHunter(['TicketPia', 'not_exist_vendor_name']);
    }

    public function test_getList_通常時() : void
    {
        $mockAbstractTicketVendor = $this->createMock(AbstractTicketVendor::class);
        $mockAbstractTicketVendor->method('setKeyword')
            ->willReturn($mockAbstractTicketVendor);
        $mockAbstractTicketVendor->method('getList')
            ->willReturn([
                'title' => 'japan tour',
                'date_time' => '2019/01/01(火)',
                'pref_id' => '13',
                'pref_name' => '東京都',
                'stage' => '日本武道館',
                'sale_method' => '一般販売',
                'sale_status' => '販売中',
                'link' => 'https://kin29.info/'
            ]);

        $ticketHunter = new TicketHunter;
        $ticketHunter->arrVendorObj = [];
        $ticketHunter->arrVendorObj['TicketPia'] = $mockAbstractTicketVendor;
        $ticketHunter->arrVendorObj['Eplus'] = $mockAbstractTicketVendor;
        $ticketHunter->arrVendorObj['LawsonTicket'] = $mockAbstractTicketVendor;

        $expect = [
            'TicketPia' => [
                'title' => 'japan tour',
                'date_time' => '2019/01/01(火)',
                'pref_id' => '13',
                'pref_name' => '東京都',
                'stage' => '日本武道館',
                'sale_method' => '一般販売',
                'sale_status' => '販売中',
                'link' => 'https://kin29.info/'
            ],
            'Eplus' => [
                'title' => 'japan tour',
                'date_time' => '2019/01/01(火)',
                'pref_id' => '13',
                'pref_name' => '東京都',
                'stage' => '日本武道館',
                'sale_method' => '一般販売',
                'sale_status' => '販売中',
                'link' => 'https://kin29.info/'
            ],
            'LawsonTicket' => [
                'title' => 'japan tour',
                'date_time' => '2019/01/01(火)',
                'pref_id' => '13',
                'pref_name' => '東京都',
                'stage' => '日本武道館',
                'sale_method' => '一般販売',
                'sale_status' => '販売中',
                'link' => 'https://kin29.info/'
            ]
        ];

        $this->assertSame($expect, $ticketHunter->getList());
    }

    public function test_getList_空の時() : void
    {
        $mockAbstractTicketVendor = $this->createMock(AbstractTicketVendor::class);
        $mockAbstractTicketVendor->method('setKeyword')
            ->willReturn($mockAbstractTicketVendor);
        $mockAbstractTicketVendor->method('getList')
            ->willReturn([]);

        $ticketHunter = new TicketHunter;
        $ticketHunter->arrVendorObj = [];
        $ticketHunter->arrVendorObj['TicketPia'] = $mockAbstractTicketVendor;
        $ticketHunter->arrVendorObj['Eplus'] = $mockAbstractTicketVendor;
        $ticketHunter->arrVendorObj['LawsonTicket'] = $mockAbstractTicketVendor;

        $expect = [
            'TicketPia' => [],
            'Eplus' => [],
            'LawsonTicket' => []
        ];

        $this->assertSame($expect, $ticketHunter->getList());
    }
}
