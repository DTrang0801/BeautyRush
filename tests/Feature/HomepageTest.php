<?php

use App\Models\User;

it('shows featured products and reviews on the homepage', function () {
    $response = $this->get('/');

    $response->assertSuccessful()
        ->assertSee('Products worth talking about')
        ->assertSee('Soft Glow Foundation')
        ->assertSee('Rosewood Lip Tint')
        ->assertSee('Cloud Cream Cleanser')
        ->assertSee('Blush & Blend Brush')
        ->assertSee('Feels weightless and still looks fresh at the end of the day.')
        ->assertSee('Sophie M.');
});

it('hides the account link from guests', function () {
    $this->get('/')
        ->assertSuccessful()
        ->assertDontSee('>Account</a>', false);
});

it('shows the account link to authenticated users', function () {
    $this->actingAs(User::factory()->create())
        ->get('/')
        ->assertSuccessful()
        ->assertSee('>Account</a>', false);
});
