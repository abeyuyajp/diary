<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Validator;
use Auth;

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
        ->paginate(12);
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
        return redirect('/');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if(Auth::id() === $post->user_id) {
            return view('posts.show', compact('post'));
        }else{
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($post_id)
    {
        $post = Post::find($post_id);
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
    public function update(Request $request, $id)
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

        $file = $request->file('image');
        if(!empty($file)) {
            $filename = $file->getClientOriginalName();
            $move = $file->move('storage/image', $filename);
        }else{
            $filename="";
        }

        $posts = Post::where('user_id', Auth::user()->id)->find($request->id);
        $posts->image      =    $filename;
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
}
