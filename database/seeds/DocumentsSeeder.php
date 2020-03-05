<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DocumentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i=0; $i < 38; $i++) {
            DB::table('documents')->insert([
                'name' => str_random(15),
                'link' => '/documents/'.str_random(10).'.jpg'
            ]);
        }
    }
}
