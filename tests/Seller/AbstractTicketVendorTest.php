<?php

declare(strict_types=1);

namespace Kin29\TicketHunter\Seller;

use PHPUnit\Framework\TestCase;

class AbstractTicketVendorTest extends TestCase
{
    public $abstractTicket;

    protected function setUp() : void
    {
        $this->abstractTicket = $this->getMockForAbstractClass(AbstractTicketVendor::class);
    }

    public function test_format() : void
    {
        $title = 'テスト公演';
        $dateTime = '2019/8/31(土)';
        $place = '山口きらら博記念公園(山口県)';
        $saleMethod = '一般発売';
        $saleStatus = '受付中';
        $link = 'http://example.com/';

        $actual = $this->abstractTicket->format($title, $dateTime, $place, $saleMethod, $saleStatus, $link);
        $extected = [
            'title' => $title,
            'date_time' => $dateTime,
            'place' => $place,
            'sale_method' => $saleMethod,
            'sale_status' => $saleStatus,
            'link' => $link,
        ];
        $this->assertSame($extected, $actual);
    }
}
