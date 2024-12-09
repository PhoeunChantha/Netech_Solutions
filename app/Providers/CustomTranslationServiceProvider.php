<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Translation\Translator;
use Illuminate\Translation\FileLoader;
use Illuminate\Support\Facades\File;

class CustomTranslationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton('translator', function ($app) {
            $loader = $app['translation.loader'];
            $locale = $app['config']['app.locale'];
            $translator = new Translator($loader, $locale);

            $translator->setFallback($app['config']['app.fallback_locale']);

            // Override the translator's `get` method to auto-generate missing keys
            $translator->resolver(function ($key, $replace, $locale) use ($translator) {
                $locale = $locale ?? $translator->getLocale();
                $filePath = resource_path("lang/{$locale}.json");

                // Ensure the JSON file exists
                if (!File::exists($filePath)) {
                    File::put($filePath, json_encode([], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                }

                $translations = json_decode(File::get($filePath), true) ?? [];

                // Add missing key
                if (!array_key_exists($key, $translations)) {
                    $translations[$key] = $key; // Default value is the key itself
                    File::put($filePath, json_encode($translations, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                }

                return $translations[$key] ?? $key;
            });

            return $translator;
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
