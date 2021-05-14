
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">新規投稿</div>
                
                @include('common.errors')
                
                <div class="card-body">
                <form enctype="multipart/form-data" method="POST" action="/posts">
                    @csrf
                    <div class="col-sm-6">
                        <label>
                        画像を選択
                            <input type="file" name="image">
                        </label>
                    </div>

                    <div class="form-group mt-4">
                        <label for="title" class="control-label">タイトル</label>
                        <input class="form-control" name="title" type="text">
                    </div>

                    <div class="form-group">
                        <label for="text" class="control-label">テキスト</label>
                        <textarea class="form-control" name="text" style="padding-bottom: 20vh;"></textarea>
                    </div>


                    <button class="btn btn-club-green d-block" type="submit" style="margin: 0 auto;">投稿</button>
                </form>
                </div>
                <form action="{{route('posts.translate')}}" method="post">
                @csrf
                    <div class="form-group">
                        <label for="text" class="control-label">日本語を入力してください</label>
                        <textarea class="form-control" name="before_translate" style="padding-bottom: 10vh;"></textarea>
                        <button type="submit" class="btn btn-club-blue d-block" value="翻訳" style="position: relative;top: -38px; right: -352px;">
                    </div>

                    <div class="form-group">
                        <label for="text" class="control-label">翻訳</label>
                        <textarea class="form-control" name="translate" style="padding-bottom: 10vh;">
                        @if(!empty($translating))
                        {{ $translating }}
                        @endif
                        </textarea>
                    </div>
                </form>
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
