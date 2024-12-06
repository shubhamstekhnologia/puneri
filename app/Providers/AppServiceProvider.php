<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        // Log the MongoDB-related environment variables
        try {
            $dbConnection = env('DB_CONNECTION');
            $dbHost = env('MONGO_DB_HOST');
            $dbDatabase = env('MONGO_DB_DATABASE');
            $dbUsername = env('MONGO_DB_USERNAME');
            $dbPassword = env('MONGO_DB_PASSWORD');

            // Log the variables
            Log::info('MongoDB Environment Variables:', [
                'DB_CONNECTION' => $dbConnection,
                'DB_HOST'       => $dbHost,
                'DB_DATABASE'   => $dbDatabase,
                'DB_USERNAME'   => $dbUsername,
                'DB_PASSWORD'   => $dbPassword,
            ]);

            Log::info('Environment variables logged successfully.');
        } catch (\Exception $e) {
            // Log any exceptions
            Log::error('Failed to log environment variables: ' . $e->getMessage());
        }
    }
}
