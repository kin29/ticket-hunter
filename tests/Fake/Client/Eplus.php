<?php

declare(strict_types=1);

namespace Kin29\TicketHunter\Fake\Client;

class Eplus
{
    public function request() : Eplus
    {
        return $this;
    }

    public function filter() : Eplus
    {
        return $this;
    }

    /**
     * @return string|false
     */
    public function text()
    {
        $retArr = [
            'data' => [
                'record_list' => [
                    [
                        'kanren_uketsuke_koen_list' => [
                            [
                                'uketsuke_status' => '1',
                                'eplus_toriatsukai_ari_flag' => true,
                                'kyuen_flag' => false,
                                'hambai_hoho_label' => '先着'
                            ]
                        ],
                        'kanren_kogyo_sub' => [
                            'kogyo_name_1' => 'japan tour'
                        ],
                        'koenbi_term' => '20190101',
                        'kanren_venue' => [
                            'todofuken_name' => '東京都',
                            'venue_name' => '日本武道館',
                        ],
                        'koen_detail_url_pc' => 'url_pc_test',
                    ],
                    [//休演
                        'kanren_uketsuke_koen_list' => [
                            [
                                'uketsuke_status' => '2',
                                'eplus_toriatsukai_ari_flag' => true,
                                'kyuen_flag' => true,
                                'hambai_hoho_label' => '一般'
                            ]
                        ],
                        'kanren_kogyo_sub' => [
                            'kogyo_name_1' => 'japan tour2'
                        ],
                        'koenbi_term' => '20190102',
                        'kanren_venue' => [
                            'todofuken_name' => '千葉県',
                            'venue_name' => '幕張メッセ',
                        ],
                        'koen_detail_url_pc' => 'url_pc_test2',
                    ],
                    [//取り扱いなし
                        'kanren_uketsuke_koen_list' => [
                            [
                                'uketsuke_status' => '3',
                                'eplus_toriatsukai_ari_flag' => false,
                                'kyuen_flag' => false,
                                'hambai_hoho_label' => '一般'
                            ]
                        ],
                        'kanren_kogyo_sub' => [
                            'kogyo_name_1' => 'japan tour3'
                        ],
                        'koenbi_term' => '20190103',
                        'kanren_venue' => [
                            'todofuken_name' => '福岡県',
                            'venue_name' => 'マリンメッセ福岡',
                        ],
                        'koen_detail_url_pc' => 'url_pc_test3',
                    ]
                ]
            ]
        ];

        return json_encode($retArr);
    }
}
