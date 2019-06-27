<?php

declare(strict_types=1);

namespace Kin29\TicketHunter\Seller;

use Goutte\Client;
use Kin29\TicketHunter\Format;

abstract class AbstractTicketVendor
{
    use Format;

    /** @var $client Goutte\Client */
    public $client;

    /** @var $requestUrl string */
    public $requestUrl;

    public function __construct(Client $client, string $url = '')
    {
        $this->client = $client;
        $this->requestUrl = $url;
    }

    public function setKeyword(string $keyWord = '') : self
    {
        $this->requestUrl .= urlencode($keyWord);

        return $this;
    }

    abstract public function getList() : array;
}
