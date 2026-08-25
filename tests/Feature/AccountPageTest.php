<?php

use App\Models\User;

it('shows the users reviews and beauty tips on the account page', function () {
    $this->actingAs(User::factory()->create())
        ->get('/account')
        ->assertSuccessful()
        ->assertSee('My reviews')
        ->assertSee('Soft Glow Foundation')
        ->assertSee('Beauty tips')
        ->assertSee('Keep your base fresh');
});

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
