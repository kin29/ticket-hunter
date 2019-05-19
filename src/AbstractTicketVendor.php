<?php

declare(strict_types=1);

namespace Kin29\TicketHunter;

use Goutte\Client;

abstract class AbstractTicketVendor
{
    public $client;
    public $requestUrl;

    public function __construct(string $keyWord = '', string $url = '')
    {
        $this->client = new Client();
        $this->requestUrl = $url . urlencode($keyWord);
    }

    abstract public function getList() : array;

    public function format(string $title, string $dateTime, string $place, string $saleMethod, string $saleStatus, string $link) : array
    {
        return [
            'title' => $title,
            'date_time' => $dateTime,
            'place' => $place,
            'sale_method' => $saleMethod,
            'sale_status' => $saleStatus,
            'link' => $link,
        ];
    }
}
