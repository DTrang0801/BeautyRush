<?php

use App\Models\Category;
use App\Models\Faq;
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

it('allows admins to manage FAQ questions and answers', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $category = Category::factory()->create();

    $this->actingAs($admin)
        ->post('/admin/faqs', [
            'category_id' => $category->id,
            'question' => 'Can I save a product?',
            'answer' => 'Yes, click the heart on a product card.',
        ])
        ->assertRedirect(route('admin.faqs.index'));

    $faq = Faq::firstOrFail();

    $this->actingAs($admin)
        ->put('/admin/faqs/'.$faq->id, [
            'category_id' => $category->id,
            'question' => 'Can I save a product?',
            'answer' => 'Yes, click the heart to save it.',
        ])
        ->assertRedirect(route('admin.faqs.index'));

    expect($faq->refresh()->answer)->toBe('Yes, click the heart to save it.');

    $this->actingAs($admin)
        ->delete('/admin/faqs/'.$faq->id)
        ->assertRedirect(route('admin.faqs.index'));

    expect(Faq::find($faq->id))->toBeNull();
});

it('shows the FAQ management link only to admins', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    $this->actingAs($admin)
        ->get('/faq')
        ->assertSee('Manage FAQs');

    $this->actingAs(User::factory()->create())
        ->get('/faq')
        ->assertDontSee('Manage FAQs');
});

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
