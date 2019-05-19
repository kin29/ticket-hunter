# ticket-hunter

...ticket-info-api

It is api to get ticket info from several vender.  
If you use this, You Should be able to take tickets difficult to obtain.

## how to use
```php
$t = new TicketPia('teto');
$t->echoJson();
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
