<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function testCreate()
    {
        $UserName = 'テストさん';
        $Email    = 'test@example';
        $Password = 'password123';
        $PasswordConfirmation = 'password123';

        $response = $this->post(route('register'),
            [
                'name'  => $UserName,
                'email' => $Email,
                'password' => $Password,
                'password_confirmation' => $PasswordConfirmation,
            ]
        );

        $this->assertDatabaseHas('users', [
            'name' => $UserName,
            'email' => $Email,
        ]);

        $response->assertRedirect('/');
    }
}
