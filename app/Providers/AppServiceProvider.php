<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Repositories
use App\Repositories\Contracts\SuccessStoryRepositoryInterface;
use App\Repositories\Eloquent\SuccessStoryRepository;

// Services
use App\Services\Interfaces\SuccessStoryServiceInterface;
use App\Services\SuccessStoryService;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Repository Binding
        $this->app->bind(
            SuccessStoryRepositoryInterface::class,
            SuccessStoryRepository::class
        );

        // Service Binding
        $this->app->bind(
            SuccessStoryServiceInterface::class,
            SuccessStoryService::class
        );
    }
}
