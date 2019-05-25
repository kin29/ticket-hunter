<?php

declare(strict_types=1);

namespace Kin29\TicketHunter\Seller;

use Goutte\Client;
use Kin29\TicketHunter\Format;

abstract class AbstractTicketVendor
{
    use Format;

    public $client;
    public $requestUrl;

    public function __construct(string $keyWord = '', string $url = '')
    {
        $this->client = new Client();
        $this->requestUrl = $url . urlencode($keyWord);
    }

    abstract public function getList() : array;
}
