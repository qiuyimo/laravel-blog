<?php

namespace App\Listeners;

use App\Events\ArticleLike;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ArticleLikeHandle
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
     * @param  ArticleLike  $event
     * @return void
     */
    public function handle(ArticleLike $event)
    {
        $article = $event->article;
        $article->like += 1;
        $article->save();
    }
}
