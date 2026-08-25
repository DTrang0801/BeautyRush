<?php

it('shows featured products and reviews on the homepage', function () {
    $response = $this->get('/');

    $response->assertSuccessful()
        ->assertSee('Products worth talking about')
        ->assertSee('Soft Glow Foundation')
        ->assertSee('Feels weightless and still looks fresh at the end of the day.')
        ->assertSee('Sophie M.');
});
