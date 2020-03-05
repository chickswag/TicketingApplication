<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role_user = new Role();
        $role_user->name = 'root';
        $role_user->guard_name = 'web';
        $role_user->save();

        $role_user= new Role();
        $role_user->name = 'manager';
        $role_user->guard_name = 'web';
        $role_user->save();

        $role_support = new Role();
        $role_support->name = 'technician';
        $role_support->guard_name = 'web';
        $role_support->save();

        $role_agent = new Role();
        $role_agent->name = 'agent';
        $role_agent->guard_name = 'web';
        $role_agent->save();
    }
}
