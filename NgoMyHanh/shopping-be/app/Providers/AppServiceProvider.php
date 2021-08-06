<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;    

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
        Response::macro('jsonSuccess', function ($message = null, $code = 200) {
            return response()->json([
                'message' => $message,
                ], 
            $code, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE);
        });

        Response::macro('jsonOk', function ($data = null, $code = 200) {
            return response()->json(
                $data,
                $code,
                ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
        });

        Response::macro('jsonError', function ($message = null, $code = 400) {
            return response()->json([
                'message' => $message,
            ], $code, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE);
        });    
    }
}
