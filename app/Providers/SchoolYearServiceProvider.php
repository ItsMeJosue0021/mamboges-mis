<?php

namespace App\Providers;

use App\Models\SchoolYear;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class SchoolYearServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        View::composer('*', function ($view) {
            
            $current_school_year = SchoolYear::where('is_current', true)->first();
            $schoolYear = $current_school_year->name;
            
            $view->with('schoolYear', $schoolYear);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
