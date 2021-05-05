<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Post;

class PostsControllerTest extends TestCase
{
    use RefreshDatabase;


    ### 投稿一覧表示機能のテスト ###

    //未ログイン状態で投稿一覧ページに遷移するとログインページに遷移される
    public function testGuestIndex()
    {
        $response = $this->get('/');
        $response->assertRedirect(route('login'));
    }

    //ログイン時
    public function testAuthIndex() 
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
            ->get('/');

        $response->assertStatus(200)
            ->assertViewIs('posts.index')
            ->assertSee('投稿')
            ->assertSee($user->name);
    }

    ### 新規投稿画面のテスト ###

    //未ログイン状態で新規投稿ページに遷移するとログインページに遷移される
    public function testGuestCreate()
    {
        $response = $this->get(route('posts.create'));
        $response->assertRedirect(route('login'));
    }

    //ログイン時
    public function testAuthCreate()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
            ->get(route('posts.create'));
        
        $response->assertStatus(200)
            ->assertViewIs('posts.create');
    }

    ### 投稿機能のテスト ###

    //未ログイン状態で投稿しようとするとログインページに遷移される
    public function testGuestStore() 
    {
        $response = $this->post(route('posts.store'));
        $response->assertRedirect(route('login'));
    }
    
    //ログイン時
    public function testAuthStore()
    {
        $user = factory(User::class)->create();

        $title   = "this is title";
        $text    = "this is text";
        $user_id = $user->id;

        $response = $this->actingAs($user)
            ->post(route('posts.store', 
            [
                'title'   =>   $title,
                'text'    =>   $text,
                "user_id" =>   $user_id,
            ]
            ));

        $this->assertDatabaseHas('posts',
            [
                'title'   =>   $title,
                'text'    =>   $text,
                "user_id" =>   $user_id,
            ]);
        $response->assertRedirect('/');
    }


    ### 投稿編集ページのテスト ###

    //未ログイン状態で編集ページに遷移するとログインページに遷移される
    public function testGuestEdit()
    {
        $post = factory(Post::class)->create();

        $response = $this->get(route('posts.edit', ['post' => $post]));
        $response->assertRedirect(route('login'));
    }

    //ログイン時
    public function testAuthEdit()
    {
        $post = factory(Post::class)->create();
        $user = $post->user;

        $response = $this->actingAs($user)
            ->get(route('posts.edit', ['post' => $post]));
        $response->assertStatus(200)
            ->assertViewIs('posts.edit');
    }


    ### 投稿削除のテスト ###
    public function testDestroy()
    {
        $user = factory(User::class)->create();

        $title   = "this is title";
        $text    = "this is text";
        $image   = "/storage/image/j-logo.png";
        $user_id = $user->id;

        $post = Post::create([
            'title'   => $title,
            'text'    => $text,
            'image'   => $image,
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)
            ->delete(route('posts.destroy', ['post' => $post]));
        
        $this->assertDeleted('posts', [
            'title'   => $title,
            'text'    => $text,
            'image'   => $image,
            'user_id' => $user_id,
        ]);

        $response->assertRedirect('/');
    }
}
