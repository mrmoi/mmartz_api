<?php
/**
 * Created by PhpStorm.
 * User: moimartz
 * Date: 1/10/18
 * Time: 6:23 PM
 */

namespace TestComp\Transformers;


class PlayerTransformer extends Transformer
{
    public function transform($player)
    {
        return [

            'player_id'         => $player['id'],
            'player_first_name' => $player['first_name'],
            'player_last_name'  => $player['last_name'],
            'date_of_birth'     => $player['DOB'],
            'country'           => $player['nationality'],
            'position'          => $player['position'],
            'value'             => $player['market_value'],
            'test_player'       => $player['is_test'],
            'origin_datetime'   => $player['created_at'],
            'last_modified'     => $player['updated_at'],
        ];
    }
}