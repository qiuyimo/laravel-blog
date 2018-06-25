<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Support\Facades\DB;

class ArticleService
{
    /**
     * @param $url
     * @return array
     */
    public function getArticleByUrl($url)
    {
        return Article::query()->where('url', $url)->first()->toArray();
    }

    /**
     * 文章列表.
     */
    public function getArticleList()
    {
        $res = Article::query()->orderByDesc('updated_at')->paginate(10);
        return $res;
    }
}
