<?php

use App\Models\User;

test('guests are redirected to the login page', function () {
    $response = $this->get('/admin');
    $response->assertRedirect('/login');
});

test('authenticated users can visit the dashboard', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/admin');
    $response->assertStatus(200);
});
