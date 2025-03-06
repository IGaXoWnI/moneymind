<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Expense;
use Illuminate\Console\Command;

class Subscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:subscription';

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

        $expenses = Expense::where('is_fixed', 'yes')->where("next_date", $today)->with("user")->get();

        foreach ($expenses as $expense) {
            $expense->user->budget  -= $expense->amount;
            $expense->user->save();
            $this->info("Expense of " . $expense->amount . " for " . $expense->name . " has been deducted from " . $expense->user->name . " account");
        }
    }   
}
