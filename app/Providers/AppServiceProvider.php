<?php

namespace App\Providers;

use App\Models\Config\App;
use App\Models\TahunAjar;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Force reload .env file to override system environment variables
        if (!isset($_SERVER['LARAVEL_LOAD_ENV']) && file_exists(base_path('.env'))) {
            $_SERVER['LARAVEL_LOAD_ENV'] = true;

            $lines = file(base_path('.env'), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos($line, '=') !== false && !str_starts_with(trim($line), '#')) {
                    list($key, $value) = explode('=', $line, 2);
                    $key = trim($key);
                    $value = trim($value);

                    // Remove quotes if present
                    if ((startsWith($value, '"') && endsWith($value, '"')) ||
                        (startsWith($value, "'") && endsWith($value, "'"))) {
                        $value = substr($value, 1, -1);
                    }

                    // Set the environment variable
                    putenv("$key=$value");
                    $_ENV[$key] = $value;
                    $_SERVER[$key] = $value;
                }
            }
        }

        // Check for database connection and tables safely
        if (class_exists('App\Models\Config\App') && class_exists('App\Models\TahunAjar')) {
            try {
                // Test database connection first
                \DB::connection()->getPdo();

                if (\Schema::hasTable('conf_app')) {
                    $data = App::first();
                    View::share('appData', $data);
                } else {
                    View::share('appData', null);
                }

                if (\Schema::hasTable('tb_tahun_ajar')) {
                    $ta = TahunAjar::where('ta_status', 1)->first();
                    session()->put('ta_id', @$ta->ta_id ?? date('Y'));
                    session()->put('ta_kode', @$ta->ta_kode ?? date('Y').'1');
                } else {
                    session()->put('ta_id', date('Y'));
                    session()->put('ta_kode', date('Y').'1');
                }
            } catch (\Exception $e) {
                // Fail silently if database isn't available yet
                View::share('appData', null);
                session()->put('ta_id', date('Y'));
                session()->put('ta_kode', date('Y').'1');

                // Log the error for debugging purposes
                \Log::warning('Database connection failed in AppServiceProvider: ' . $e->getMessage());
            }
        } else {
            // Set default values when models are not found
            View::share('appData', null);
            session()->put('ta_id', date('Y'));
            session()->put('ta_kode', date('Y').'1');
        }
    }
}

if (!function_exists('startsWith')) {
    function startsWith($haystack, $needle) {
        return substr($haystack, 0, strlen($needle)) === $needle;
    }
}

if (!function_exists('endsWith')) {
    function endsWith($haystack, $needle) {
        return substr($haystack, -strlen($needle)) === $needle;
    }
}
