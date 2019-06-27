<?php

declare(strict_types=1);

namespace Kin29\TicketHunter;

use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CamelCaseMethodName)
 */
class FormatTest extends TestCase
{
    public $formatObj;

    protected function setUp() : void
    {
        $this->formatObj = new class {
            use Format;
        };
    }

    public function test_toJson() : void
    {
        $arrList = ['foo', 'bar'];
        $this->assertSame(json_encode($arrList), $this->formatObj->toJson($arrList));
    }

    public function test_echoJson() : void
    {
        $arrList = ['foo', 'bar'];
        ob_start();
        $this->formatObj->echoJson($arrList);
        $actual = ob_get_clean();
        $this->assertSame(json_encode($arrList), $actual);
    }

    public function test_format() : void
    {
        $title = 'テスト公演';
        $dateTime = '2019/8/31(土)';
        $prefName = '山口県';
        $stage = '山口きらら博記念公園';
        $saleMethod = '一般発売';
        $saleStatus = '受付中';
        $link = 'http://example.com/';

        $actual = $this->formatObj->format($title, $dateTime, $prefName, $stage, $saleMethod, $saleStatus, $link);
        $extected = [
            'title' => $title,
            'date_time' => $dateTime,
            'pref_id' => '35',
            'pref_name' => $prefName,
            'stage' => $stage,
            'sale_method' => $saleMethod,
            'sale_status' => $saleStatus,
            'link' => $link,
        ];
        $this->assertSame($extected, $actual);
    }

    public function test_format_null() : void
    {
        $actual = $this->formatObj->format();
        $extected = [
            'title' => '',
            'date_time' => '',
            'pref_id' => '',
            'pref_name' => '',
            'stage' => '',
            'sale_method' => '',
            'sale_status' => '',
            'link' => '',
        ];
        $this->assertSame($extected, $actual);
    }

    /**
     * @dataProvider prefAdditionProvider
     */
    public function test_toPrefId($prefId, $prefName) : void
    {
        $this->assertSame(
            $this->formatObj->toPrefId($prefName),
            $prefId
        );
    }

    public function test_toPrefId_no_exist() : void
    {
        $this->assertSame(
            $this->formatObj->toPrefId('ロンドン'),
            null
        );
    }

    public function test_toPrefId_null() : void
    {
        $this->assertSame(
            $this->formatObj->toPrefId(null),
            null
        );
    }

    /**
     * @dataProvider prefAdditionProvider
     */
    public function test_toPrefName($prefId, $prefName) : void
    {
        $this->assertSame(
            $this->formatObj->toPrefName($prefId),
            $prefName
        );
    }

    public function test_toPrefName_no_exist_0() : void
    {
        $this->assertSame(
            $this->formatObj->toPrefName(0),
            ''
        );
    }

    public function test_toPrefName_no_exist_50() : void
    {
        $this->assertSame(
            $this->formatObj->toPrefName(50),
            ''
        );
    }

    public function test_toPrefName_null() : void
    {
        $this->assertSame(
            $this->formatObj->toPrefName(null),
            ''
        );
    }

    public function prefAdditionProvider()
    {
        return [
            [1, '北海道'],
            [2, '青森県'],
            [3, '岩手県'],
            [4, '宮城県'],
            [5, '秋田県'],
            [6, '山形県'],
            [7, '福島県'],
            [8, '茨城県'],
            [9, '栃木県'],
            [10, '群馬県'],
            [11, '埼玉県'],
            [12, '千葉県'],
            [13, '東京都'],
            [14, '神奈川県'],
            [15, '新潟県'],
            [16, '富山県'],
            [17, '石川県'],
            [18, '福井県'],
            [19, '山梨県'],
            [20, '長野県'],
            [21, '岐阜県'],
            [22, '静岡県'],
            [23, '愛知県'],
            [24, '三重県'],
            [25, '滋賀県'],
            [26, '京都府'],
            [27, '大阪府'],
            [28, '兵庫県'],
            [29, '奈良県'],
            [30, '和歌山県'],
            [31, '鳥取県'],
            [32, '島根県'],
            [33, '岡山県'],
            [34, '広島県'],
            [35, '山口県'],
            [36, '徳島県'],
            [37, '香川県'],
            [38, '愛媛県'],
            [39, '高知県'],
            [40, '福岡県'],
            [41, '佐賀県'],
            [42, '長崎県'],
            [43, '熊本県'],
            [44, '大分県'],
            [45, '宮崎県'],
            [46, '鹿児島県'],
            [47, '沖縄県'],
        ];
    }

    /**
     * @dataProvider placeAdditionProvider
     */
    public function test_separateStageAndPref($stageAndPref, $stage, $pref) : void
    {
        $actual = $this->formatObj->separateStageAndPref($stageAndPref);
        $expected = [$stage, $pref];
        $this->assertSame($expected, $actual);
    }

    public function test_separateStageAndPref_null() : void
    {
        $actual = $this->formatObj->separateStageAndPref(null);
        $expected = ['', ''];
        $this->assertSame($expected, $actual);
    }

    public function test_separateStageAndPref_空() : void
    {
        $actual = $this->formatObj->separateStageAndPref('');
        $expected = ['', ''];
        $this->assertSame($expected, $actual);
    }

    public function test_separateStageAndPref_括弧なし() : void
    {
        $actual = $this->formatObj->separateStageAndPref('東京ドーム');
        $expected = ['東京ドーム', ''];
        $this->assertSame($expected, $actual);
    }

    public function placeAdditionProvider()
    {
        return [
            ['山口きらら博記念公園(山口県)', '山口きらら博記念公園', '山口県'],
            ['海の中道海浜公園 野外劇場･子供の広場 （福岡県）', '海の中道海浜公園 野外劇場･子供の広場', '福岡県'],
            ['宮崎 SR BOX （宮崎県）', '宮崎 SR BOX', '宮崎県'],
        ];
    }
}
