@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row text-center">
        <div class="col-sm">

            <!--youtube(検索結果の表示時には表示しない)-->
            @if (!isset($search_result))
              <h1> Journaly TV </h1>
              <div class="movieBox">
                  <div class="thums mb-5">
                      <iframe class="video" src="https://www.youtube.com/embed/{{ $video_id }} " frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="height: 40vh; width: 80%; border-radius: 20px;"></iframe>
                  </div>
              </div>
            @endif

            <!--検索結果-->
            @isset($search_result)
              <h2>{{ $search_result }}</h2>
            @endisset

            <!--投稿一覧-->
            @if (session('message'))
                <div class="alert alert-success" style="color: white; background-color: #27AE60; border-color: #27AE60;">
                    {{ session('message') }}
                </div>
            @endif

            @foreach($posts as $post)
                <a href="{{ url('posts/' . $post->id) }}" style="text-decoration: none;">
                    <div class="card d-inline-block m-2" style="width: 18rem; border-radius: 20px;">
                        @if(!empty($post->image))
                          <img src="{{ asset('storage/image/' . $post->image) }}" class="card-img-top" width="100%" style="border-radius: 20px 20px 0 0;">
                        @endif
                        <div class="card-body">
                            <h2 class="card-title" style="color:black;">{{ $post->title }}</h2>
                            <p class="card-text"><small class="text-muted">{{ $post->created_at->diffForHumans() }}</small></p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <!--ページネーション-->
    <div class="mx-auto mt-5" style="width: 150px;">
        <div class="col-md-4">
            {{ $posts->appends(request()->input())->links() }}
        </div>
    </div>

    <!-- 追従投稿ボタン -->
    <div>
        <a href="{{ url('posts/create') }}" class="btn-club-green"  style="position: fixed; bottom: 10px; right: 12vw; padding: 6px 4px; border-radius: 20px; padding: 6px 20px; color: white; text-decoration: none;">
            <strong style="font-size: 20px;">＋ New post</strong>
        </a>
    </div>
</div>
@endsection


