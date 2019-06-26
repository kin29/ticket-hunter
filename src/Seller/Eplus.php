<?php

declare(strict_types=1);

namespace Kin29\TicketHunter\Seller;

class Eplus extends AbstractTicketVendor
{
    public function __construct(string $keyWord)
    {
        $url = 'https://eplus.jp/sf/search?keyword=';
        parent::__construct($keyWord, $url);
    }

    public function getList() : array
    {
        $json = trim(
            $this->client->request('GET', $this->requestUrl)->filter('#json')->text()
        );
        $arrData = json_decode(
            mb_convert_encoding($json, 'UTF-8', 'HTML-ENTITIES'), //数値文字参照 -> 日本語
            true
        );

        $arrRet = [];
        foreach ($arrData['data']['record_list'] as $arrDataTmp) {
            $koenList = $arrDataTmp['kanren_uketsuke_koen_list'][0];
            $saleStatus = $this->convertStatus(
                $koenList['uketsuke_status'],
                $koenList['eplus_toriatsukai_ari_flag'],
                $koenList['kyuen_flag']
            );

            $arrRet[] = $this->format(
                $arrDataTmp['kanren_kogyo_sub']['kogyo_name_1'],
                $this->convertDate($arrDataTmp['koenbi_term']),
                $arrDataTmp['kanren_venue']['todofuken_name'],
                "{$arrDataTmp['kanren_venue']['venue_name']}",
                $koenList['hambai_hoho_label'],
                $saleStatus,
                "https://eplus.jp/{$arrDataTmp['koen_detail_url_pc']}"
            );
        }

        return $arrRet;
    }

    private static function convertDate(string $timestamp) : string
    {
        $dateTime = '';
        $weekName = ['日', '月', '火', '水', '木', '金', '土'];
        $date = strtotime($timestamp);
        if ($date) {
            $dateStr = date('Y/n/j', $date);
            $w = (int) date('w', $date);
            $dateTime = "{$dateStr}({$weekName[$w]})";
        }

        return $dateTime;
    }

    private static function convertStatus(string $uketsukeStatus, bool $eplusToriatsukaiAriFlag, bool $kyuenFlag) : string
    {
        /**
         * $kyuenFlag               休演フラグ
         * $eplusToriatsukaiAriFlag 扱いフラグ
         * 1) $kyuenFlag=true(休演である) && $eplusToriatsukaiAriFlag=true(取り扱いあり);    => 「case 6[休演]」
         * 2) $kyuenFlag=true(休演である) && $eplusToriatsukaiAriFlag=false(取り扱いなし);   => 「case 6[休演]」
         * 3) $kyuenFlag=false(休演ではない) && $eplusToriatsukaiAriFlag=true(取り扱いなし); => 「case 5[扱いなし]」
         * 4) $kyuenFlag=false(休演ではない) && $eplusToriatsukaiAriFlag=true(取り扱いあり); => 「case X[X=$uketsukeStatusによる]」
         */

        // 1) or 2)
        if ($kyuenFlag) {
            return '休演';
        }

        // 3)
        if (!$eplusToriatsukaiAriFlag) {
            return '扱いなし';
        }

        // 4)
        if ('0' === $uketsukeStatus) {
            return '受付中';
        }
        if ('1' === $uketsukeStatus) {
            return '予定枚数終了';
        }
        if ('2' === $uketsukeStatus || '3' === $uketsukeStatus) {
            return '受付前';
        }
        if ('4' === $uketsukeStatus || '5' === $uketsukeStatus) {
            return '受付終了';
        }

        return '';
    }
}
