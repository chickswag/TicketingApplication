<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status= new \App\Status();
        $status->name = 'newly logged';
        $status->color = '#d9534f';
        $status->save();

        $status= new  \App\Status();
        $status->name = 'in progress';
        $status->color = '#5bc0de';
        $status->save();

        $status= new  \App\Status();
        $status->name = 'resolved';
        $status->color = '#5cb85c';
        $status->save();

        $status= new  \App\Status();
        $status->name = 'closed';
        $status->color = '#428bca';
        $status->save();
    }
}
