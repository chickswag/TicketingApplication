<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role_root              = Role::where('name', 'root')->first();
        $root                   = new User();
        $root->role_id          = 1;
        $root->surname          = 'root';
        $root->name             = 'root';
        $root->username         = 'root';
        $root->email            = 'nomsapn@gmail.com';
        $root->password         = bcrypt('Abc@12345');
        $root->save();
        $root->roles()->attach($role_root);

        //support technician
        $role_root              = Role::where('name', 'technician')->first();
        $root                   = new User();
        $root->role_id          = 3;
        $root->surname          = 'supportit';
        $root->name             = 'supportit';
        $root->username         = 'supportit';
        $root->department_id    = 1;
        $root->email            = 'nomsapn3@gmail.com';
        $root->password         = bcrypt('Abc@12345');
        $root->save();
        $root->roles()->attach($role_root);

        $role_root              = Role::where('name', 'technician')->first();
        $root                   = new User();
        $root->role_id          = 3;
        $root->surname          = 'supportsales';
        $root->name             = 'supportsales';
        $root->username         = 'supportsales';
        $root->department_id    = 2;
        $root->email            = 'nomsapn1@gmail.com';
        $root->password         = bcrypt('Abc@12345');
        $root->save();
        $root->roles()->attach($role_root);

        $role_root              = Role::where('name', 'technician')->first();
        $root                   = new User();
        $root->role_id          = 3;
        $root->surname          = 'supportaccounts';
        $root->name             = 'supportaccounts';
        $root->username         = 'supportaccounts';
        $root->department_id    = 3;
        $root->email            = 'nomsapn2@gmail.com';
        $root->password         = bcrypt('Abc@12345');
        $root->save();
        $root->roles()->attach($role_root);

        //agent
        $role_root              = Role::where('name', 'agent')->first();
        $root                   = new User();
        $root->role_id          = 4;
        $root->surname          = 'agent';
        $root->name             = 'agent';
        $root->username         = 'agent';
        $root->email            = 'nomsa-mnguni@outlook.com';
        $root->password         = bcrypt('Abc@12345');
        $root->save();
        $root->roles()->attach($role_root);


  }
}
