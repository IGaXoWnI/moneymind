<?php

namespace App\Console\Commands;

use App\Mail\SavingDeductedMail;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

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
    protected $description = 'Process savings and send notification';

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
                $amount = $user->savings->monthly_contribution;
                $user->budget -= $amount;
                $user->save();

                // Send email notification
                Mail::to($user->email)->send(new SavingDeductedMail($amount));
                $this->info("Saving deducted and email sent to {$user->email}");
            }
        }
    }
}
