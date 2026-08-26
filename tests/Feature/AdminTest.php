<?php

use App\Models\User;

it('allows admins to access admin pages', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    $this->actingAs($admin)
        ->get('/admin/categories')
        ->assertSuccessful();
});

it('blocks regular users from admin pages', function () {
    $this->actingAs(User::factory()->create())
        ->get('/admin/categories')
        ->assertForbidden();
});

it('allows admins to create users and change admin rights', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    $this->actingAs($admin)
        ->post('/admin/users', [
            'name' => 'Managed User',
            'username' => 'manageduser',
            'email' => 'managed@example.com',
            'password' => 'Password!321',
            'password_confirmation' => 'Password!321',
        ])
        ->assertRedirect(route('admin.users.index'));

    $managedUser = User::where('email', 'managed@example.com')->firstOrFail();

    $this->actingAs($admin)
        ->put('/admin/users/'.$managedUser->id, ['is_admin' => true])
        ->assertRedirect(route('admin.users.index'));

    expect($managedUser->refresh()->is_admin)->toBeTrue();
});

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
