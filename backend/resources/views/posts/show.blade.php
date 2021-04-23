@extends("layouts.app")
@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                詳細画面
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>image</th>
                            <td>{{$post->img}}</td>
                        </tr>
                        <tr>
                            <th>title</th>
                            <td>{{$post->title}}</td>
                        </tr>
                        <tr>
                            <th>text</th>
                            <td>{{$post->text}}</td>
                        </tr>
                        <tr>
                            <th>date</th>
                            <td>{{$post->published}}</td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ url('/') }}" class="btn btn-info">戻る</a>
            </div>
        </div>
    </div>
</div>
@endsection