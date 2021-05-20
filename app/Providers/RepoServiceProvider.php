<?php

namespace App\Providers;

use App\Repositories\Contracts\BlogArticleRepositoryInterface;
use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Repositories\Contracts\CommentUserRepositoryInterface;
use App\Repositories\Contracts\DiscountRepositoryInterface;
use App\Repositories\Contracts\EmailRepositoryInterface;
use App\Repositories\Contracts\SidebarBannerRepositoryInterface;
use App\Repositories\Contracts\SingleReviewRepositoryInterface;
use App\Repositories\Eloquent\BlogArticleRepository;
use App\Repositories\Eloquent\CommentRepository;
use App\Repositories\Eloquent\CommentUserRepository;
use App\Repositories\Eloquent\DiscountRepository;
use App\Repositories\Eloquent\EmailRepository;
use App\Repositories\Eloquent\SidebarBannerRepository;
use App\Repositories\Eloquent\SingleReviewRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
/**
 * Class RepoServiceProvider
 * @package App\Providers
 */
class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SingleReviewRepositoryInterface::class, SingleReviewRepository::class);
        $this->app->bind(DiscountRepositoryInterface::class, DiscountRepository::class);
        $this->app->bind(BlogArticleRepositoryInterface::class, BlogArticleRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(CommentUserRepositoryInterface::class, CommentUserRepository::class);
        $this->app->bind(EmailRepositoryInterface::class, EmailRepository::class);
        $this->app->bind(SidebarBannerRepositoryInterface::class, SidebarBannerRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
