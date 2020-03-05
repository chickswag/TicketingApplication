<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $arrayInterests =['Sports',
            'Gaming',
            'Swimming',
            'Animals',
            'Hiking',
            'Books',
            'Fishing',
            'Gardening',
            'Clubbing',
            'Bird Watching',
            'Binge',
            'Children',
            'Public Speaking',
            'Walking',
            'Gambling'];

            for ($i=0; $i < count($arrayInterests); $i++) {
                DB::table('interests')->insert([
                    'name' => $arrayInterests[$i],
                ]);
            }
    }
}
