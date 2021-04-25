@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">投稿を編集</div>

                @include('common.errors')
                
                <div class="card-body">
                <form method="POST" action="/posts/{{ $post->id }}" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="col-sm-6">
                        <input type="file" name="image">
                    </div>

                    <div class="form-group">
                        <label for="title" class="control-label">Title</label>
                        <input class="form-control" name="title" type="text" value="{{ $post->title }}">
                    </div>

                    <div class="form-group">
                        <label for="text" class="control-label">Text</label>
                        <textarea class="form-control" name="text" style="padding-bottom: 50vh;">{{$post->text}}</textarea>
                    </div>
                    
                    <button class="btn btn-club-green d-block" type="submit" style="margin: 0 auto;">更新</button>
                </form>
            </div>
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
