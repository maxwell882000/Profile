<?php

namespace Database\Seeders;

use App\Domain\User\Entities\PlasticCard;
use Illuminate\Database\Seeder;

class Card extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlasticCard::create(
            [
                'card_number' => "8600123445678789",
                "expiry" => "23/23",
                "phone" => "+998911669982",
                "card_token" => "sadsad",
                "pan" => "8600******78789"
            ]
        );
    }
}
