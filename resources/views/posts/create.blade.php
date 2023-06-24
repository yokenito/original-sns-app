@extends('layouts.app')


@section('content')
<div class="graybody">
    <div class="create-section">
        <h2 class="section-ttl">新規投稿</h2>
        <h5 id="post-content">投稿内容</h5>

        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="#" method="post" enctype="multipart/form-data">
            @csrf
            <div id="postcreate-form">
                <div class="mt-4 w-75 h-25 postbox">
                    <textarea name="content" class="form-control w-100">{{old('description_detail')}}</textarea>
                </div>
                <div>

                </div>
                <p>※個人情報の入力禁止</p>
                <div>
                    <img src="#" alt="#">
                    <input type="file" name="image[]" multiple>
                </div>
                <div class="post-btn-box">
                    <button type="submit" name="post_content" class="btn btn-primary post-btn">投稿</button>
                </div>
                
            </div>
        </form>
    </div>
</div>
    
@endsection