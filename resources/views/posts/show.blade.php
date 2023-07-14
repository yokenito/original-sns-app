@extends('layouts.app')

@section('content')
    <div class="graybody">
        <div class="mt-4 row">
            <div class="col-4">
                <div class="text-center bgcwhite ms-5">
                    <h5 class="mt-3">月間ランキング</h5>
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
                                <?php $count = 1; ?>
                                @foreach($rank_users as $user)
                                <tr class="rank-tr">
                                    <td id="ranktbl-usr" class="d-flex align-items-center">
                                        <p id="rank">{{$count}}</p>
                                        <img class="user-img" src="{{asset('img/user-icon.jpeg')}}" alt="user_icon">
                                        <p id="user-name">{{$user->name}}</p>
                                    </td>
                                    <td id="count">100</td>
                                </tr>
                                <?php $count++; ?>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-7">
                <div class="bgcwhite">
                    <div class="d-flex mt-3">
                        <img class="showuser-img" src="{{asset('img/user-icon.jpeg')}}" alt="showuser_icon">
                        <div>
                            <p id="showuser-name">{{$post->user->name}} <span id="name-res">さん</span></p>
                            <p id="show-posttime">{{substr($post->created_at,0,16)}}</p>
                        </div>
                    </div>
                    <div id="postcontent">
                        <p>{{$post->content}}</p>
                    </div>
                    <div>
                        <div class="imgbox">
                            @foreach($post->postImgs()->get() as $postimg)
                                <div class="postimg">
                                    <img src="{{asset($postimg->img_path)}}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @if($user != null)
                        @if($user->isNice($post->id))
                            <!-- <button onclick="nice({{$post->id}}, this)" class="nicebtn active">
                                <span class="nice">★</span>お気に入り
                            </button> -->
                            <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="width: 32px; height: 32px;" xml:space="preserve">
                            <style type="text/css">
                                .st0{fill:#4B4B4B;}
                            </style>
                            <g>
                                <path class="st0" d="M380.63,32.196C302.639,33.698,264.47,88.893,256,139.075c-8.47-50.182-46.638-105.378-124.63-106.879
                                    C59.462,30.814,0,86.128,0,187.076c0,129.588,146.582,189.45,246.817,286.25c3.489,3.371,2.668,3.284,2.668,3.284
                                    c1.647,2.031,4.014,3.208,6.504,3.208v0.011c0,0,0.006,0,0.011,0c0,0,0.006,0,0.011,0v-0.011c2.489,0,4.856-1.177,6.503-3.208
                                    c0,0-0.821,0.086,2.669-3.284C365.418,376.526,512,316.664,512,187.076C512,86.128,452.538,30.814,380.63,32.196z" style="fill: rgb(0, 0, 0);"></path>
                            </g>
                            </svg>
                        @else
                            <!-- <button onclick="nice({{$post->id}}, this)" class="nicebtn">
                                <span class="nice">★</span>お気に入り
                            </button> -->
                            <div class="d-flex">
                                <div class="stamp-box">
                                    <div>
                                        <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="width: 25px; height: 25px;" xml:space="preserve">
                                        <style type="text/css">
                                            .st0{fill:#4B4B4B;}
                                        </style>
                                        <g>
                                            <path class="st0" d="M380.63,32.196C302.639,33.698,264.47,88.893,256,139.075c-8.47-50.182-46.638-105.378-124.63-106.879
                                                C59.462,30.814,0,86.128,0,187.076c0,129.588,146.582,189.45,246.817,286.25c3.489,3.371,2.668,3.284,2.668,3.284
                                                c1.647,2.031,4.014,3.208,6.504,3.208v0.011c0,0,0.006,0,0.011,0c0,0,0.006,0,0.011,0v-0.011c2.489,0,4.856-1.177,6.503-3.208
                                                c0,0-0.821,0.086,2.669-3.284C365.418,376.526,512,316.664,512,187.076C512,86.128,452.538,30.814,380.63,32.196z" style="fill: rgb(0, 0, 0);"></path>
                                        </g>
                                        </svg>
                                    </div>
                                    <span class="stamp-chara">
                                        投票
                                    </span>
                                </div>
                                <div class="stamp-box">
                                    <div>
                                        <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="width: 25px; height: 25px;" xml:space="preserve">
                                        <style type="text/css">
                                            .st0{fill:#4B4B4B;}
                                        </style>
                                        <g>
                                            <path class="st0" d="M380.63,32.196C302.639,33.698,264.47,88.893,256,139.075c-8.47-50.182-46.638-105.378-124.63-106.879
                                                C59.462,30.814,0,86.128,0,187.076c0,129.588,146.582,189.45,246.817,286.25c3.489,3.371,2.668,3.284,2.668,3.284
                                                c1.647,2.031,4.014,3.208,6.504,3.208v0.011c0,0,0.006,0,0.011,0c0,0,0.006,0,0.011,0v-0.011c2.489,0,4.856-1.177,6.503-3.208
                                                c0,0-0.821,0.086,2.669-3.284C365.418,376.526,512,316.664,512,187.076C512,86.128,452.538,30.814,380.63,32.196z" style="fill: rgb(0, 0, 0);"></path>
                                        </g>
                                        </svg>
                                    </div>
                                    <span class="stamp-chara">
                                        投票
                                    </span>
                                </div>
                                <div class="stamp-box">
                                    <div>
                                        <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="width: 25px; height: 25px;" xml:space="preserve">
                                        <style type="text/css">
                                            .st0{fill:#4B4B4B;}
                                        </style>
                                        <g>
                                            <path class="st0" d="M380.63,32.196C302.639,33.698,264.47,88.893,256,139.075c-8.47-50.182-46.638-105.378-124.63-106.879
                                                C59.462,30.814,0,86.128,0,187.076c0,129.588,146.582,189.45,246.817,286.25c3.489,3.371,2.668,3.284,2.668,3.284
                                                c1.647,2.031,4.014,3.208,6.504,3.208v0.011c0,0,0.006,0,0.011,0c0,0,0.006,0,0.011,0v-0.011c2.489,0,4.856-1.177,6.503-3.208
                                                c0,0-0.821,0.086,2.669-3.284C365.418,376.526,512,316.664,512,187.076C512,86.128,452.538,30.814,380.63,32.196z" style="fill: rgb(0, 0, 0);"></path>
                                        </g>
                                        </svg>
                                    </div>
                                    <span class="stamp-chara">
                                        投票
                                    </span>
                                </div>
                            </div>
                            
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="nicebtn unnicebtn-unlogin"><span class="nice">★</span>お気に入り</a>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
@endsection