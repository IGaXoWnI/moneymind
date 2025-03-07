<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\User;

class wishlist extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:wishlist';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now()->day ;
        $users = User::with('wishlists')->get();
        foreach ($users as $user) {
  
            foreach ($user->wishlists as $wishlist) {
                $cut_day = $wishlist->created_at->day;
                if($today===$cut_day){
                    $user->budget -= $wishlist->monthly_contribution ;
                    $wishlist->saved_amount += $wishlist->monthly_contribution;
                    if($wishlist->saved_amount >= $wishlist->estimated_cost){
                        $wishlist->status = "completed";
                    }
                    $user->save();
                    $wishlist->save();
                    $this->info("the monthly contribution of " . $wishlist->monthly_contribution . "is cut from you budget for " . $wishlist->item_name);


                }
            }
        }
    }
}
