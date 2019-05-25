<?php

declare(strict_types=1);

namespace Kin29\TicketHunter;

trait Format
{
    public function toJson() : string
    {
        return json_encode($this->getList());
    }

    public function echoJson() : void
    {
        echo $this->toJson();
    }

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
