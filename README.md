# ticket-hunter 
[![Build Status](https://travis-ci.org/kin29/ticket-hunter.svg?branch=master)](https://travis-ci.org/kin29/ticket-hunter)

You can search ticket info with artist-name(or keyword) from several vender.  
If you use this, You Should be able to take tickets difficult to obtain.
  
You can choose.
- TicketPia
- Eplus
- LawsonTicket

## how to use
```bash
composer require kin29/ticket-hunter
```

### when you search multiple ticket-seller
※has key(=ticket-seller name)

- ticket-hunter/exmple.php
```php
<?php

require __DIR__ . '/vendor/autoload.php';

try {
  $ticketVendors = new Kin29\TicketHunter\TicketHunter(['TicketPia', 'Eplus']);
  $ticketVendors->echoJson($ticketVendors->getList('雨のパレード'));
} catch (\Exception $e) {
    die($e->getMessage());
}
```

```bash
php ticket-hunter/example.php | jq
```

```
{
  "TicketPia": [
    {
      "title" : "[ツアー名 or フェス名]",
      "date_time": "[開演日]",
      "pref_id": "[都道府県ID]",
      "pref_name": "[都道府県名]",
      "stage": "[ハコの名前]",
      "sale_method": "[sale_method]",  //(例) 先行 / 一般発売  ...etc
      "sale_status": "[sale_status]",  //(例) 予定枚数終了 / 受付中 / 受付終了 ...etc
      "link": "[link]"
    },
  ],
  "Eplus": [
    {
      "title" : "[ツアー名 or フェス名]",
      "date_time": "[開演日]",
      "pref_id": "[都道府県ID]",
      "pref_name": "[都道府県名]",
      "stage": "[ハコの名前]",
      "sale_method": "[sale_method]",  //(例) 先行 / 一般発売  ...etc
      "sale_status": "[sale_status]",  //(例) 予定枚数終了 / 受付中 / 受付終了 ...etc
      "link": "[link]"
    },
  ],
  "LawsonTicket": [
    {
      "title" : "[ツアー名 or フェス名]",
      "date_time": "[開演日]",
      "pref_id": "[都道府県ID]",
      "pref_name": "[都道府県名]",
      "stage": "[ハコの名前]",
      "sale_method": "[sale_method]",  //(例) 先行 / 一般発売  ...etc
      "sale_status": "[sale_status]",  //(例) 予定枚数終了 / 受付中 / 受付終了 ...etc
      "link": "[link]"
    },
  ]
}
```
  
  
### when you search single ticket-seller
```php
// TicketPiaの場合
$ticketPia = new Kin29\TicketHunter\Seller\TicketPia();
$ticketPia->echoJson($ticketPia->setKeyword('[artist-name(or keyword)]')->getList());
```

```
[
  {
    "title" : "[ツアー名 or フェス名]",
    "date_time": "[開演日]",
    "pref_id": "[都道府県ID]",
    "pref_name": "[都道府県名]",
    "stage": "[ハコの名前]",
    "sale_method": "[sale_method]",  //(例) 先行 / 一般発売  ...etc
    "sale_status": "[sale_status]",  //(例) 予定枚数終了 / 受付中 / 受付終了 ...etc
    "link": "[link]"
  },
  {
    "title" : "[ツアー名 or フェス名]",
    "date_time": "[開演日]",
    "pref_id": "[都道府県ID]",
    "pref_name": "[都道府県名]",
    "stage": "[ハコの名前]",
    "sale_method": "[sale_method]",  //(例) 先行 / 一般発売  ...etc
    "sale_status": "[sale_status]",  //(例) 予定枚数終了 / 受付中 / 受付終了 ...etc
    "link": "[link]"
  }
]
```

## PHPUnti Test Covarage
!!!Congratulations １００％!!!
![covarage_100per.png](https://user-images.githubusercontent.com/12015851/60320239-13fcac00-99b4-11e9-85dd-c4e7cb9c5067.png)
  
  