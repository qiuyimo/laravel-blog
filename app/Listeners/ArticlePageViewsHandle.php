<?php

namespace App\Listeners;

use App\Events\ArticlePageViews;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ArticlePageViewsHandle
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ArticlePageViews  $event
     * @return void
     */
    public function handle(ArticlePageViews $event)
    {
        $article = $event->article;
        $article->views += 1;
        $article->save();
    }
}
