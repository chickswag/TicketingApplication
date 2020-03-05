<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonalDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        $arrayInterests =[ 1=>'Sports',
                                2=>'Gaming',
                                3=>'Swimming',
                                4=>'Animals',
                                5=>'Hiking',
                                6=>'Books',
                                7=>'Fishing',
                                8=>'Gardening',
                                9=>'Clubbing',
                                10=>'Bird Watching',
                                11=>'Binge',
                                12=>'Public Speaking'
                ];

        for ($i=0; $i < 49; $i++) {

            $number = rand(3,20);
            DB::table('personal_details')->insert([
                'name' => ucwords(str_random($number)),
                'surname' => ucwords(str_random($number)),
                'interests_id' =>json_encode([$arrayInterests[rand(1,12)],$arrayInterests[rand(1,12)],$arrayInterests[rand(1,12)]]),
                'documents_id' =>json_encode(rand(1,12))
                ]
            );

        }

    }
}
