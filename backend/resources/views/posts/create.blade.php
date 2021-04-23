@extends("layouts.app")
@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                新規投稿
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" method="POST" action="/posts">
                    @csrf
                    <div class="col-sm-6">
                        <input name="image" type="file">
                    </div>

                    <div class="form-group">
                        <label for="title" class="control-label">Title</label>
                        <input class="form-control" name="title" type="text">
                    </div>

                    <div class="form-group">
                        <label for="text" class="control-label">Text</label>
                        <input class="form-control" name="text" type="text">
                    </div>
                    
                    <div class="form-group">
                        <label for="published" class="control-label">date</label>
                        <input class="form-control" name="published" type="date">
                    </div>



                    <button class="btn btn-primary" type="submit">GO</button>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection