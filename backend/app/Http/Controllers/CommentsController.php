<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Post;
use App\Comment;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'text' => 'required'
          ]);

        $comments = new Comment;
        $comments->user_id     =    Auth::user()->id;
        $comments->post_id     =    $request->post_id;
        $comments->text        =    $request->text;
        $comments->save();
        return redirect('posts/' . $comments->post_id);
    }
}
