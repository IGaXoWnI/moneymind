<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;


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
    protected $description = 'Command description';

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
        }
    }
}
