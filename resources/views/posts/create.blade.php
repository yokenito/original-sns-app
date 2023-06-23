@extends('layouts.app')


@section('content')
    <div class="create-section">
        <h2 class="section-ttl">新規投稿</h2>
        <h5>投稿内容</h5>
        <form action="#" method="post" class="w-50">
            <div class="mt-4">
                <textarea name="description_detail" class="form-control">{{old('description_detail')}}</textarea>
            </div>
            <div>

            </div>
            <p>※個人情報の入力禁止</p>
            <div>
                <img src="#" alt="#">

            </div>
            <button type="submit" class="btn btn-primary">投稿</button>
        </form>
    </div>
@endsection