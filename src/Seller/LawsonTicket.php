<?php

declare(strict_types=1);

namespace Kin29\TicketHunter\Seller;

use Goutte\Client;

class LawsonTicket extends AbstractTicketVendor
{
    public function __construct()
    {
        $url = 'https://l-tike.com/search/?keyword=';
        parent::__construct(new Client, $url);
    }

    public function getList() : array
    {
        return $this->client->request('GET', $this->requestUrl)->filter('.boxContents')->each(function ($element) {
            $info = $element->filter('tr.prfItem')->filter('td');
            $aTag = $info->eq(4)->filter('a');
            $link = 'https://l-tike.com/order/?gLcode=' . urlencode($aTag->attr('data-lcode')) . '&gPfKey=' . urlencode($aTag->attr('data-pfkeys'));
            $link .= '&gEntryMthd=' . urlencode($aTag->attr('data-rcptypename')) . '&gScheduleNo=' . urlencode($aTag->attr('data-schduleno'));
            $link .= '&gPfName=' . urlencode($aTag->attr('data-prfname')) . '&gBaseVenueCd=' . urlencode($aTag->attr('data-basevenuecd'));

            list($stage, $pref) = $this->separateStageAndPref($info->eq(1)->text());

            return $this->format(
                $element->filter('.mainTitle')->text(),
                $info->eq(0)->text(),
                $pref,
                $stage,
                $info->eq(2)->filter('#reception_typename')->text(),
                $info->eq(3)->filter('.orderStates .textSStat')->text(),
                $link
            );
        });
    }
}
