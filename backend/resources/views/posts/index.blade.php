@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">投稿一覧</div>
                    @foreach($posts as $post)
                    <a href="{{ url('posts/' . $post->id) }}">
                      <div class="card">
                        <div class="card-body">
                           <h2 class="card-title">{{ $post->title }}</h2>
                           <p class="card-text">{{ $post->text }}</p>
                           <p class="card-text">{{ $post->user->name }}</p>
                           <p class="card-text">{{ $post->published }}</p>
                        </div>
                      </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
