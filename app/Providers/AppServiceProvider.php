<?php

namespace App\Providers;

use App\Models\BusinessSetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            $business_setting = new BusinessSetting;
            $language_setting = $business_setting->where('type', 'language')->first();

            if ($language_setting) {
                $languages = $language_setting->value;

                $langs = array_reduce(json_decode($languages, true), function ($result, $language) {
                    if ($language['status'] == 1) {
                        $result[$language['name']] = $language['code'];
                    }
                    return $result;
                }, []);

                $view->with('available_locales', $langs);
            } else {
                $view->with('available_locales', []);
            }

            $view->with('current_locale', app()->getLocale());
        });

        // other view composers and boot logic
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();

        Gate::before(function ($user, $ability) {
            return $user->hasRole('admin') ? true : null;
        });
    }
}
