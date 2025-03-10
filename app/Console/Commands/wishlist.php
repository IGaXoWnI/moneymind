<?php

namespace App\Console\Commands;

use App\Mail\WishlistDeductedMail;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

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
    protected $description = 'Process wishlist contributions and send notifications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now()->day;
        $users = User::with('wishlists')->get();

        foreach ($users as $user) {
            foreach ($user->wishlists as $wishlist) {
                $cut_day = $wishlist->created_at->day;
                if ($today === $cut_day) {
                    $user->budget -= $wishlist->monthly_contribution;
                    $wishlist->saved_amount += $wishlist->monthly_contribution;
                    if ($wishlist->saved_amount >= $wishlist->estimated_cost) {
                        $wishlist->status = "completed";
                    }

                    $user->save();
                    $wishlist->save();

                    // Send email notification
                    Mail::to($user->email)->send(new WishlistDeductedMail($wishlist, $wishlist->monthly_contribution));
                    $this->info("Wishlist contribution processed and email sent to {$user->email}");
                }
            }
        }
    }
}
