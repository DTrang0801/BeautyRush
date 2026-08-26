<?php

use App\Models\Tip;
use App\Models\User;

it('shows the tips and tricks page', function () {
    $response = $this->get('/tips');

    $response->assertSuccessful()
        ->assertSee('Tips & Tricks')
        ->assertSee('Keep your base fresh');
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
        ->assertSee('A useful tip for the community.');
});

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
