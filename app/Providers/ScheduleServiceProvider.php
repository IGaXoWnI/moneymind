<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ScheduleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }



    protected function configureSchedule() : void{
        app()->booted(function(){
            $schedule = app()->make(Schedule::class);
            $schedule->call(function(){
                
            })->daily()-at('11:00');
        });
    } 
}
