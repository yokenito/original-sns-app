<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Nice;
use App\Models\User;
use App\Models\MonthRank;
use App\Models\MonthRank_User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

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
        
        // いいね数比較
        $users = User::all();
        foreach($users as $user){
            $nicecount = 0;
            $posts = $user->posts()->get();
            foreach($posts as $post){
                $nicecount = $nicecount + count(Nice::where('post_id',$post->id)->whereBetween('created_at', [$monthbegin, $today_use])->get());
            }
            // DBの時点でselect sumを行なってその上からlimit5をすれば取れる
            // 配列に追加していけばいいじゃん　ユーザーとナイスカウントの連想配列ならそのユーザーを取れる
            Log::debug($nicecount);
        }

        // 称号
        for($i=1; $i<=5; $i++){
            // $monthrank = new MonthRank();
            // $monthrank->monthrank_no = 91 . $today->year . $today->month . 0 . $i;
            // $monthrank->monthrank_name = $today->year . "年" . $today->month . "月" . "いいね数" . $i . "位";
            // $monthrank->monthrank_count = 0;
            // $monthrank->save();

            // $monthrank_user = new User_Usertitle();
            // $monthrank_user->user_id = 0; 
            // $monthrank_user->monthrank_id = $monthrank->id;
            // $monthrank_user->save();
        }


    }
}
