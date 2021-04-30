@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row text-center">
    <div class="col-sm">
        <!--検索結果-->
        @isset($search_result)
          <h2>{{ $search_result }}</h2>
        @endisset
        <!--投稿一覧-->
        @if (session('message'))
          <div class="alert alert-success">
             {{ session('message') }}
          </div>
        @endif
        @foreach($posts as $post)
          <a href="{{ url('posts/' . $post->id) }}" style="text-decoration: none;">
          <div class="card d-inline-block m-2" style="width: 18rem;">
            @if(!empty($post->image))
             <img src="{{ asset('storage/image/' . $post->image) }}" class="card-img-top" width="100%">
            @endif
             <div class="card-body">
                <h2 class="card-title" style="color:black;">{{ $post->title }}</h2>
                 <p class="card-text"><small class="text-muted">{{ Str::limit( $post->text, 100 ) }}</small></p>
                 <p class="card-text"><small class="text-muted">{{ $post->created_at->diffForHumans() }}</small></p>
             </div>
          </div>
          </a>
        @endforeach
    </div>
  </div>
  <!--ページネーション-->
  <div class="row justify-content-center">
     <div class="col-md-4">
     {{ $posts->appends(request()->input())->links() }}
     
     </div>
  </div>
</div>
@endsection


