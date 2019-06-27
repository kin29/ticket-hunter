<?php

declare(strict_types=1);

namespace Kin29\TicketHunter\Seller;

use Kin29\TicketHunter\Fake\Client;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CamelCaseMethodName)
 */
class EplusTest extends TestCase
{
    /** @var Eplus */
    public $eplus;
    public $convertStatus;
    public $convertDate;

    protected function setUp() : void
    {
        $this->eplus = new Eplus;
        $this->eplus->setKeyword('test');

        $reflection = new \ReflectionClass($this->eplus);
        $this->convertStatus = $reflection->getMethod('convertStatus');
        $this->convertStatus->setAccessible(true);

        $this->convertDate = $reflection->getMethod('convertDate');
        $this->convertDate->setAccessible(true);

        $this->eplus->client = new Client\Eplus;
    }

    public function testIsInstanceOfEplus() : void
    {
        $actual = $this->eplus;
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
                'link' => 'https://eplus.jp/url_pc_test',
            ],
            [
                'title' => 'japan tour2',
                'date_time' => '2019/1/2(水)',
                'pref_id' => '12',
                'pref_name' => '千葉県',
                'stage' => '幕張メッセ',
                'sale_method' => '一般',
                'sale_status' => '休演',
                'link' => 'https://eplus.jp/url_pc_test2',
            ],
            [
                'title' => 'japan tour3',
                'date_time' => '2019/1/3(木)',
                'pref_id' => '40',
                'pref_name' => '福岡県',
                'stage' => 'マリンメッセ福岡',
                'sale_method' => '一般',
                'sale_status' => '扱いなし',
                'link' => 'https://eplus.jp/url_pc_test3',
            ],
        ];

        $this->assertSame(
            $expect,
            $this->eplus->getList()
        );
    }

    public function test_convertDate() : void
    {
        $this->assertSame(
            '2019/1/1(火)',
            $this->convertDate->invoke(
                $this->eplus,
                '2019-01-01'
            )
        );
    }

    public function test_convertStatus_受付中() : void
    {
        $uketsukeStatus = 0;
        $eplusToriatsukaiAriFlag = true; //必ずtrueの時
        $kyuenFlag = false; //必ずfalseの時
        $this->assertSame(
            '受付中',
            $this->convertStatus->invokeArgs(
                $this->eplus,
                [$uketsukeStatus, $eplusToriatsukaiAriFlag, $kyuenFlag]
            )
        );
    }

    public function test_convertStatus_休演() : void
    {
        $uketsukeStatus = 1;
        $eplusToriatsukaiAriFlag = true;
        $kyuenFlag = true; //ココだけみてる
        $this->assertSame(
            '休演',
            $this->convertStatus->invokeArgs(
                $this->eplus,
                [$uketsukeStatus, $eplusToriatsukaiAriFlag, $kyuenFlag]
            )
        );

        $uketsukeStatus = 1;
        $eplusToriatsukaiAriFlag = false;
        $kyuenFlag = true; //ココだけみてる
        $this->assertSame(
            '休演',
            $this->convertStatus->invokeArgs(
                $this->eplus,
                [$uketsukeStatus, $eplusToriatsukaiAriFlag, $kyuenFlag]
            )
        );
    }

    public function test_convertStatus_扱いなし() : void
    {
        $uketsukeStatus = 1;
        $eplusToriatsukaiAriFlag = false; //ココだけみてる
        $kyuenFlag = false; //必ずfalseの時
        $this->assertSame(
            '扱いなし',
            $this->convertStatus->invokeArgs(
                $this->eplus,
                [$uketsukeStatus, $eplusToriatsukaiAriFlag, $kyuenFlag]
            )
        );

        $uketsukeStatus = 1;
        $eplusToriatsukaiAriFlag = false; //ココだけみてる
        $kyuenFlag = false; //必ずfalseの時
        $this->assertSame(
            '扱いなし',
            $this->convertStatus->invokeArgs(
                $this->eplus,
                [$uketsukeStatus, $eplusToriatsukaiAriFlag, $kyuenFlag]
            )
        );
    }

    public function test_convertStatus_予定枚数終了() : void
    {
        $uketsukeStatus = 1;
        $eplusToriatsukaiAriFlag = true; //必ずtrueの時
        $kyuenFlag = false; //必ずfalseの時
        $this->assertSame(
            '予定枚数終了',
            $this->convertStatus->invokeArgs(
                $this->eplus,
                [$uketsukeStatus, $eplusToriatsukaiAriFlag, $kyuenFlag]
            )
        );
    }

    public function test_convertStatus_受付前1() : void
    {
        $uketsukeStatus = 2;
        $eplusToriatsukaiAriFlag = true; //必ずtrueの時
        $kyuenFlag = false; //必ずfalseの時
        $this->assertSame(
            '受付前',
            $this->convertStatus->invokeArgs(
                $this->eplus,
                [$uketsukeStatus, $eplusToriatsukaiAriFlag, $kyuenFlag]
            )
        );
    }

    public function test_convertStatus_受付前2() : void
    {
        $uketsukeStatus = 3;
        $eplusToriatsukaiAriFlag = true; //必ずtrueの時
        $kyuenFlag = false; //必ずfalseの時
        $this->assertSame(
            '受付前',
            $this->convertStatus->invokeArgs(
                $this->eplus,
                [$uketsukeStatus, $eplusToriatsukaiAriFlag, $kyuenFlag]
            )
        );
    }

    public function test_convertStatus_受付終了1() : void
    {
        $uketsukeStatus = 4;
        $eplusToriatsukaiAriFlag = true; //必ずtrueの時
        $kyuenFlag = false; //必ずfalseの時
        $this->assertSame(
            '受付終了',
            $this->convertStatus->invokeArgs(
                $this->eplus,
                [$uketsukeStatus, $eplusToriatsukaiAriFlag, $kyuenFlag]
            )
        );
    }

    public function test_convertStatus_受付終了2() : void
    {
        $uketsukeStatus = 5;
        $eplusToriatsukaiAriFlag = true; //必ずtrueの時
        $kyuenFlag = false; //必ずfalseの時
        $this->assertSame(
            '受付終了',
            $this->convertStatus->invokeArgs(
                $this->eplus,
                [$uketsukeStatus, $eplusToriatsukaiAriFlag, $kyuenFlag]
            )
        );
    }

    public function test_convertStatus_それ以外() : void
    {
        $uketsukeStatus = 6;
        $eplusToriatsukaiAriFlag = true; //必ずtrueの時
        $kyuenFlag = false; //必ずfalseの時
        $this->assertSame(
            '',
            $this->convertStatus->invokeArgs(
                $this->eplus,
                [$uketsukeStatus, $eplusToriatsukaiAriFlag, $kyuenFlag]
            )
        );
    }
}
