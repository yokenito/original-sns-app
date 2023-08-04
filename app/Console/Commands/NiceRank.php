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
        $usernicecount = User::join('posts','users.id','=','posts.user_id')
            ->join('nices','posts.id','=','nices.post_id')
            ->select('users.id',User::raw("count(nices.post_id) as count"))
            ->groupBy('users.id')
            ->orderBy('count','desc')
            ->limit(5)->get();
        Log::debug($usernicecount);




        // $nicecount = $nicecount + count(Nice::where('post_id',$post->id)->whereBetween('created_at', [$monthbegin, $today_use])->get())
        //     // $usernicecount[] = array[ "id" => $user->id, "count" => $nicecount];
        //     // $usercount[$i]["id"]
        

        // 称号
        for($i=0; $i < 5; $i++){
            $monthrank = new MonthRank();
            $monthrank->monthrank_no = 91 . $today->year . $today->month . 0 . $i+1;
            $monthrank->monthrank_name = $today->year . "年" . $today->month . "月" . "いいね数" . $i+1 . "位";
            $monthrank->monthrank_count = $usernicecount[$i]["count"];
            $monthrank->save();

            $monthrank_user = new MonthRank_User();
            $monthrank_user->user_id = $usernicecount[$i]["id"]; 
            $monthrank_user->monthrank_id = $monthrank->id;
            $monthrank_user->save();
        }


    }
}
