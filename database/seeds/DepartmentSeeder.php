<?php

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $department= new App\Department();
        $department->name = 'IT';
        $department->save();

        $department= new App\Department();
        $department->name= 'Sales';
        $department->save();

        $department= new App\Department();
        $department->name = 'Accounts';
        $department->save();
    }
}
