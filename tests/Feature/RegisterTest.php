<?php

namespace Tests\Feature;

use App\Model\Role;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RegisterTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */

    public function testUserCanRegister(){
        factory(Role::class,3)->create();

        $rolesIds = Role::select('id')->get()->toArray();
        $indexToChoose = rand(0,count($rolesIds)-1);

        $user = factory(User::class)->make();
        $response = $this->post('register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'secret',
            'password_confirmation' => 'secret',
            'role' => $rolesIds[$indexToChoose]['id'],
        ]);
        $response->assertResponseStatus(302);
        $this->seeIsAuthenticated();
    }

    /**
     * A basic test example.
     *
     * @return void
     */

    public function testUserCanNotRegisterInvalidUser(){
        factory(Role::class,3)->create();

        $rolesIds = Role::select('id')->get()->toArray();
        $indexToChoose = rand(0,count($rolesIds)-1);

        $user = factory(User::class)->make();

        $response = $this->post('register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'secret',
            'password_confirmation' => 'invalid',
            'role' => $rolesIds[$indexToChoose],
        ]);
        $response->assertSessionHasErrors();
        $this->dontSeeIsAuthenticated();
    }

}
