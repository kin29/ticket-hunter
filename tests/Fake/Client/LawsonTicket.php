<?php

declare(strict_types=1);

namespace Kin29\TicketHunter\Fake\Client;

class LawsonTicket
{
    private $nodes = [];
    private $position = '';
    private $selector = '';

    public function __construct()
    {
        $this->nodes = [
            [
                'title' => 'japan tour',
                'date_time' => '2019/1/1(火)',
                'pref_id' => '15',
                'pref_name' => '東京都',
                'stage' => '日本武道館',
                'sale_method' => '先着',
                'sale_status' => '予定枚数終了',
                'link' => 'https://l-tike.com/order/?gLcode=1111&gPfKey=2019010101010101&gEntryMthd=01&gScheduleNo=1&gPfName=japan%2Btour&gBaseVenueCd=22222',
            ],
        ];
    }

    public function request() : LawsonTicket
    {
        return $this;
    }

    public function filter($selector) : LawsonTicket
    {
        $this->selector = $selector;
        return $this;
    }


    public function eq($position) : LawsonTicket
    {
        $this->position = $position;
        return $this;
    }

    private function createSubCrawler($nodes) : LawsonTicket
    {
        unset($nodes);
        return $this;
    }

    public function each(\Closure $closure)
    {
        $data = [];
        foreach ($this->nodes as $i => $node) {
            $data[] = $closure($this->createSubCrawler($node), $i);
        }

        return $data;
    }

    public function text() :string
    {
        $node = $this->nodes[0];
        switch ($this->selector) {
            case '.mainTitle':
                if ($this->position == 1) {
                    return $node['title'];
                }
                if ($this->position == 0) {
                    return $node['date_time'];
                }
                return '';
                break;

            case 'a':
                if ($this->position == 1) {
                    return "{$node['stage']}({$node['pref_name']})";
                }
                return '';
                break;

            case '#reception_typename':
                return $node['sale_method'];
                break;

            case '.orderStates .textSStat':
                return $node['sale_status'];
                break;

            default:
                return '';
                break;
        }
    }

    public function attr($attribute)
    {
        switch ($attribute) {
            case 'data-lcode':
                return urlencode('1111');
                break;

            case 'data-pfkeys':
                return urlencode('2019010101010101');
                break;

            case 'data-rcptypename':
                return urlencode('01');
                break;

            case 'data-schduleno':
                return urlencode('1');
                break;

            case 'data-prfname':
                return urlencode('japan tour');
                break;

            case 'data-basevenuecd':
                return urlencode('22222');
                break;

            default:
                return '';
                break;
        }
    }
}
