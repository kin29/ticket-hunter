<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Api\LawsonTicket;
use App\Api\TicketPia;
use App\Api\Eplus;

$l = new LawsonTicket('雨のパレード');
echo(json_encode($l->getList()));