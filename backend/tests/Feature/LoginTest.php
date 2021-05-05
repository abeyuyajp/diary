<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;


    //ログイン画面を表示
    public function testLoginView()
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
        $this->assertGuest();
    }


    //ログイン処理
    private function testLogin()
    {
        $user = factory(User::class)->create();
        return $this->actingAs($user)
                    ->withSession(['user_id' => $user->id])
                    ->get('/');
    }

    //ログアウト処理
    public function testLogout()
    {
        $user = factory(User::class)->create();
        return $this->actingAs($user)
                    ->assertAuthenticated();

        $response = $this->post(route('logout'));

        $response->assertStatus(302)
                 ->assertRedirect('/home');

        $this->assertGuest();
    }
}
