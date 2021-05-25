@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 8vh;">
    <div class="row justify-content-center">
    <div class="col-md-4">
            <div class="sidebar_content">
                <div class="card mt-5" style="border-radius: 20px;">
                    <div class="card-body">
                        <form action="{{route('translate.translate')}}" method="post" id="translate-form">
                            @csrf
                            <div class="form-group">
                                <label for="text" class="control-label">Japanese</label>
                                <textarea class="form-control" name="before_translate" id ="before-translate" style="padding-bottom: 10vh; border-radius: 20px;"></textarea>
                                <div class="text-right">
                                    <button class="btn" type="submit" id="translate-button" style="color: #5476AA;">
                                        <i class="fas fa-language fa-2x"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mt-5" style="border-radius: 20px;">
                    <div class="card-body">
                        <div class="form-group" id="after-translate">
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