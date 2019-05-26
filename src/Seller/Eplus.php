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
            $w = date('w', $date);
            $dateTime = "{$dateStr}({$weekName[$w]})";
        }

        return $dateTime;
    }

    private static function convertStatus(string $uketsukeStatus, bool $eplusToriatsukaiAriFlag, bool $kyuenFlag) : string
    {
        $ret = 7;
        if (true === $kyuenFlag) {
            $ret = 6;
        } elseif (false === $eplusToriatsukaiAriFlag) {
            $ret = 5;
        } elseif (true === $eplusToriatsukaiAriFlag) {
            if ('0' === $uketsukeStatus) {
                $ret = 1;
            } elseif ('1' === $uketsukeStatus) {
                $ret = 2;
            } elseif ('2' === $uketsukeStatus || '3' === $uketsukeStatus) {
                $ret = 3;
            } elseif ('4' === $uketsukeStatus || '5' === $uketsukeStatus) {
                $ret = 4;
            }
        }

        $val = 7;
        if ($ret < $val) {
            $val = $ret;
        }

        switch ($val) {
            case 1:
                return '受付中';
            case 2:
                return '予定枚数終了';
            case 3:
                return '受付前';
            case 4:
                return '受付終了';
            case 5:
                return '扱いなし';
            case 6:
                return '休演';
            default:
                return '';
        }
    }
}
