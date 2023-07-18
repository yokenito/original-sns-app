<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostImg;
use App\Models\Post_Stamp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->get();
        $rank_users = User::all();
        return view('posts.index',compact('posts','rank_users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $files = $request->file('image');

        if($files != null){
            $user_name = Auth::user()->name;
            $dir = 'photo/' . $user_name;

            foreach($files as $file){
                $file_name = $file->getClientOriginalName();
                $file_path = 'public/' . $dir .'/'. $file_name;

                if(Storage::exists($file_path)){
                    $testerrors = "既に登録済のファイル名です";
                    return redirect()->route('posts.create')->with(compact('testerrors'));
                }
            }
            // どのファイルかを入れる（何個めはと名前）

            $post = new Post();
            $post->title = $request->input('title');
            $post->content = $request->input('content');
            $post->user_id = Auth::id();
            $post->save();

            foreach($files as $file){
                $file_name = $file->getClientOriginalName();
                $file_path = 'public/' . $dir .'/'. $file_name;


                $file->storeAs('public/' . $dir, $file_name);

                $post_img = new PostImg();
                $post_img->post_id = $post->id;
                $post_img->img_name = $file_name;
                $post_img->img_path = 'storage/' . $dir . '/' . $file_name;
                $post_img->save();
            }
            return redirect()->route('posts.create');
        } else{
            $post = new Post();
            $post->title = $request->input('title');
            $post->content = $request->input('content');
            $post->user_id = Auth::id();
            $post->save();
            return redirect()->route('posts.create');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $rank_users = User::all();
        $user = Auth::user();
        return view('posts.show',compact('post','rank_users','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    // いいね
    public function nice($post_id){
        Auth::user()->nice($post_id);
        return ;
    }

    // 面白いスタンプ
    public function funny($post_id){
        if(Post_Stamp::where('post_id',$post_id)->where('stamp_id',1)->where('user_id',Auth::id())->exists()){
            $post_stamp = Post_Stamp::where('post_id',$post_id)->where('stamp_id',1)->where('user_id',Auth::id());
            $post_stamp->delete();
            return ;
        } else{
            $post_stamp_funny = new Post_Stamp();
            $post_stamp_funny->post_id = $post_id;
            $post_stamp_funny->stamp_id = 1;
            $post_stamp_funny->user_id = Auth::id();
            $post_stamp_funny->save();
            return ;
        }      
    }

    // 感動スタンプ
    public function shine($post_id){
        if(Post_Stamp::where('post_id',$post_id)->where('stamp_id',2)->where('user_id',Auth::id())->exists()){
            $post_stamp = Post_Stamp::where('post_id',$post_id)->where('stamp_id',2)->where('user_id',Auth::id());
            $post_stamp->delete();
            return ;
        } else{
            $post_stamp_funny = new Post_Stamp();
            $post_stamp_funny->post_id = $post_id;
            $post_stamp_funny->stamp_id = 2;
            $post_stamp_funny->user_id = Auth::id();
            $post_stamp_funny->save();
            return ;
        }      
    }
}
