<?php

namespace App\Services;

use App\Models\Article;
use App\Models\ArticleCategory;
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
     * 关联查询.
     */
    public function getArticleList()
    {
        // $res = Article::with('hasManyTag')->with(['hasManyCate' => function ($query) {
        //     $query->with('belongsToCategory');
        // }])->orderByDesc('updated_at')->limit(2)->get()->toArray();
        // dump($res);
        // die;

        $res = Article::with('hasManyTag')->with(['hasManyCate' => function ($query) {
            $query->with('belongsToCategory');
        }])->orderByDesc('updated_at')->paginate(10);

        return $res;
    }
}
