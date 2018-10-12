<?php

namespace Tests\Feature;

use App\Model\Post;
use App\Model\Role;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class CreatePostTest extends TestCase
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

    public function testUserCanCreatePost(){
        $user = factory(User::class)->create([
            'email' => 'oluwaseyi@example.com',
            'password' => bcrypt('testpass123')
        ]);

        $this->actingAs($user)
            ->visit(route('post.create'))
            ->type('Title Examplee', 'title')
            ->type('Test Body goes here', 'body')
            ->press('Post')
            ->see('Post Added Successfully')
            ->seePageIs('/home');
    }

    /**
     * A basic test example.
     *
     * @return void
     */

    public function testUserCanNotCreatePostWithoutTitle(){
        $user = factory(User::class)->create([
            'email' => 'oluwaseyi@example.com',
            'password' => bcrypt('testpass123')
        ]);

        $this->actingAs($user)
            ->visit(route('post.create'))
            ->type('Test Body goes here', 'body')
            ->press('Post')
            ->see(trans('validation.required', ['attribute' => 'title']));
    }

    /**
     * A basic test example.
     *
     * @return void
     */

    public function testUserCanNotCreatePostWithoutBody(){
        $user = factory(User::class)->create([
            'email' => 'oluwaseyi@example.com',
            'password' => bcrypt('testpass123')
        ]);

        $this->actingAs($user)
            ->visit(route('post.create'))
            ->type('Test Title', 'title')
            ->press('Post')
            ->see(trans('validation.required', ['attribute' => 'body']));
    }

    /**
     * A basic test example.
     *
     * @return void
     */

    public function testUserCanNotEditPost(){
        $role = factory(Role::class)->create([
            'name' => 'user'
        ]);

        $user = factory(User::class)->create([
            'email' => 'oluwaseyi@example.com',
            'password' => bcrypt('testpass123'),
            'role' => $role->id
        ]);

        $post = factory(Post::class)->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($user)
            ->visit("/post/{$post->id}/edit")
            ->seePageIs('/home');

    }

    /**
     * A basic test example.
     *
     * @return void
     */

    public function testManagerCanCreatePost(){
        $role = factory(Role::class)->create([
            'name' => 'manager'
        ]);

        $user = factory(User::class)->create([
            'email' => 'oluwaseyi@example.com',
            'password' => bcrypt('testpass123'),
            'role' => $role->id
        ]);

        $this->actingAs($user)
            ->visit(route('post.create'))
            ->type('Title Examplee', 'title')
            ->type('Test Body goes here', 'body')
            ->press('Post')
            ->see('Post Added Successfully')
            ->seePageIs('/home');
    }

    /**
     * A basic test example.
     *
     * @return void
     */

    public function testAdminCanCreatePost(){
        $role = factory(Role::class)->create([
            'name' => 'admin'
        ]);

        $user = factory(User::class)->create([
            'email' => 'oluwaseyi@example.com',
            'password' => bcrypt('testpass123'),
            'role' => $role->id
        ]);

        $this->actingAs($user)
            ->visit(route('post.create'))
            ->type('Title Examplee', 'title')
            ->type('Test Body goes here', 'body')
            ->press('Post')
            ->see('Post Added Successfully')
            ->seePageIs('/home');
    }

}
