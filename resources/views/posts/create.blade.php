@extends('layouts.app')


@section('content')

<div class="graybody">
    <div class="create-section">
        <h2 class="section-ttl">新規投稿</h2>

        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div id="postcreate-form">
                <div class="mt-2 w-75">
                    <label for="title" class="form-label">タイトル</label>
                    <input type="text" name="title" class="form-control" value="{{old('title')}}">
                </div>
                <div class="mt-4 w-75 h-25 postbox">
                    <label for="title" class="form-label">投稿内容</label>
                    <textarea name="content" rows="15" class="form-control w-100">{{old('description_detail')}}</textarea>
                </div>
                <div>

                </div>
                <p>※個人情報の入力禁止</p>
                <div>
                    <img src="{{asset('img/img.png')}}" alt="img_icon" id="img_icon">
                    <label for="file_upload" id="file_up">
                        画像の投稿
                        <input type="file" name="image[]" id="file_upload" multiple>
                    </label>
                </div>
                <div class="post-btn-box">
                    <button type="submit" name="post_content" class="btn btn-primary post-btn">投稿</button>
                </div>
                
            </div>
        </form>
    </div>
</div>
    
@endsection