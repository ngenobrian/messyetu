<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

test('login page can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
    $response->assertSee('Sign in');
    $response->assertSee('Phone number');
    $response->assertSee('MessYetu');
});

test('register page can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
    $response->assertSee('Create account');
    $response->assertSee('Full names');
    $response->assertSee('Phone number');
    $response->assertSee('Repeat password');
});

test('users can register using phone number and password', function () {
    $response = $this->post('/register', [
        'name' => 'John Doe',
        'phone_number' => '0712345678',
        'password' => 'secret123',
        'password_confirmation' => 'secret123',
    ]);

    $response->assertRedirect('/dashboard');
    $this->assertAuthenticated();
    $this->assertDatabaseHas('users', [
        'name' => 'John Doe',
        'phone_number' => '0712345678',
    ]);
});

test('registration requires matching repeat password', function () {
    $response = $this->post('/register', [
        'name' => 'Jane Doe',
        'phone_number' => '0799887766',
        'password' => 'secret123',
        'password_confirmation' => 'mismatch123',
    ]);

    $response->assertSessionHasErrors('password');
    $this->assertGuest();
});

test('registration requires unique phone number', function () {
    User::create([
        'name' => 'Existing User',
        'phone_number' => '0712345678',
        'password' => Hash::make('password123'),
    ]);

    $response = $this->post('/register', [
        'name' => 'New User',
        'phone_number' => '0712345678',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertSessionHasErrors('phone_number');
    $this->assertGuest();
});

test('users can authenticate using phone number and password', function () {
    $user = User::create([
        'name' => 'John Doe',
        'phone_number' => '0712345678',
        'password' => Hash::make('secret123'),
    ]);

    $response = $this->post('/login', [
        'phone_number' => '0712345678',
        'password' => 'secret123',
    ]);

    $response->assertRedirect('/dashboard');
    $this->assertAuthenticatedAs($user);
});

test('users can not authenticate with invalid password', function () {
    User::create([
        'name' => 'John Doe',
        'phone_number' => '0712345678',
        'password' => Hash::make('secret123'),
    ]);

    $response = $this->post('/login', [
        'phone_number' => '0712345678',
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors('phone_number');
    $this->assertGuest();
});

test('users can log out', function () {
    $user = User::create([
        'name' => 'John Doe',
        'phone_number' => '0712345678',
        'password' => Hash::make('secret123'),
    ]);

    $response = $this->actingAs($user)->post('/logout');

    $response->assertRedirect('/login');
    $this->assertGuest();
});
