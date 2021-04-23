@extends("layouts.app")
@section("content")
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
          投稿一覧
      <div>
      <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
        @endif
        <a href="{{ url('posts/create') }}" class="btn btn-success mb-3">投稿</a>
        <table class="table">
          <thead>
            <tr>
              <th>image</th>
              <th>title</th>
              <th>text</th>
              <th>published</th>
            </tr>
          </thead>
          <tbody>
            @foreach($posts as $post)
            <tr>
              <td><img src="../upload/{{$post->image}}" width="100"></td>
              <td>{{ $post->title }}</td>
              <td>{{ $post->text }}</td>
              <td><a href="{{ url('posts/' . $post->id) }}" class="btn btn-info">詳細</a></td>
              <td><a href="{{ url('posts/' . $post->id . '/edit') }}" class="btn btn-primary">編集</a></td>
              <td>
                <form method="POST" action="/posts/{{ $post->id }}">
                  @csrf 
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">削除</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection