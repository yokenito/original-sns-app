<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post_Stamp;
use App\Models\User;
use App\Models\MonthRank;
use App\Models\MonthRank_User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Query\JoinClause;

class ShineRank extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:shinerank';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create monthly shineranking';

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
        
        
        // 面白い数比較
        $usershinecount = User::join('posts','users.id','=','posts.user_id')
            ->join('post_stamp','posts.id','=','post_stamp.post_id')
            ->where('post_stamp.stamp_id','=',2)
            ->select('users.id',User::raw("count(post_stamp.post_id) as count"))
            ->groupBy('users.id')
            ->orderBy('count','desc')
            ->limit(5)->get();
        Log::debug($usershinecount);
        

        // 称号
        for($i=0; $i < 5; $i++){
            $monthrank = new MonthRank();
            $monthrank->monthrank_no = 82 . $today->year . $today->month . 0 . $i+1;
            $monthrank->monthrank_name = $today->year . "年" . $today->month . "月" . "感動数" . $i+1 . "位";
            $monthrank->monthrank_count = $usershinecount[$i]["count"];
            $monthrank->save();

            $monthrank_user = new MonthRank_User();
            $monthrank_user->user_id = $usershinecount[$i]["id"]; 
            $monthrank_user->monthrank_id = $monthrank->id;
            $monthrank_user->save();
        }
    }
}
