@extends('layouts.app')

@section('content')
    <div class="graybody">
        <div class="mt-4 row">
            <div class="col-4">
                <div class="text-center bgcwhite ms-5">
                    <h5 class="mt-3">{{$today->month - 1}}月ランキング</h5>
                    <div class="rank-list-box">
                        <ul class="d-flex justify-content-around rank-list">
                            <li class="select-btn"><a href="#">いいね</a></li>
                            <li class="nonselect-btn"><a href="#">面白い</a></li>
                            <li class="nonselect-btn"><a href="#">感動</a></li>
                        </ul>
                    </div>
                    <div>
                        <div>
                            <table class="rank-table">
                                <tr>
                                    <th id="ranktbl-usr">user</th>
                                    <th>count</th>
                                </tr>
                                @if($rank_users)
                                    @for($i=0; $i < 5; $i++)
                                    <tr class="rank-tr">
                                        <td id="ranktbl-usr" class="d-flex align-items-center">
                                            <p id="rank">{{$i + 1}}</p>
                                            <img class="user-img" src="{{asset('img/user-icon.jpeg')}}" alt="user_icon">
                                            <p id="user-name">{{$rank_users[$i]["name"]}}</p>
                                        </td>
                                        <td id="count">{{$rank_users[$i]["monthrank_count"]}}</td>
                                    </tr>
                                    @endfor
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-7">
                <div class="bgcwhite">
                    @foreach($posts as $post)
                        <div class="post-sec">
                            <p id="post-category">カテゴリー</p>
                            <a href="{{route('posts.show',$post)}}" id="post-ttl">{{$post->title}}</a>
                            <div class="d-flex post-inf">
                                <img src="{{asset('img/nice.png')}}" alt="nice_icon" id="nice_icon">
                                <!-- <p></p> -->
                                <p class="ms-2">{{substr($post->created_at,0,16)}}</p>
                                <p class="ms-3">{{$post->user->name}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection