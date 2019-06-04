<?php

declare(strict_types=1);

namespace Kin29\TicketHunter;

trait Format
{
    private $arrPref = [
        1 => '北海道',
        2 => '青森県',
        3 => '岩手県',
        4 => '宮城県',
        5 => '秋田県',
        6 => '山形県',
        7 => '福島県',
        8 => '茨城県',
        9 => '栃木県',
        10 => '群馬県',
        11 => '埼玉県',
        12 => '千葉県',
        13 => '東京都',
        14 => '神奈川県',
        15 => '新潟県',
        16 => '富山県',
        17 => '石川県',
        18 => '福井県',
        19 => '山梨県',
        20 => '長野県',
        21 => '岐阜県',
        22 => '静岡県',
        23 => '愛知県',
        24 => '三重県',
        25 => '滋賀県',
        26 => '京都府',
        27 => '大阪府',
        28 => '兵庫県',
        29 => '奈良県',
        30 => '和歌山県',
        31 => '鳥取県',
        32 => '島根県',
        33 => '岡山県',
        34 => '広島県',
        35 => '山口県',
        36 => '徳島県',
        37 => '香川県',
        38 => '愛媛県',
        39 => '高知県',
        40 => '福岡県',
        41 => '佐賀県',
        42 => '長崎県',
        43 => '熊本県',
        44 => '大分県',
        45 => '宮崎県',
        46 => '鹿児島県',
        47 => '沖縄県',
    ];

    /**
     * @return false|string
     */
    public function toJson(array $arrList)
    {
        return json_encode($arrList);
    }

    public function echoJson(array $arrList) : void
    {
        echo $this->toJson($arrList);
    }

    public function format(
        string $title = null,
        string $dateTime = null,
        string $prefName = null,
        string $stage = null,
        string $saleMethod = null,
        string $saleStatus = null,
        string $link = null
    ) : array {
        return [
            'title' => (string) $title,
            'date_time' => (string) $dateTime,
            'pref_id' => (string) $this->toPrefId($prefName),
            'pref_name' => (string) $prefName,
            'stage' => (string) $stage,
            'sale_method' => (string) $saleMethod,
            'sale_status' => (string) $saleStatus,
            'link' => (string) $link,
        ];
    }

    /**
     * @return null|int
     */
    public function toPrefId(string $prefName = null)
    {
        $ret = array_search($prefName, $this->arrPref, true);

        return (!$ret) ? null : (int) $ret;
    }

    public function toPrefName(int $prefId = null) : string
    {
        if ($prefId == null) {
            return '';
        }

        return (array_key_exists($prefId, $this->arrPref)) ? $this->arrPref[$prefId] : '';
    }

    public function separateStageAndPref(string $place = null) : array //todo $place = nullのときは？
    {
        if ($place == null) {
            return ['', ''];
        }
        $arrTmp = preg_split('/(\(|\（)/u', $place);

        $arrRet = [];
        $arrRet[] = (isset($arrTmp[0])) ? trim($arrTmp[0]) : '';
        $arrRet[] = (isset($arrTmp[1])) ? preg_replace('/(\)|\）)/u', '', $arrTmp[1]) : '';

        return $arrRet;
    }
}
