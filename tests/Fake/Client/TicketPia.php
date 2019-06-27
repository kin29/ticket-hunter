<?php

declare(strict_types=1);

namespace Kin29\TicketHunter\Fake\Client;

class TicketPia
{
    public $filterStr = '';

    public function request() : TicketPia
    {
        return $this;
    }

    public function filter(string $str = '') : TicketPia
    {
        $this->filterStr = $str;
        return $this;
    }

    public function each() : array
    {
        return [$this, $this];
    }

    public function text() : string
    {
        switch ($this->filterStr) {
            case '.list_01':
                return 'japan tour';
                break;

            case '.list_02 .img_status':
                return '先着';
                break;

            case '.list_02 .img_status + td':
                return '予定枚数終了';
                break;

            case '.list_03':
                return '2019/1/1(火)';
                break;

            case '.list_04':
                return '日本武道館(東京都)';
                break;
            
            default:
                return '';
                break;
        }
    }

    public function attr() : string
    {
        switch ($this->filterStr) {
            case 'div .list_img a':
                return 'https://kin29.info/';
                break;
            
            default:
                return '';
                break;
        }
    }
}
