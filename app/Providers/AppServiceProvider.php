<?php

namespace App\Providers;

use App\Services\Interfaces\SuccessStoryServiceInterface;
use App\Services\SuccessStoryService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            SuccessStoryServiceInterface::class,
            SuccessStoryService::class
        );
    }

    public function boot(): void
    {
        //
    }
}
