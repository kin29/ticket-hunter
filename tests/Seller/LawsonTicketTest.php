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

    public function testIsInstanceOfLawsonTicket() : void
    {
        $actual = $this->lawsonTicket;
        $this->assertInstanceOf(AbstractTicketVendor::class, $actual);
    }

    public function test_getList() : void
    {
        $expect = [
            [
                'title' => 'japan tour',
                'date_time' => '2019/1/1(火)',
                'pref_id' => '13',
                'pref_name' => '東京都',
                'stage' => '日本武道館',
                'sale_method' => '先着',
                'sale_status' => '予定枚数終了',
                'link' => 'https://l-tike.com/order/?gLcode=1111&gPfKey=2019010101010101&gEntryMthd=01&gScheduleNo=1&gPfName=japan%2Btour&gBaseVenueCd=22222',
            ],
        ];

        $this->assertSame(
            $expect,
            $this->lawsonTicket->getList()
        );
    }
}
