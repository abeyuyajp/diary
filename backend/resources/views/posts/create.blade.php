
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
                        <input type="file" name="image">
                    </div>

                    <div class="form-group">
                        <label for="title" class="control-label">Title</label>
                        <input class="form-control" name="title" type="text">
                    </div>

                    <div class="form-group">
                        <label for="text" class="control-label">Text</label>
                        <textarea class="form-control" name="text" style="padding-bottom: 50vh;"></textarea>
                    </div>


                    <button class="btn btn-success d-block" type="submit" style="margin: 0 auto;">GO</button>
                </form>
            </div>
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
