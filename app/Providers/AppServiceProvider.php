<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Banner;
use App\Models\Category;
use App\Models\BusinessSetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;

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
        // view()->composer('*', function ($view) {
        //     $business_setting = new BusinessSetting;
        //     $language_setting = $business_setting->where('type', 'language')->first();

        //     if ($language_setting) {
        //         $languages = $language_setting->value;

        //         $langs = array_reduce(json_decode($languages, true), function ($result, $language) {
        //             if ($language['status'] == 1) {
        //                 $result[$language['name']] = $language['code'];
        //             }
        //             return $result;
        //         }, []);

        //         $view->with('available_locales', $langs);
        //     } else {
        //         $view->with('available_locales', []);
        //     }

        //     $view->with('current_locale', app()->getLocale());
        // });
        view()->composer('*', function ($view) {
            // Retrieve language settings
            $language_setting = Cache::remember('language_setting', 60, function () {
                return BusinessSetting::where('type',
                    'language'
                )->first();
            });

            if ($language_setting) {
                $languages = json_decode($language_setting->value, true) ?? [];
                $langs = array_reduce($languages, function ($result, $language) {
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

            // Automatically generate translations for missing keys
            $locale = App::getLocale();
            $filePath = resource_path("lang/{$locale}.json");

            // Ensure the JSON file exists
            if (!File::exists($filePath)) {
                File::put($filePath, json_encode([], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            }

            $currentTranslations = json_decode(File::get($filePath), true) ?? [];

            // Track used keys and add missing ones
            App::setLocale($locale);
            app('translator')->getLoader()->addNamespace('*', function ($key) use ($currentTranslations, $filePath) {
                if (!array_key_exists($key, $currentTranslations)) {
                    $currentTranslations[$key] = $key; // Default value is the key itself
                    File::put($filePath, json_encode($currentTranslations, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                }
                return $currentTranslations[$key] ?? $key;
            });
        });
        View::composer('*', function ($view) {
            $categories = Category::whereIn('name', ['desktop', 'laptop', 'services', 'accessories',])->where('status', 1)->paginate(10);
            // $categories = Category::where('status', 1)->paginate(10);
            $banners = Banner::orderBy('order', 'desc')->where('status', 1)->paginate(10);
            $brands = Brand::paginate(50);
            $settings = BusinessSetting::whereIn('type', ['contact', 'social_media'])->get();
            $data['contact'] = $settings->where('type', 'contact')->first()->value ?? '[]';
            $data['social_media'] = $settings->where('type', 'social_media')->first()->value ?? '[]';

            $view->with(compact('categories', 'brands', 'banners', 'data'));
        });

        // other view composers and boot logic
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();

        // Gate::before(function ($user, $ability) {
        //     return $user->hasRole('admin') ? true : null;
        // });
        Gate::before(function ($user, $ability) {
            return $user instanceof \App\Models\Admin ? true : null;
        });

    }
}
