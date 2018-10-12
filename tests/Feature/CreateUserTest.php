<?php

namespace Tests\Feature;

use App\Model\Role;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        Session::start();
    }

    /**
     * A basic test example.
     *
     * @return void
     */

    public function testAdminCanCreateUser(){

         $role = factory(Role::class)->create([
             'name' => 'admin'
         ]);

         $user = factory(User::class)->create([
            'email' => 'oluwaseyi@example.com',
            'password' => bcrypt('testpass123'),
            'role' => $role->id
         ]);

        $this->actingAs($user)
            ->post(route('user.store'), [
                'name' => 'create user',
                'email' => 'createuser@gmail.com',
                'role' => $user->role,
                'password' => '123123',
                'password_confirmation' => '123123'
            ])
            ->assertResponseStatus(302)
            ->assertEquals(User::count(),2);
    }

    /**
     * A basic test example.
     *
     * @return void
     */

    public function testUserCanNotAccessCreateUserRoute(){
        $role = factory(Role::class)->create([
            'name' => 'user'
        ]);

        $user = factory(User::class)->create([
            'email' => 'oluwaseyi@example.com',
            'password' => bcrypt('testpass123'),
            'role' => $role->id
        ]);

        $this->actingAs($user)
            ->visit(route('user.create'))
            ->seePageIs('/home');
    }

    /**
     * A basic test example.
     *
     * @return void
     */

    public function testManagerCanNotAccessCreateUserRoute(){
        $role = factory(Role::class)->create([
            'name' => 'manager'
        ]);

        $user = factory(User::class)->create([
            'email' => 'oluwaseyi@example.com',
            'password' => bcrypt('testpass123'),
            'role' => $role->id
        ]);

        $this->actingAs($user)
            ->visit(route('user.create'))
            ->seePageIs('/home');
    }

}
