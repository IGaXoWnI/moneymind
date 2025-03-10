<?php

namespace App\Console\Commands;

use App\Mail\SubscriptionDeductedMail;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Expense;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

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
    protected $description = 'Process subscriptions and send notifications';

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

            // Send email notification
            Mail::to($expense->user->email)->send(new SubscriptionDeductedMail($expense));
            $this->info("Expense processed and email sent to {$expense->user->email}");
        }
    }
}
