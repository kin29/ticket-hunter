<?php

declare(strict_types=1);

namespace Kin29\TicketHunter\Seller;

use Goutte\Client;

class TicketPia extends AbstractTicketVendor
{
    public function __construct()
    {
        $url = 'https://t.pia.jp/pia/rlsInfo.do?kw=';
        parent::__construct(new Client, $url);
    }

    public function getList() : array
    {
        return $this->client->request('GET', $this->requestUrl)->filter('ul.listWrp > li.listWrp_title_list + li.clearfix')->each(function ($element) {
            list($stage, $pref) = $this->separateStageAndPref(trim($element->filter('.list_04')->text()));

            return $this->format(
                trim($element->filter('.list_01')->text()),
                trim($element->filter('.list_03')->text()),
                $pref,
                $stage,
                trim($element->filter('.list_02 .img_status')->text()),
                trim($element->filter('.list_02 .img_status + td')->text()),
                trim($element->filter('div .list_img a')->attr('href'))
            );
        });
    }
}
