<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\AliquotSumClassifier;
use App\AliquotSumClassifierComputation;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        AliquotSumClassifier::class => AliquotSumClassifierComputation::class
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
