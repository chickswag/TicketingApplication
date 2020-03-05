<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Role comes before role user here.
        $this->call(RoleTableSeeder::class);
        // Role user comes before User seeder here.
        $this->call(RoleUserTableSeeder::class);
        // User seeder will use the roles above created.
        $this->call(UserTableSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(PersonalDetailsSeeder::class);
        $this->call(InterestSeeder::class);
        $this->call(DocumentsSeeder::class);
    }
}

