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
        ->assertDontSee('Keep your base fresh')
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
        ->assertSee('1 shared');

    expect(Tip::where('user_id', $user->id)
        ->where('title', 'Hydrate before makeup')
        ->exists())->toBeTrue();
});

it('lets the tip owner edit their beauty tip', function () {
    $user = User::factory()->create();
    $tip = Tip::create([
        'user_id' => $user->id,
        'title' => 'Old tip',
        'content' => 'Old content.',
    ]);

    $this->actingAs($user)
        ->put('/account/tips/'.$tip->id, [
            'title' => 'Updated tip',
            'content' => 'Updated content.',
        ])
        ->assertRedirect(route('account'));

    expect($tip->refresh()->title)->toBe('Updated tip')
        ->and($tip->content)->toBe('Updated content.');
});

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
