<?php

it('shows the contact information page', function () {
    $this->get('/contact')
        ->assertSuccessful()
        ->assertSee('Let’s talk beauty.')
        ->assertSee('hello@beautyrush.test')
        ->assertSee('+32 488 49 59 20')
});
