@extends('layouts.app')

@push('scripts')
    <script src="{{asset('/js/script.js')}}"></script>
@endpush

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
                        <div class="d-flex">  

                            <!-- いいねボタン -->
                            <div class="stamp-box">
                                @if($user->isNice($post->id))
                                    <button onclick="nice({{$post->id}},this)" class="nice-btn active">
                                        <div class="d-flex">
                                            <div>
                                                <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="width: 25px; height: 25px; opacity: 1;" xml:space="preserve">
                                                <style type="text/css">
                                                    .st1{fill:rgb(255, 111, 111);}
                                                </style>
                                                <g>
                                                    <path class="st1" d="M380.63,32.196C302.639,33.698,264.47,88.893,256,139.075c-8.47-50.182-46.638-105.378-124.63-106.879
                                                        C59.462,30.814,0,86.128,0,187.076c0,129.588,146.582,189.45,246.817,286.25c3.489,3.371,2.668,3.284,2.668,3.284
                                                        c1.647,2.031,4.014,3.208,6.504,3.208v0.011c0,0,0.006,0,0.011,0c0,0,0.006,0,0.011,0v-0.011c2.489,0,4.856-1.177,6.503-3.208
                                                        c0,0-0.821,0.086,2.669-3.284C365.418,376.526,512,316.664,512,187.076C512,86.128,452.538,30.814,380.63,32.196z"></path>
                                                </g>
                                                </svg>
                                            </div>
                                            <span class="stamp-chara">
                                                投票
                                            </span>
                                        </div>
                                    </button>
                                    <button onclick="nice({{$post->id}},this)" class="nice-btn nonactive" style="display: none;">
                                        <div class="d-flex">
                                            <div>
                                                <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="width: 25px; height: 25px; opacity: 1;" xml:space="preserve">
                                                <style type="text/css">
                                                    .st0{fill:#4B4B4B;}
                                                </style>
                                                <g>
                                                    <path class="st0" d="M380.63,32.196C302.639,33.698,264.47,88.893,256,139.075c-8.47-50.182-46.638-105.378-124.63-106.879
                                                        C59.462,30.814,0,86.128,0,187.076c0,129.588,146.582,189.45,246.817,286.25c3.489,3.371,2.668,3.284,2.668,3.284
                                                        c1.647,2.031,4.014,3.208,6.504,3.208v0.011c0,0,0.006,0,0.011,0c0,0,0.006,0,0.011,0v-0.011c2.489,0,4.856-1.177,6.503-3.208
                                                        c0,0-0.821,0.086,2.669-3.284C365.418,376.526,512,316.664,512,187.076C512,86.128,452.538,30.814,380.63,32.196z" style="fill: rgb(75, 75, 75);"></path>
                                                </g>
                                                </svg>
                                            </div>
                                            <span class="stamp-chara">
                                                投票
                                            </span>
                                        </div>
                                    </button>
                                @else
                                    <button onclick="nice({{$post->id}},this)" class="nice-btn nonactive">
                                        <div class="d-flex">
                                            <div>
                                                <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="width: 25px; height: 25px; opacity: 1;" xml:space="preserve">
                                                <style type="text/css">
                                                    .st0{fill:#4B4B4B;}
                                                </style>
                                                <g>
                                                    <path class="st0" d="M380.63,32.196C302.639,33.698,264.47,88.893,256,139.075c-8.47-50.182-46.638-105.378-124.63-106.879
                                                        C59.462,30.814,0,86.128,0,187.076c0,129.588,146.582,189.45,246.817,286.25c3.489,3.371,2.668,3.284,2.668,3.284
                                                        c1.647,2.031,4.014,3.208,6.504,3.208v0.011c0,0,0.006,0,0.011,0c0,0,0.006,0,0.011,0v-0.011c2.489,0,4.856-1.177,6.503-3.208
                                                        c0,0-0.821,0.086,2.669-3.284C365.418,376.526,512,316.664,512,187.076C512,86.128,452.538,30.814,380.63,32.196z" style="fill: rgb(75, 75, 75);"></path>
                                                </g>
                                                </svg>
                                            </div>
                                            <span class="stamp-chara">
                                                投票
                                            </span>
                                        </div>
                                    </button>
                                    <button onclick="nice({{$post->id}},this)" class="nice-btn active" style="display: none;">
                                        <div class="d-flex">
                                            <div>
                                                <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="width: 25px; height: 25px; opacity: 1;" xml:space="preserve">
                                                <style type="text/css">
                                                    .st0{fill:#4B4B4B;}
                                                </style>
                                                <g>
                                                    <path class="st0" d="M380.63,32.196C302.639,33.698,264.47,88.893,256,139.075c-8.47-50.182-46.638-105.378-124.63-106.879
                                                        C59.462,30.814,0,86.128,0,187.076c0,129.588,146.582,189.45,246.817,286.25c3.489,3.371,2.668,3.284,2.668,3.284
                                                        c1.647,2.031,4.014,3.208,6.504,3.208v0.011c0,0,0.006,0,0.011,0c0,0,0.006,0,0.011,0v-0.011c2.489,0,4.856-1.177,6.503-3.208
                                                        c0,0-0.821,0.086,2.669-3.284C365.418,376.526,512,316.664,512,187.076C512,86.128,452.538,30.814,380.63,32.196z" style="fill: rgb(255, 111, 111);"></path>
                                                </g>
                                                </svg>
                                            </div>
                                            <span class="stamp-chara">
                                                投票
                                            </span>
                                        </div>
                                    </button>
                                @endif
                            </div>

                            <!-- 面白いボタン -->
                            <div class="stamp-box">
                            @if($post->isfunnyStamp($user->id))
                                <button onclick="funny({{$post->id}},this)" class="fun-active">
                                    <div class="d-flex">
                                        <div>
                                            <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="512px" height="512px" viewBox="0 0 512 512" style="width: 25px; height: 25px; opacity: 1;" xml:space="preserve">
                                            <style type="text/css">

                                                .st0{fill:#4B4B4B;}

                                            </style>
                                            <g>
                                                <path class="st0" d="M460.195,140.438C420.305,82.344,343.164,0,343.164,0l-96.938,334.563
                                                    c-22.531-22.984-55.922-37.609-93.25-37.609c-67.859,0-122.875,48.141-122.875,107.516C30.102,463.859,85.117,512,152.977,512
                                                    c62.672,0,114.281-41.078,121.828-94.125l69.078-267.938c85.578,92.156,34.391,155.797,10.984,173.344
                                                    C448.492,299.875,519.43,226.734,460.195,140.438z" style="fill: rgb(131, 255, 92);"></path>
                                            </g>
                                            </svg>
                                        </div>
                                        <span class="stamp-chara">
                                            面白い
                                        </span>
                                    </div>
                                </button>
                                <button onclick="funny({{$post->id}},this)" class="fun-nonactive" style="display: none;">
                                    <div class="d-flex">
                                        <div>
                                            <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="512px" height="512px" viewBox="0 0 512 512" style="width: 25px; height: 25px; opacity: 1;" xml:space="preserve">
                                            <style type="text/css">

                                                .st0{fill:#4B4B4B;}

                                            </style>
                                            <g>
                                                <path class="st0" d="M460.195,140.438C420.305,82.344,343.164,0,343.164,0l-96.938,334.563
                                                    c-22.531-22.984-55.922-37.609-93.25-37.609c-67.859,0-122.875,48.141-122.875,107.516C30.102,463.859,85.117,512,152.977,512
                                                    c62.672,0,114.281-41.078,121.828-94.125l69.078-267.938c85.578,92.156,34.391,155.797,10.984,173.344
                                                    C448.492,299.875,519.43,226.734,460.195,140.438z"></path>
                                            </g>
                                            </svg>
                                        </div>
                                        <span class="stamp-chara">
                                            面白い
                                        </span>
                                    </div>
                                </button>
                            @else
                                <button onclick="funny({{$post->id}},this)" class="fun-nonactive">
                                    <div class="d-flex">
                                        <div>
                                            <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="512px" height="512px" viewBox="0 0 512 512" style="width: 25px; height: 25px; opacity: 1;" xml:space="preserve">
                                            <style type="text/css">

                                                .st0{fill:#4B4B4B;}

                                            </style>
                                            <g>
                                                <path class="st0" d="M460.195,140.438C420.305,82.344,343.164,0,343.164,0l-96.938,334.563
                                                    c-22.531-22.984-55.922-37.609-93.25-37.609c-67.859,0-122.875,48.141-122.875,107.516C30.102,463.859,85.117,512,152.977,512
                                                    c62.672,0,114.281-41.078,121.828-94.125l69.078-267.938c85.578,92.156,34.391,155.797,10.984,173.344
                                                    C448.492,299.875,519.43,226.734,460.195,140.438z"></path>
                                            </g>
                                            </svg>
                                        </div>
                                        <span class="stamp-chara">
                                            面白い
                                        </span>
                                    </div>
                                </button>
                                <button onclick="funny({{$post->id}},this)" class="fun-active" style="display: none;">
                                    <div class="d-flex">
                                        <div>
                                            <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="512px" height="512px" viewBox="0 0 512 512" style="width: 25px; height: 25px; opacity: 1;" xml:space="preserve">
                                            <style type="text/css">

                                                .st0{fill:#4B4B4B;}

                                            </style>
                                            <g>
                                                <path class="st0" d="M460.195,140.438C420.305,82.344,343.164,0,343.164,0l-96.938,334.563
                                                    c-22.531-22.984-55.922-37.609-93.25-37.609c-67.859,0-122.875,48.141-122.875,107.516C30.102,463.859,85.117,512,152.977,512
                                                    c62.672,0,114.281-41.078,121.828-94.125l69.078-267.938c85.578,92.156,34.391,155.797,10.984,173.344
                                                    C448.492,299.875,519.43,226.734,460.195,140.438z" style="fill: rgb(131, 255, 92);"></path>
                                            </g>
                                            </svg>
                                        </div>
                                        <span class="stamp-chara">
                                            面白い
                                        </span>
                                    </div>
                                </button>
                            @endif
                            </div>

                            <!-- 感動ボタン -->
                            <div class="stamp-box">
                            @if($post->isshineStamp($user->id))
                                <button onclick="shine({{$post->id}},this)" class="shine-active">
                                    <div class="d-flex">
                                        <div>
                                            <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="width: 25px; height: 25px; opacity: 1;" xml:space="preserve">
                                            <style type="text/css">
                                                .st0{fill:#4B4B4B;}
                                            </style>
                                            <g>
                                                <path class="st0" d="M247.355,106.9C222.705,82.241,205.833,39.18,197.46,0c-8.386,39.188-25.24,82.258-49.899,106.917
                                                    c-24.65,24.642-67.724,41.514-106.896,49.904c39.188,8.373,82.254,25.235,106.904,49.895c24.65,24.65,41.522,67.72,49.908,106.9
                                                    c8.373-39.188,25.24-82.258,49.886-106.917c24.65-24.65,67.724-41.514,106.896-49.904
                                                    C315.08,148.422,272.014,131.551,247.355,106.9z" style="fill: rgb(239, 255, 0);"></path>
                                                <path class="st0" d="M407.471,304.339c-14.714-14.721-24.81-40.46-29.812-63.864c-5.011,23.404-15.073,49.142-29.803,63.872
                                                    c-14.73,14.714-40.464,24.801-63.864,29.812c23.408,5.01,49.134,15.081,63.864,29.811c14.73,14.722,24.81,40.46,29.82,63.864
                                                    c5.001-23.413,15.081-49.142,29.802-63.872c14.722-14.722,40.46-24.802,63.856-29.82
                                                    C447.939,329.14,422.201,319.061,407.471,304.339z" style="fill: rgb(239, 255, 0);"></path>
                                                <path class="st0" d="M146.352,354.702c-4.207,19.648-12.655,41.263-25.019,53.626c-12.362,12.354-33.968,20.82-53.613,25.027
                                                    c19.645,4.216,41.251,12.656,53.613,25.027c12.364,12.362,20.829,33.96,25.036,53.618c4.203-19.658,12.655-41.255,25.023-53.626
                                                    c12.354-12.362,33.964-20.82,53.605-25.035c-19.64-4.2-41.251-12.656-53.613-25.019
                                                    C159.024,395.966,150.555,374.351,146.352,354.702z" style="fill: rgb(239, 255, 0);"></path>
                                            </g>
                                            </svg>
                                        </div>
                                        <span class="stamp-chara">
                                            感動
                                        </span>
                                    </div>
                                </button>
                                <button onclick="shine({{$post->id}},this)" class="shine-nonactive" style="display: none;">
                                    <div class="d-flex">
                                        <div>
                                            <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="width: 25px; height: 25px; opacity: 1;" xml:space="preserve">
                                            <style type="text/css">
                                                .st0{fill:#4B4B4B;}
                                            </style>
                                            <g>
                                                <path class="st0" d="M247.355,106.9C222.705,82.241,205.833,39.18,197.46,0c-8.386,39.188-25.24,82.258-49.899,106.917
                                                    c-24.65,24.642-67.724,41.514-106.896,49.904c39.188,8.373,82.254,25.235,106.904,49.895c24.65,24.65,41.522,67.72,49.908,106.9
                                                    c8.373-39.188,25.24-82.258,49.886-106.917c24.65-24.65,67.724-41.514,106.896-49.904
                                                    C315.08,148.422,272.014,131.551,247.355,106.9z"></path>
                                                <path class="st0" d="M407.471,304.339c-14.714-14.721-24.81-40.46-29.812-63.864c-5.011,23.404-15.073,49.142-29.803,63.872
                                                    c-14.73,14.714-40.464,24.801-63.864,29.812c23.408,5.01,49.134,15.081,63.864,29.811c14.73,14.722,24.81,40.46,29.82,63.864
                                                    c5.001-23.413,15.081-49.142,29.802-63.872c14.722-14.722,40.46-24.802,63.856-29.82
                                                    C447.939,329.14,422.201,319.061,407.471,304.339z"></path>
                                                <path class="st0" d="M146.352,354.702c-4.207,19.648-12.655,41.263-25.019,53.626c-12.362,12.354-33.968,20.82-53.613,25.027
                                                    c19.645,4.216,41.251,12.656,53.613,25.027c12.364,12.362,20.829,33.96,25.036,53.618c4.203-19.658,12.655-41.255,25.023-53.626
                                                    c12.354-12.362,33.964-20.82,53.605-25.035c-19.64-4.2-41.251-12.656-53.613-25.019
                                                    C159.024,395.966,150.555,374.351,146.352,354.702z"></path>
                                            </g>
                                            </svg>
                                        </div>
                                        <span class="stamp-chara">
                                            感動
                                        </span>
                                    </div>
                                </button>
                            @else
                                <button onclick="shine({{$post->id}},this)" class="shine-nonactive">
                                    <div class="d-flex">
                                        <div>
                                            <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="width: 25px; height: 25px; opacity: 1;" xml:space="preserve">
                                            <style type="text/css">
                                                .st0{fill:#4B4B4B;}
                                            </style>
                                            <g>
                                                <path class="st0" d="M247.355,106.9C222.705,82.241,205.833,39.18,197.46,0c-8.386,39.188-25.24,82.258-49.899,106.917
                                                    c-24.65,24.642-67.724,41.514-106.896,49.904c39.188,8.373,82.254,25.235,106.904,49.895c24.65,24.65,41.522,67.72,49.908,106.9
                                                    c8.373-39.188,25.24-82.258,49.886-106.917c24.65-24.65,67.724-41.514,106.896-49.904
                                                    C315.08,148.422,272.014,131.551,247.355,106.9z"></path>
                                                <path class="st0" d="M407.471,304.339c-14.714-14.721-24.81-40.46-29.812-63.864c-5.011,23.404-15.073,49.142-29.803,63.872
                                                    c-14.73,14.714-40.464,24.801-63.864,29.812c23.408,5.01,49.134,15.081,63.864,29.811c14.73,14.722,24.81,40.46,29.82,63.864
                                                    c5.001-23.413,15.081-49.142,29.802-63.872c14.722-14.722,40.46-24.802,63.856-29.82
                                                    C447.939,329.14,422.201,319.061,407.471,304.339z"></path>
                                                <path class="st0" d="M146.352,354.702c-4.207,19.648-12.655,41.263-25.019,53.626c-12.362,12.354-33.968,20.82-53.613,25.027
                                                    c19.645,4.216,41.251,12.656,53.613,25.027c12.364,12.362,20.829,33.96,25.036,53.618c4.203-19.658,12.655-41.255,25.023-53.626
                                                    c12.354-12.362,33.964-20.82,53.605-25.035c-19.64-4.2-41.251-12.656-53.613-25.019
                                                    C159.024,395.966,150.555,374.351,146.352,354.702z"></path>
                                            </g>
                                            </svg>
                                        </div>
                                        <span class="stamp-chara">
                                            感動
                                        </span>
                                    </div>
                                </button>
                                <button onclick="shine({{$post->id}},this)" class="shine-active" style="display: none;">
                                    <div class="d-flex">
                                        <div>
                                            <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="width: 25px; height: 25px; opacity: 1;" xml:space="preserve">
                                            <style type="text/css">
                                                .st0{fill:#4B4B4B;}
                                            </style>
                                            <g>
                                                <path class="st0" d="M247.355,106.9C222.705,82.241,205.833,39.18,197.46,0c-8.386,39.188-25.24,82.258-49.899,106.917
                                                    c-24.65,24.642-67.724,41.514-106.896,49.904c39.188,8.373,82.254,25.235,106.904,49.895c24.65,24.65,41.522,67.72,49.908,106.9
                                                    c8.373-39.188,25.24-82.258,49.886-106.917c24.65-24.65,67.724-41.514,106.896-49.904
                                                    C315.08,148.422,272.014,131.551,247.355,106.9z" style="fill: rgb(239, 255, 0);"></path>
                                                <path class="st0" d="M407.471,304.339c-14.714-14.721-24.81-40.46-29.812-63.864c-5.011,23.404-15.073,49.142-29.803,63.872
                                                    c-14.73,14.714-40.464,24.801-63.864,29.812c23.408,5.01,49.134,15.081,63.864,29.811c14.73,14.722,24.81,40.46,29.82,63.864
                                                    c5.001-23.413,15.081-49.142,29.802-63.872c14.722-14.722,40.46-24.802,63.856-29.82
                                                    C447.939,329.14,422.201,319.061,407.471,304.339z" style="fill: rgb(239, 255, 0);"></path>
                                                <path class="st0" d="M146.352,354.702c-4.207,19.648-12.655,41.263-25.019,53.626c-12.362,12.354-33.968,20.82-53.613,25.027
                                                    c19.645,4.216,41.251,12.656,53.613,25.027c12.364,12.362,20.829,33.96,25.036,53.618c4.203-19.658,12.655-41.255,25.023-53.626
                                                    c12.354-12.362,33.964-20.82,53.605-25.035c-19.64-4.2-41.251-12.656-53.613-25.019
                                                    C159.024,395.966,150.555,374.351,146.352,354.702z" style="fill: rgb(239, 255, 0);"></path>
                                            </g>
                                            </svg>
                                        </div>
                                        <span class="stamp-chara">
                                            感動
                                        </span>
                                    </div>
                                </button>
                            @endif
                            </div>
                        </div>
                    @else
                        <div class="d-flex">
                            <div class="stamp-box">
                                <a href="{{ route('login') }}">
                                    <div class="d-flex">
                                        <div>
                                            <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="width: 25px; height: 25px; opacity: 1;" xml:space="preserve">
                                            <style type="text/css">
                                                .st0{fill:#4B4B4B;}
                                            </style>
                                            <g>
                                                <path class="st0" d="M380.63,32.196C302.639,33.698,264.47,88.893,256,139.075c-8.47-50.182-46.638-105.378-124.63-106.879
                                                    C59.462,30.814,0,86.128,0,187.076c0,129.588,146.582,189.45,246.817,286.25c3.489,3.371,2.668,3.284,2.668,3.284
                                                    c1.647,2.031,4.014,3.208,6.504,3.208v0.011c0,0,0.006,0,0.011,0c0,0,0.006,0,0.011,0v-0.011c2.489,0,4.856-1.177,6.503-3.208
                                                    c0,0-0.821,0.086,2.669-3.284C365.418,376.526,512,316.664,512,187.076C512,86.128,452.538,30.814,380.63,32.196z" style="fill: rgb(75, 75, 75);"></path>
                                            </g>
                                            </svg>
                                        </div>
                                        <span class="stamp-chara">
                                            投票
                                        </span>
                                    </div>
                                </a>
                            </div>

                            <div class="stamp-box">
                                <a href="{{ route('login') }}">
                                    <div class="d-flex">
                                        <div>
                                            <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="512px" height="512px" viewBox="0 0 512 512" style="width: 25px; height: 25px; opacity: 1;" xml:space="preserve">
                                            <style type="text/css">

                                                .st0{fill:#4B4B4B;}

                                            </style>
                                            <g>
                                                <path class="st0" d="M460.195,140.438C420.305,82.344,343.164,0,343.164,0l-96.938,334.563
                                                    c-22.531-22.984-55.922-37.609-93.25-37.609c-67.859,0-122.875,48.141-122.875,107.516C30.102,463.859,85.117,512,152.977,512
                                                    c62.672,0,114.281-41.078,121.828-94.125l69.078-267.938c85.578,92.156,34.391,155.797,10.984,173.344
                                                    C448.492,299.875,519.43,226.734,460.195,140.438z"></path>
                                            </g>
                                            </svg>
                                        </div>
                                        <span class="stamp-chara">
                                            面白い
                                        </span>
                                    </div>
                                </a>
                            </div>

                            <div class="stamp-box">
                                <a href="{{ route('login') }}">
                                    <div class="d-flex">
                                        <div>
                                            <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="width: 25px; height: 25px; opacity: 1;" xml:space="preserve">
                                            <style type="text/css">
                                                .st0{fill:#4B4B4B;}
                                            </style>
                                            <g>
                                                <path class="st0" d="M247.355,106.9C222.705,82.241,205.833,39.18,197.46,0c-8.386,39.188-25.24,82.258-49.899,106.917
                                                    c-24.65,24.642-67.724,41.514-106.896,49.904c39.188,8.373,82.254,25.235,106.904,49.895c24.65,24.65,41.522,67.72,49.908,106.9
                                                    c8.373-39.188,25.24-82.258,49.886-106.917c24.65-24.65,67.724-41.514,106.896-49.904
                                                    C315.08,148.422,272.014,131.551,247.355,106.9z"></path>
                                                <path class="st0" d="M407.471,304.339c-14.714-14.721-24.81-40.46-29.812-63.864c-5.011,23.404-15.073,49.142-29.803,63.872
                                                    c-14.73,14.714-40.464,24.801-63.864,29.812c23.408,5.01,49.134,15.081,63.864,29.811c14.73,14.722,24.81,40.46,29.82,63.864
                                                    c5.001-23.413,15.081-49.142,29.802-63.872c14.722-14.722,40.46-24.802,63.856-29.82
                                                    C447.939,329.14,422.201,319.061,407.471,304.339z"></path>
                                                <path class="st0" d="M146.352,354.702c-4.207,19.648-12.655,41.263-25.019,53.626c-12.362,12.354-33.968,20.82-53.613,25.027
                                                    c19.645,4.216,41.251,12.656,53.613,25.027c12.364,12.362,20.829,33.96,25.036,53.618c4.203-19.658,12.655-41.255,25.023-53.626
                                                    c12.354-12.362,33.964-20.82,53.605-25.035c-19.64-4.2-41.251-12.656-53.613-25.019
                                                    C159.024,395.966,150.555,374.351,146.352,354.702z"></path>
                                            </g>
                                            </svg>
                                        </div>
                                        <span class="stamp-chara">
                                            感動
                                        </span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
@endsection