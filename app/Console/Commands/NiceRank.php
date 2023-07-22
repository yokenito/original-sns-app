<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Nice;
use App\Models\User;
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
        $today = new Carbon('today'); 
        $month = $today->month;
        $today_use = substr($today,0,10);
        $monthbegin = substr($today,0,8) . "01";
        
        $users = User::all();
        foreach($users as $user){
            $nicecount = 0;
            $posts = $user->posts()->get();
            foreach($posts as $post){
                $nicecount = $nicecount + count(Nice::where('post_id',$post->id)->whereBetween('created_at', [$monthbegin, $today_use])->get());
            }
            Log::debug($nicecount);
        }
    }
}
