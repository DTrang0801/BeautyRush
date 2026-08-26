<?php

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
