<?php

use App\Model\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\Role::insert([
            'name' => 'user',
            'description' => 'User Privileges'
        ]);

        \App\Model\Role::insert([
            'name' => 'manager',
            'description' => 'Manager Privileges'
        ]);

        \App\Model\Role::insert([
            'name' => 'admin',
            'description' => 'Admin Privileges'
        ]);
    }
}
