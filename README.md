# ticket-hunter

You can search ticket info with artist-name(or keyword) from several vender.  
If you use this, You Should be able to take tickets difficult to obtain.
  
You can choose.
- TicketPia

- Eplus
- LawsonTicket

## how to use

### when you search multiple ticket-saller
※has key(=ticket-saller name)
```php
try {
  $ticketVendors = new TicketHunter(['TicketPia', 'Eplus', 'LawsonTicket'], '[artist-name(or keyword)]');
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
      "title" : "[ツアー名 or フェス名]"
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
      "title" : "[ツアー名 or フェス名]"
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
  
  
### when you search single ticket-saller
```php
// TicketPiaの場合
$ticketPia = new TicketPia('[artist-name(or keyword)]');
$ticketPia->echoJson();
```

```
[
  {
    "title" : "[ツアー名 or フェス名]"
    "date_time": "[開演日]",
    "pref_id": "[都道府県ID]",
    "pref_name": "[都道府県名]",
    "stage": "[ハコの名前]",
    "sale_method": "[sale_method]",  //(例) 先行 / 一般発売  ...etc
    "sale_status": "[sale_status]",  //(例) 予定枚数終了 / 受付中 / 受付終了 ...etc
    "link": "[link]"
  },
  {
    "title" : "[ツアー名 or フェス名]"
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
  
  