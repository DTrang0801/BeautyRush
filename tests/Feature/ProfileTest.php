<?php

use App\Models\Review;
use App\Models\Tip;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('profile page is displayed', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/profile');

    $response->assertOk();
});

test('profile information can be updated', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->patch('/profile', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/profile');

    $user->refresh();

    $this->assertSame('Test User', $user->name);
    $this->assertSame('test@example.com', $user->email);
    $this->assertNull($user->email_verified_at);
});

test('email verification status is unchanged when the email address is unchanged', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->patch('/profile', [
            'name' => 'Test User',
            'email' => $user->email,
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/profile');

    $this->assertNotNull($user->refresh()->email_verified_at);
});

test('user can delete their account', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->delete('/profile', [
            'password' => 'password',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/');

    $this->assertGuest();
    $this->assertNull($user->fresh());
});

test('correct password must be provided to delete account', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->from('/profile')
        ->delete('/profile', [
            'password' => 'wrong-password',
        ]);

    $response
        ->assertSessionHasErrorsIn('userDeletion', 'password')
        ->assertRedirect('/profile');

    $this->assertNotNull($user->fresh());
});

test('users can update their public profile fields and photo', function () {
    Storage::fake('public');
    $user = User::factory()->create();

    $this->actingAs($user)
        ->patch('/profile', [
            'name' => 'Test User',
            'username' => 'beautylover',
            'email' => $user->email,
            'birthday' => '1995-04-12',
            'about' => 'I love discovering gentle skincare.',
            'profile_photo' => UploadedFile::fake()->image('profile.jpg'),
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect('/profile');

    $user->refresh();

    expect($user->username)->toBe('beautylover')
        ->and($user->birthday->format('Y-m-d'))->toBe('1995-04-12')
        ->and($user->about)->toBe('I love discovering gentle skincare.')
        ->and($user->profile_photo_path)->not->toBeNull();
});

test('a users profile is publicly viewable', function () {
    $user = User::factory()->create([
        'username' => 'beautylover',
        'about' => 'I love discovering gentle skincare.',
    ]);

    $this->get('/users/'.$user->id)
        ->assertSuccessful()
        ->assertSee('beautylover')
        ->assertSee('I love discovering gentle skincare.');
});

test('a public profile shows the users reviews and tips', function () {
    $user = User::factory()->create(['username' => 'beautylover']);
    Review::create([
        'user_id' => $user->id,
        'product_name' => 'Petal Pop Blush',
        'rating' => 4.8,
        'content' => 'A beautiful soft pink.',
    ]);
    Tip::create([
        'user_id' => $user->id,
        'title' => 'Blend with a light hand',
        'content' => 'Start with less product and build slowly.',
    ]);

    $this->get('/users/'.$user->id)
        ->assertSee('Petal Pop Blush')
        ->assertSee('A beautiful soft pink.')
        ->assertSee('Blend with a light hand')
        ->assertSee('Start with less product and build slowly.');
});
