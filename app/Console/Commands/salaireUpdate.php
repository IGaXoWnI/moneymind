<?php

namespace App\Console\Commands;

use App\Mail\SalaryUpdatedMail;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class salaireUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:salaire-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update user salaries and send notification';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now()->day;

        $users = User::where("salary_credit_date", $today)->get();

        foreach ($users as $user) {
            $user->monthly_salary += $user->monthly_salary;
            $user->save();

            // Send email notification
            Mail::to($user->email)->send(new SalaryUpdatedMail($user->monthly_salary));
            $this->info("Salary updated and email sent to {$user->email}");
        }
    }
}
