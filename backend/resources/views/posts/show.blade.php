@extends("layouts.app")
@section("content")

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card mb-3">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="300" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image cap"><title>Placeholder</title><rect fill="#868e96" width="100%" height="100%"/><text fill="#dee2e6" dy=".3em" x="50%" y="50%">Image cap</text></svg>
            <div class="card-body">
                <h1 class="card-title">{{ $post->title }}</h1>
                <p class="card-text"><small class="text-muted">{{ $post->user->name }}</small></p>
                <p class="card-text"><small class="text-muted">{{ $post->created_at }}</small></p>
                <p class="card-text" style="font-size: 20px;">{{ $post->text }}</p>
            </div>

            @if(Auth::id() === $post->user_id)
            <div class="row justify-content-center">
                <a href="{{ url('posts/' . $post->id . '/edit') }}" class="btn btn-club-green">編集</a>
                <form method="POST" action="/posts/{{ $post->id }}">
                    @csrf 
                    @method('DELETE')
                    <button class="btn btn-club-blue" type="submit">削除</button>
                </form>
            </div>
            @endif
        </div>

        <!-- コメント -->
        <div class="p-3">

            <!-- コメントフォーム -->
            @if(Auth::check())
            <form method="POST" action="/comments">
                @csrf 
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <input type="hidden" name="user_id" value="{{ $post->user->id }}">
                <div class="form-group">
                    <textarea class="form-control" name="text" placeholder="コメント"></textarea>
                </div>
                <button class="btn btn-club-green d-block" type="submit" style="margin: 0 auto;">投稿</button>
            </form>
            @endif
            <!-- コメント表示 -->
            <ul>
                @forelse ($post->comments as $comment)
                <p>{{ $comment->user->name }}</p>
                <li>{{ $comment->text }}</li>
                @empty
                <li>コメントはまだありません</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection


