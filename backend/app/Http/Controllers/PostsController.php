<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Post;
use Validator;
use Auth;
use Illuminate\Support\Facades\Storage;
use Session;
use Google\Cloud\Translate\V2\TranslateClient;
use App\Http\Vender\CallYoutubeApi;



class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->api_key = env("GOOGLE_TRANSLATION_API_KEY");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::user()->id)
        ->orderBy('created_at', 'desc')
        ->paginate(10);

       $t = new CallYoutubeApi();
       $video = $t->searchVideos();
       $video_id = $video['id']['videoId'];
        
       return view('posts.index', compact('posts', 'video_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('posts.create');
        
    }

    public function translate(Request $request)
    {   
        if(!empty($request->before_translate)) {
            $translate = new TranslateClient(['key' => $this->api_key]);
            $lang = "en";
            $result = $translate->translate($request->before_translate, [
                'target' => $lang,
            ]);
            $translation = $result['text'];
            return view('posts.create', compact('translation'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'title' => ['required','regex:/^[a-zA-Z0-9]+$/'],
            'text'  => ['required', 'regex:/^[a-zA-Z0-9]+$/'],
        ]);

        //バリデーションエラー
        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }

        $file = $request->file('image');
        if(!empty($file)) {
            $filename = $file->getClientOriginalName();
            $move = $file->move('storage/image', $filename);
        }else{
            $filename="";
        }


        $posts = new Post;
        $posts->user_id    =    Auth::user()->id;
        $posts->image      =    $filename;
        $posts->title      =    $request->title;
        $posts->text       =    $request->text;
        $posts->save(); 
        return redirect('/')->with('message', '投稿が完了しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $post = Post::find($id);
        if(Auth::id() === $post->user_id) {
            return view('posts.show', compact('post'));
        }else{
            return redirect('/');
        }
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($post_id)
    {
        $posts = Post::where('user_id', Auth::user()->id)->find($post_id);
        return view('posts.edit', ['post' => $posts]);

        if(Auth::id() === $post->user_id) {
            return view('posts.edit', compact('post'));
        }else{
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {   
        //バリデーション
        $validator = Validator::make($request->all(), [
            'title' => ['required','regex:/^[a-zA-Z0-9]+$/'],
            'text'  => ['required', 'regex:/^[a-zA-Z0-9]+$/'],
        ]);

        //バリデーションエラー
        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }

        $posts = Post::where('user_id', Auth::user()->id)->find($request->id);

        $file = $request->file('image');

        if(!empty($file)) {
            $filename = $file->getClientOriginalName();
            $move = $file->move('storage/image', $filename);
            $posts->image = $filename;
            $posts->save();
        }

        $posts->title      =    $request->title;
        $posts->text       =    $request->text;
        $posts->save(); 
        return redirect('/')->with('message', '投稿を編集しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect('/')->with('message', '投稿を削除しました');
    }

    public function search(Request $request)
    {
        $posts = Post::where('user_id', Auth::user()->id)
                       ->where('title', 'like', "%{$request->search}%")
                       ->orderBy('created_at', 'desc')
                       ->paginate(10);

        $search_result = $request->search. 'の検索結果：'.$posts->total().'件';

        return view('posts.index', [
            'posts'=>$posts,
            'search_result' => $search_result,
            'search_query'  => $request->search,
        ]);
    }
}
