<?php

use App\Models\Tip;
use App\Models\User;

it('shows the users reviews and beauty tips on the account page', function () {
    $this->actingAs(User::factory()->create())
        ->get('/account')
        ->assertSuccessful()
        ->assertSee('My reviews')
        ->assertSee('Soft Glow Foundation')
        ->assertSee('Beauty tips')
        ->assertSee('Keep your base fresh')
        ->assertDontSee('My shared tips')
        ->assertSee('Saved tips')
        ->assertSee('A simple evening routine');
});

it('lets an authenticated user add a beauty tip', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post('/account/tips', [
            'title' => 'Hydrate before makeup',
            'content' => 'Apply moisturizer first and let it absorb before starting your makeup.',
        ])
        ->assertRedirect(route('account'));

    $this->actingAs($user)
        ->get('/account')
        ->assertSee('Hydrate before makeup')
        ->assertSee('3 shared');

    expect(Tip::where('user_id', $user->id)
        ->where('title', 'Hydrate before makeup')
        ->exists())->toBeTrue();
});

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
