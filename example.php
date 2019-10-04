<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

try {
    $ticketVendors = new Kin29\TicketHunter\TicketHunter(['Eplus']);
    $ticketVendors->echoJson($ticketVendors->getList('雨のパレード'));
} catch (\Exception $e) {
    die($e->getMessage());
}
