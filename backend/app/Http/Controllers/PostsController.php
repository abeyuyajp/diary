<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Validator;
use Auth;
use Illuminate\Support\Facades\Storage;
use Session;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
        
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
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
            'title' => 'required',
            "text"  => 'required',
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
            'title'=>'required',
            'text' =>'required',
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
            //Storage::delete('storage/image/'. $post->image);
            $filename = $file->getClientOriginalName();
            $move = $file->move('storage/image', $filename);
            $posts->image = $filename;
            $posts->save();
        }

        $posts->title      =    $request->title;
        $posts->text       =    $request->text;
        $posts->save(); 
        return redirect('/');
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
        return redirect('/');
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
