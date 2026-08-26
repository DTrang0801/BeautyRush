<?php

use App\Models\User;

it('shows all products and reviews on the products page', function () {
    $response = $this->get('/products');

    $response->assertSuccessful()
        ->assertSee('Find your beauty essentials')
        ->assertSee('Soft Glow Foundation')
        ->assertSee('Rosewood Lip Tint')
        ->assertSee('Cloud Cream Cleanser')
        ->assertSee('Blush & Blend Brush')
        ->assertSee('Great quality for the price.')
        ->assertSee('View details')
        ->assertSee('Reviews')
        ->assertSee('Mila P.');
});

it('asks guests to log in before saving a product', function () {
    $this->post(route('products.favorite.toggle', ['product' => 'Soft Glow Foundation']))
        ->assertRedirect(route('login'))
        ->assertSessionHas('status', 'Please log in to save a product.');
});

it('lets an authenticated user save a product', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('products.favorite.toggle', ['product' => 'Soft Glow Foundation']))
        ->assertRedirect();

    expect(session('favorite_products'))->toContain('Soft Glow Foundation');
});

it('removes a product from favorites when clicked again', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->withSession(['favorite_products' => ['Soft Glow Foundation']])
        ->post(route('products.favorite.toggle', ['product' => 'Soft Glow Foundation']))
        ->assertRedirect();

    expect(session('favorite_products'))->not->toContain('Soft Glow Foundation');
});

it('lets an authenticated user write a product review', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('products.reviews.store'), [
            'product_name' => 'Soft Glow Foundation',
            'rating' => 5,
            'content' => 'A beautiful everyday foundation.',
        ])
        ->assertRedirect();

    expect($user->reviews()->where('product_name', 'Soft Glow Foundation')->exists())->toBeTrue();

    $this->get('/products')
        ->assertSee($user->name)
        ->assertSee('A beautiful everyday foundation.');
});
