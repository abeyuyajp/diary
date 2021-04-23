@extends("layouts.app")
@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                編集画面
            </div>
            <div class="card-body">
                <form method="POST" action="/posts/{{ $post->id }}" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="col-sm-6">
                        <input name="image" type="file">
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="title" class="control-label">Title</label>
                        <input class="form-control" name="title" type="text" value="{{ $post->title }}">
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="text" class="control-label">Text</label>
                        <input class="form-control" name="text" type="text" value="{{ $post->text }}">
                    </div>
                    <div class="form-group">
                        <label for="published" class="control-label">Date</label>
                        <input class="form-control" name="published" type="date" value="{{ $post->published }}">
                    </div>
                    <button class="btn btn-primary" type="submit">更新</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection