<?php

namespace App\Service\Search;

use Illuminate\Support\ServiceProvider;

/**
 * Class SearchServiceProvider
 * @package App\Service\Search
 */
class SearchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SearchServiceInterface::class, SearchService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}