<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Nice;
use App\Models\User;
use App\Models\MonthRank;
use App\Models\MonthRank_User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Query\JoinClause;

class NiceRank extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:nicerank';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create monthly niceranking';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // 月の期間取得
        $today = new Carbon('today'); 
        $today_use = substr($today,0,10);
        $monthbegin = substr($today,0,8) . "01";
        // return Carbon::now()->startOfMonth()->toDateString();
        
        
        // いいね数比較
        $usernicecount = User::join('posts', function ($join){
            $join->on('users.id','=','posts.user_id')
                ->where('posts.user_id', '=',1);
        })->count();
                        
        Log::debug($usernicecount);


        // $users = User::all();
        // $usernicecount=[];
        // foreach($users as $user){
        //     $nicecount = 0;
        //     $posts = $user->posts()->get();
        //     foreach($posts as $post){
        //         $nicecount = $nicecount + count(Nice::where('post_id',$post->id)->whereBetween('created_at', [$monthbegin, $today_use])->get());
        //         // $nicecount = Nice::where('post_id',$post->id)->whereBetween('created_at', [$monthbegin, $today_use])->sum();
        //         // post idを配列でとってきてwhere(post_id,[])みたいな取り方？
        //         // user -> post ユーザーとポストのテーブルをジョインする　その後にNiceテーブルからカウントさむ
        //         // ジョインジョインでカウントサム（２、３個ジョインする必要がある）
        //     }
        //     // DBの時点でselect sumを行なってその上からlimit5をすれば取れる
        //     $usernicecount[$user->id] = $nicecount;
        //     // $usernicecount[] = array[ "id" => $user->id, "count" => $nicecount];
        //     // $usercount[$i]["id"]
        //     Log::debug($nicecount);
        // }
        // arsort($usernicecount);
        // Log::debug($usernicecount);
        // array_splice($usernicecount,5,count($usernicecount));
        // Log::debug($usernicecount);

        // 称号
        // $i = 1;
        // foreach($usernicecount as $key =>$value){
        //     $monthrank = new MonthRank();
        //     $monthrank->monthrank_no = 91 . $today->year . $today->month . 0 . $i;
        //     $monthrank->monthrank_name = $today->year . "年" . $today->month . "月" . "いいね数" . $i . "位";
        //     $monthrank->monthrank_count = $value;
        //     $monthrank->save();

        //     $monthrank_user = new MonthRank_User();
        //     $monthrank_user->user_id = $key; 
        //     $monthrank_user->monthrank_id = $monthrank->id;
        //     $monthrank_user->save();
        //     if($i == 5){
        //         break;
        //     }else{
        //         $i++;
        //     }
        // }


    }
}
