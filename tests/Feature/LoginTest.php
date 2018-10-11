<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class LoginTest extends TestCase
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

    public function testUserCanLogin(){
        $user = factory(User::class)->create([
            'email' => 'oluwaseyi@example.com',
            'password' => bcrypt('testpass123')
        ]);

        $this->visit(route('login'))
            ->type($user->email, 'email')
            ->type('testpass123', 'password')
            ->press('Login')
            ->see($user->name)
            ->seePageIs('/home');
    }

    /**
     * A basic test example.
     *
     * @return void
     */

    public function testUserCanNotLoginWithoutPassword(){
        $user = factory(User::class)->create([
            'email' => 'oluwaseyi@example.com',
            'password' => bcrypt('testpass123')
        ]);

        $this->visit(route('login'))
            ->type($user->email, 'email')
            ->press('Login')
            ->see(trans('validation.required', ['attribute' => 'password']));
    }

    /**
     * A basic test example.
     *
     * @return void
     */

    public function testUserCanNotLoginWithoutEmail(){
        $user = factory(User::class)->create([
            'email' => 'oluwaseyi@example.com',
            'password' => bcrypt('testpass123')
        ]);

        $this->visit(route('login'))
            ->type($user->password, 'password')
            ->press('Login')
            ->see(trans('validation.required', ['attribute' => 'email']));
    }

    /**
     * A basic test example.
     *
     * @return void
     */

    public function testUserCanNotLoginWithWrongCredentials(){
        $user = factory(User::class)->create([
            'email' => 'oluwaseyi@example.com',
            'password' => bcrypt('testpass123')
        ]);

        $this->visit(route('login'))
            ->type($user->email, 'email')
            ->type('wrongtestpass123', 'password')
            ->press('Login')
            ->see('These credentials do not match our records.')
            ->seePageIs('/login');
    }

}
