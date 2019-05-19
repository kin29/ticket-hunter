<?php

declare(strict_types=1);

namespace Kin29\TicketHunter;

use PHPUnit\Framework\TestCase;

class AbstractTicketTest extends TestCase
{
    /** @var Eplus */
    public $abstractTicket;

    protected function setUp() : void
    {
        $this->abstractTicket = $this->getMockForAbstractClass(AbstractTicketVendor::class);
    }

    public function test_echoJson() : void
    {
        $title = 'テスト公演';
        $dateTime = '2019/8/31(土)';
        $place = '宮崎県';
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
