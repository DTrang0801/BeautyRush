<?php

use App\Models\Review;
use App\Models\Tip;
use App\Models\User;

it('shows the users reviews and beauty tips on the account page', function () {
    $user = User::factory()->create();
    Review::create([
        'user_id' => $user->id,
        'product_name' => 'Soft Glow Foundation',
        'rating' => 4.9,
        'content' => 'Feels weightless and still looks fresh at the end of the day.',
    ]);

    $this->actingAs($user)
        ->get('/account')
        ->assertSuccessful()
        ->assertSee('My reviews')
        ->assertSee('Soft Glow Foundation')
        ->assertSee('Your beauty tips')
        ->assertDontSee('Keep your base fresh')
        ->assertDontSee('My shared tips')
        ->assertSee('Saved tips')
        ->assertSee('A simple evening routine');
});

it('lets the review owner delete their review', function () {
    $user = User::factory()->create();
    $review = Review::create([
        'user_id' => $user->id,
        'product_name' => 'Petal Pop Blush',
        'rating' => 4.8,
        'content' => 'The perfect pink for a quick, polished look.',
    ]);

    $this->actingAs($user)
        ->delete('/account/reviews/'.$review->id)
        ->assertRedirect(route('account'));

    expect(Review::find($review->id))->toBeNull();
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

it('lets the tip owner delete their beauty tip', function () {
    $user = User::factory()->create();
    $tip = Tip::create([
        'user_id' => $user->id,
        'title' => 'Tip to remove',
        'content' => 'This tip should be deleted.',
    ]);

    $this->actingAs($user)
        ->delete('/account/tips/'.$tip->id)
        ->assertRedirect(route('account'));

    expect(Tip::find($tip->id))->toBeNull();
});

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
