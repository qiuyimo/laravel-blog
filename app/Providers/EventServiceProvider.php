<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        // 'App\Events\Event' => [
        //     'App\Listeners\EventListener',
        // ],

        // 文章浏览量
        'App\Events\ArticlePageViews' => [
            'App\Listeners\ArticlePageViewsHandle',
        ],

        // 文章点赞
        'App\Events\ArticleLike' => [
            'App\Listeners\ArticleLikeHandle',
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
