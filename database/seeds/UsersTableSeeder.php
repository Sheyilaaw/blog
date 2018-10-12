<?php

use App\Model\Role;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolesIds = Role::select('id')->get()->toArray();
        $indexToChoose = rand(0,count($rolesIds)-1);

        factory(App\User::class, 10)->create([
            'password' => bcrypt('testpass123'),
            'role' => $rolesIds[$indexToChoose]['id'],
        ]);
    }
}
