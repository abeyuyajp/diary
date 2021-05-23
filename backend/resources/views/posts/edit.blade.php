@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 8vh;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="border-radius: 20px;">
                
                
                @include('common.errors')
                
                <div class="card-body">
                    <form enctype="multipart/form-data" method="POST" action="/posts/{{ $post->id }}" class="form-horizontal">
                        @csrf
                        @method('PUT')
                        <div class="col-sm-6">
                            <label>
                                 画像を選択
                                <input type="file" name="image" value="{{ asset('storage/image/' . $post->image) }}">
                            </label>
                        </div>

                        <div class="form-group mt-4">
                            <label for="title" class="control-label">タイトル</label>
                            <input class="form-control" name="title" type="text" value="{{ $post->title }}" style="border-radius: 20px;">
                        </div>

                        <div class="form-group">
                            <label for="text" class="control-label">テキスト</label>
                            <textarea class="form-control" name="text" style="padding-bottom: 20vh; border-radius: 20px;">{{$post->text}}</textarea>
                        </div>
                        <button class="btn btn-club-green d-block" type="submit" style="margin: 0 auto;">更新</button>
                        <input type="hidden" name="id" value="{{$post->id}}">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="sidebar_content">
                <div class="card mt-5" style="border-radius: 20px;">
                    <div class="card-body">
                        <form action="{{route('posts.translate')}}" method="post" id="translate-form">
                            @csrf
                            <div class="form-group">
                                <label for="text" class="control-label">Japanese</label>
                                <textarea class="form-control" name="before_translate" style="padding-bottom: 10vh; border-radius: 20px;"></textarea>
                                <div class="text-right">
                                    <button class="btn" type="submit" id="translate-button" style="color: #5476AA;">
                                        <i class="fas fa-language fa-2x"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mt-5" id="list" style="border-radius: 20px;">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="text" class="control-label">English</label>
                                @if(!empty($translation))
                                    <p>{{ $translation }}</p>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

