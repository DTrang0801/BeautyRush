<?php

use App\Models\Tip;
use App\Models\User;

it('shows the tips and tricks page', function () {
    $response = $this->get('/tips');

    $response->assertSuccessful()
        ->assertSee('Tips & Tricks')
        ->assertSee('Keep your base fresh')
        ->assertSee('Beauty Rush community');
});

it('shows shared database tips on the tips page', function () {
    $user = User::factory()->create();
    Tip::create([
        'user_id' => $user->id,
        'title' => 'Test community tip',
        'content' => 'A useful tip for the community.',
    ]);

    $this->get('/tips')
        ->assertSee('Test community tip')
        ->assertSee('A useful tip for the community.')
        ->assertSee($user->name);
});

it('shows the add tip form to authenticated users', function () {
    $this->actingAs(User::factory()->create())
        ->get('/tips')
        ->assertSee('Add a tip or trick')
        ->assertSee('Share your beauty tip...');
});

it('hides the authenticated users own tips from the community page', function () {
    $user = User::factory()->create();
    Tip::create([
        'user_id' => $user->id,
        'title' => 'My private community test tip',
        'content' => 'This should only appear on my account.',
    ]);

    $this->actingAs($user)
        ->get('/tips')
        ->assertDontSee('My private community test tip');
});

it('asks guests to log in before saving a tip', function () {
    $this->post(route('tips.favorite'), ['tip_key' => 'featured-keep-your-base-fresh'])
        ->assertRedirect(route('login'))
        ->assertSessionHas('status', 'Please log in to save a tip.');
});

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
