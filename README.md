# ticket-hunter

...ticket-info-api

It is api to get ticket info from several vender.  
If you use this, You Should be able to take tickets difficult to obtain.

## how to use

### 複数のチケット販売店を指定
※チケット販売店をキーに持つことができます  
```php
// TicketPia / Eplus / LawsonTicket に対応中
try {
  $ticketVendors = new TicketHunter(['TicketPia', 'Eplus', 'LawsonTicket'], 'teto');
  $ticketVendors->echoJson();
} catch (\Exception $e) {
    die($e->getMessage());
}
```

```
{
  "TicketPia": [
    {
      "title" : "[ツアー名 or フェス名]"
      "date_time": "[開演日]",
      "place": "[ハコの名前]([都道府県])",
      "sale_method": "[sale_method]",  //(例) 先行 / 一般発売  ...etc
      "sale_status": "[sale_status]",  //(例) 予定枚数終了 / 受付中 / 受付終了 ...etc
      "link": "[link]"
    },
  ],
  "Eplus": [
    {
      "title" : "[ツアー名 or フェス名]"
      "date_time": "[開演日]",
      "place": "[ハコの名前]([都道府県])",
      "sale_method": "[sale_method]",  //(例) 先行 / 一般発売  ...etc
      "sale_status": "[sale_status]",  //(例) 予定枚数終了 / 受付中 / 受付終了 ...etc
      "link": "[link]"
    },
  ],
  "LawsonTicket": [
    {
      "title" : "[ツアー名 or フェス名]"
      "date_time": "[開演日]",
      "place": "[ハコの名前]([都道府県])",
      "sale_method": "[sale_method]",  //(例) 先行 / 一般発売  ...etc
      "sale_status": "[sale_status]",  //(例) 予定枚数終了 / 受付中 / 受付終了 ...etc
      "link": "[link]"
    },
  ]
}
```
  
  
### 単一のチケット販売店を指定
```php
// TicketPiaの場合
$ticketPia = new TicketPia('teto');
$ticketPia->echoJson();
```

```
[
  {
    "title" : "[ツアー名 or フェス名]"
    "date_time": "[開演日]",
    "place": "[ハコの名前]([都道府県])",
    "sale_method": "[sale_method]",  //(例) 先行 / 一般発売  ...etc
    "sale_status": "[sale_status]",  //(例) 予定枚数終了 / 受付中 / 受付終了 ...etc
    "link": "[link]"
  },
  {
    "title" : "[ツアー名 or フェス名]"
    "date_time": "[開演日]",
    "place": "[ハコの名前]([都道府県])",
    "sale_method": "[sale_method]",  //(例) 先行 / 一般発売  ...etc
    "sale_status": "[sale_status]",  //(例) 予定枚数終了 / 受付中 / 受付終了 ...etc
    "link": "[link]"
  }
]
```
  
  