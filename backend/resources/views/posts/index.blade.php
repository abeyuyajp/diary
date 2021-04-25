@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row text-center">
    <div class="col-sm">
        <!--投稿一覧-->
        @foreach($posts as $post)
          <a href="{{ url('posts/' . $post->id) }}" style="text-decoration: none;">
          <div class="card d-inline-block" style="width: 18rem;">
             <img src="..." class="card-img-top" alt="...">
             <div class="card-body">
                <h2 class="card-title" style="color:black;">{{ $post->title }}</h2>
                 <p class="card-text"><small class="text-muted">{{ $post->text }}</small></p>
                 <p class="card-text"><small class="text-muted">{{ $post->user->name }}</small></p>
                 <p class="card-text"><small class="text-muted">{{ $post->created_at }}</small></p>
             </div>
          </div>
          </a>
        @endforeach
    </div>
  </div>
  <!--ページネーション-->
  <div class="row justify-content-center">
     <div class="col-md-4">
        {{ $posts->links() }}
     </div>
  </div>
</div>
@endsection


