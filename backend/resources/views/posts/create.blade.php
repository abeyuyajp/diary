
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
                        <textarea class="form-control" name="text" style="padding-bottom: 50vh;"></textarea>
                    </div>


                    <button class="btn btn-club-green d-block" type="submit" style="margin: 0 auto;">投稿</button>
                </form>
            </div>
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
