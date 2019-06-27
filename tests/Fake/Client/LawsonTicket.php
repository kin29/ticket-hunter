<?php

declare(strict_types=1);

namespace Kin29\TicketHunter\Fake\Client;

class LawsonTicket
{
    public function request() : LawsonTicket
    {
        return $this;
    }

    public function filter() : LawsonTicket
    {
        return $this;
    }

    public function each() : LawsonTicket
    {
        return $this;
    }

    public function text() : string
    {
        return '';
    }
}
