<?php

declare(strict_types=1);

namespace Kin29\TicketHunter\Fake\Client;

class TicketPia
{
    private $nodes = [];
    private $selector = '';

    public function __construct()
    {
        $this->nodes = [
            [
                'title' => 'japan tour',
                'date_time' => '2019/1/1(火)',
                'pref_id' => '13',
                'pref_name' => '東京都',
                'stage' => '日本武道館',
                'sale_method' => '先着',
                'sale_status' => '予定枚数終了',
                'link' => 'https://kin29.info/',
            ],
        ];
    }

    public function request() : TicketPia
    {
        return $this;
    }

    public function filter($selector) : TicketPia
    {
        $this->selector = $selector;
        return $this;
    }

    private function createSubCrawler($nodes) : TicketPia
    {
        unset($nodes); //不要
        return $this;
    }

    public function each(\Closure $closure) : array
    {
        $data = [];
        foreach ($this->nodes as $i => $node) {
            $data[] = $closure($this->createSubCrawler($node), $i);
        }

        return $data;
    }

    public function text() : string
    {
        $node = $this->nodes[0];
        switch ($this->selector) {
            case '.list_01':
                return $node['title'];
                break;

            case '.list_02 .img_status':
                return $node['sale_method'];
                break;

            case '.list_02 .img_status + td':
                return $node['sale_status'];
                break;

            case '.list_03':
                return $node['date_time'];
                break;

            case '.list_04':
                return "{$node['stage']}({$node['pref_name']})";
                break;

            default:
                return '';
                break;
        }
    }

    public function attr($attribute) : string
    {
        unset($attribute); //不要
        $node = $this->nodes[0];
        switch ($this->selector) {
            case 'div .list_img a':
                return $node['link'];
                break;
            
            default:
                return '';
                break;
        }
    }
}
