<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\User;


class Saving extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:saving';

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
        $users = User::with('savings')->get();
        $today = Carbon::now()->day;


        foreach ($users as $user) {
            $saving_cut_day = $user->salary_credit_date - 1;
           
    
            if ($today === $saving_cut_day) {
                
                $user->budget -= $user->savings->monthly_contribution;
                $user->save();
            
  
            }
        }
    }
}
