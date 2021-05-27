@extends("layouts.app")
@section("content")

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-5" style="border-radius: 20px;">
              @if(!empty($post->image))
                <img src="{{ asset('storage/image/' . $post->image) }}" class="card-img-top" style="border-radius: 20px 20px 0 0;">
              @endif
                <div class="card-body">
                    <h1 class="card-title">{{ $post->title }}</h1>
                    <div class="d-flex justify-content-between">
                          <p class="card-text"><small class="text-muted">{{ $post->created_at->format('Y/m/d H:i') }}</small></p>
                          <ul class="navbar-nav">
                              <li class="nav-item dropdown" style="list-style: none;">
                                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 25px; color: #5476AA;">
                                  </a>
                                  <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="border-radius: 20px;">
                                      <a class="dropdown-item" href="{{ url('posts/' . $post->id . '/edit') }}">編集する</a>
                                      <form method="POST" action="/posts/{{ $post->id }}">
                                          @csrf 
                                          @method('DELETE')
                                          <button class="dropdown-item" type="submit">削除する</button>
                                      </form>
                                  </div>
                              </li>
                          </ul>
                  </div>
                    <p class="card-text" style="font-size: 20px;">{{ $post->text }}</p>
                </div>
            </div>
            <div class="p-3">
                <!-- コメントフォーム -->
                @if(Auth::check())
                    <form method="POST" action="/comments" style="margin-bottom: 8vh;">
                        @csrf 
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <input type="hidden" name="user_id" value="{{ $post->user->id }}">
                        <div class="form-group d-flex" >
                            <textarea class="form-control" name="text" placeholder="分からなかった単語や文法はメモしておきましょう" style="border-radius: 20px;"></textarea>
                            <input class="btn btn-club-green" type="submit" value="メモを追加" style="border-radius: 20px;">
                        </div>
                    </form>
                @endif

                <!-- コメント表示 -->
                <div class="mx-auto" style="width: 80%;">
                    <h2>MEMO</h2>
                    @forelse ($post->comments as $comment)
                        <table>
                            <tbody>
                                <tr>
                                    <th scope="row" style="padding: 3vh 3vw;"><small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small></th>
                                    <td>{{ $comment->text }}</td>
                                </tr>
                            </tbody>
                        </table>
                    @empty
                        <p>メモはまだありません</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
