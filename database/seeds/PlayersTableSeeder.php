<?php

use Illuminate\Database\Seeder;
use App\Player;

class PlayersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        {
            Eloquent::unguard();

            $faker = Faker\Factory::create();

            $positions = ['Defender', 'Midfielder', 'Forward', 'Keeper', 'Right Wing',
                          'Left Wing', 'Attacking Midfield', 'Centre-Back',
                          'Defensive Midfield', 'Central Midfield', 'Centre-Forward'];

            $countries = ['Germany',
                'Brazil',
                'Portugal',
                'Argentina',
                'Belgium',
                'Poland',
                'France',
                'Spain',
                'Chile',
                'Peru',
                'Switzerland',
                'England',
                'Colombia',
                'Wales',
                'Italy',
                'Mexico',
                'Uruguay',
                'Croatia',
                'Denmark',
                'Netherlands'];

            foreach (range(1,20) as $index)
            {

                Player::create([
                    'first_name' => $faker->firstNameMale,
                    'last_name' => $faker->lastName,
                    'DOB' => $faker->dateTimeBetween($startDate = '-40 years', $endDate = '-15 years', $timezone = null),
                    'nationality' => $countries[array_rand($countries)],
                    'position' => $positions[array_rand($positions)],
                    'market_value' => $faker->numberBetween($min = 1000, $max = 225000000) // 8567,
                ]);

            }

        }

    }
}









