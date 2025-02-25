<?php

use App\Models\User;


it('returns a successful response', function () {
    $response = $this->get('/');

    $response->assertSee("Kanye Quotes");

    $response->assertStatus(200);
});

test('users can not view quotes list without login', function () {

    $response = $this->get('/quotes');

    $response->assertRedirect('/login');

});

it('returns a quotes page when logged in', function () {
    $user = User::factory()->create();
      $response = $this
        ->actingAs($user)
        ->get('/quotes');

    $response->assertSee('Quotes');

});

it('displays the list of quotes header', function () {
    $user = User::factory()->create();

     $response = $this
         ->actingAs($user)
        ->get('/quotes');
    
    $response->assertSee('Kanye Rest API');
});

