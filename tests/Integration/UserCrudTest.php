<?php

namespace the42coders\TLAP\Tests\Integration;

use the42coders\TLAP\Tests\models\User;

class UserCrudTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config(['tlap.models.users' => User::class]);
    }

    public function testItCanListUsers()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'user@test.com',
            'password' => 'secret'
        ]);

        $this->get(route('tlap.index', ['models' => $user->getModelPluralName()]))
            ->assertOk();

   }

    public function testItCanCreateUser()
    {
        $user = new User();

        $userData = [
            'name' => 'Test User',
            'email' => 'user@test.com',
            'password' => 'pass'
        ];

        $this->post(route('tlap.store', ['models' => $user->getModelPluralName()]), $userData)
            ->assertRedirect();

        unset($userData['password']);
        $this->assertDatabaseHas('users', $userData);
    }

    public function testItCanShowUser()
    {
        /** @var User $user */
        $user = User::create([
            'name' => 'Test User',
            'email' => 'user@test.com',
            'password' => 'secret'
        ]);

        $this->get(route('tlap.show', ['models' => $user->getModelPluralName(), 'id' => $user->id]))
            ->assertOk()
            ->assertSee($user->name);
    }

    public function testItCanShowUserCreateForm()
    {
        $user = new User();

        $this->get(route('tlap.create', ['models' => $user->getModelPluralName()]))
            ->assertOk()
            ->assertSee('name');
    }

    public function testItCanShowUserEditForm()
    {
        /** @var User $user */
        $user = User::create([
            'name' => 'Test User',
            'email' => 'user@test.com',
            'password' => 'secret'
        ]);

         $this->get(route('tlap.edit', ['models' => $user->getModelPluralName(), 'id' => $user->id]))
            ->assertOk()
            ->assertSee('name')
            ->assertSee($user->name);
    }

    public function testItCanUpdateUser()
    {
        /** @var User $user */
        $user = User::create([
            'name' => 'Test User',
            'email' => 'user@test.com',
            'password' => 'secret'
        ]);

        $userData = [
            'name' => 'Test User Updated',
            'email' => 'user@test.com',
            'password' => 'pass'
        ];

        $this->post(route('tlap.update', ['models' => $user->getModelPluralName(), 'id' => $user->id]), $userData)
            ->assertRedirect();

        unset($userData['password']);
        $this->assertDatabaseHas('users', $userData);
    }

    public function testItCanDeleteUser()
    {
        /** @var User $user */
        $user = User::create([
            'name' => 'Test User',
            'email' => 'user@test.com',
            'password' => 'secret'
        ]);

        $this->assertModelExists($user);

        $this->get(route('tlap.delete', ['models' => $user->getModelPluralName(), 'id' => $user->id]))
            ->assertRedirect();

        $this->assertModelMissing($user);
    }
}
