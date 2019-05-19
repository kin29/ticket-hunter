<?php

declare(strict_types=1);

namespace Kin29\TicketHunter;

use PHPUnit\Framework\TestCase;

class EplusTest extends TestCase
{
    /** @var Eplus */
    public $eplus;
    public $convertStatus;

    protected function setUp() : void
    {
        $this->eplus = new Eplus('test');

        $reflection = new \ReflectionClass($this->eplus);
        $this->convertStatus = $reflection->getMethod('convertStatus');
        $this->convertStatus->setAccessible(true);
    }

    public function testIsInstanceOfEplus() : void
    {
        $actual = $this->eplus;
        $this->assertInstanceOf(AbstractTicketVendor::class, $actual);
    }

    public function test_convertStatus_受付中() : void
    {
        $uketsukeStatus = 0;
        $eplusToriatsukaiAriFlag = true;
        $kyuenFlag = false;
        $this->assertSame(
            '受付中',
            $this->convertStatus->invokeArgs(
                $this->eplus,
                [$uketsukeStatus, $eplusToriatsukaiAriFlag, $kyuenFlag]
            )
        );
    }

    public function test_convertStatus_予定枚数終了() : void
    {
        $uketsukeStatus = 1;
        $eplusToriatsukaiAriFlag = true;
        $kyuenFlag = false;
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
        $eplusToriatsukaiAriFlag = true;
        $kyuenFlag = false;
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
        $eplusToriatsukaiAriFlag = true;
        $kyuenFlag = false;
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
        $eplusToriatsukaiAriFlag = true;
        $kyuenFlag = false;
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
        $eplusToriatsukaiAriFlag = true;
        $kyuenFlag = false;
        $this->assertSame(
            '受付終了',
            $this->convertStatus->invokeArgs(
                $this->eplus,
                [$uketsukeStatus, $eplusToriatsukaiAriFlag, $kyuenFlag]
            )
        );
    }

    public function test_convertStatus_扱いなし() : void
    {
        $uketsukeStatus = 5;
        $eplusToriatsukaiAriFlag = false; //ココだけみてる
        $kyuenFlag = false;
        $this->assertSame(
            '扱いなし',
            $this->convertStatus->invokeArgs(
                $this->eplus,
                [$uketsukeStatus, $eplusToriatsukaiAriFlag, $kyuenFlag]
            )
        );
    }

    public function test_convertStatus_休演() : void
    {
        $uketsukeStatus = 6;
        $eplusToriatsukaiAriFlag = true;
        $kyuenFlag = true; //ココだけみてる
        $this->assertSame(
            '休演',
            $this->convertStatus->invokeArgs(
                $this->eplus,
                [$uketsukeStatus, $eplusToriatsukaiAriFlag, $kyuenFlag]
            )
        );
    }
}
