<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

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
        $this->app->singleton(ResponseFactory::class, function () {
            return new \Laravel\Lumen\Http\ResponseFactory();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        $this->makeMicros();
    }

    /**
     * this function adds some custom functions to laravel`s request facade
     * to make a fixed response for all of apis
     */
    private function makeMicros()
    {
        Response::macro('error', function (array $errors = [], string $message = 'ERROR', int $status = 400) {
            return Response::make([
                'status' => 0,
                'errors' => $errors,
                'message' => $message,
            ], $status);
        });

        Response::macro('success', function (array $data = [], string $message = 'SUCCESS', int $status = 200) {
            return Response::make([
                'status' => 1,
                'data' => $data,
                'message' => $message,
            ], $status);
        });
    }
}
