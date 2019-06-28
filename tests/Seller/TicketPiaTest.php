<?php

declare(strict_types=1);

namespace Kin29\TicketHunter\Seller;

use Kin29\TicketHunter\Fake\Client;
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
        $this->ticketPia->client = new Client\TicketPia;
    }

    public function testIsInstanceOfTicketPia() : void
    {
        $actual = $this->ticketPia;
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
                'link' => 'https://kin29.info/',
            ],
        ];

        $this->assertSame(
            $expect,
            $this->ticketPia->getList()
        );
    }
}
