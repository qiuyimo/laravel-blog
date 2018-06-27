<?php

namespace App\Services;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Psr\SimpleCache\InvalidArgumentException;

class ArticleService
{
    /**
     * @param string $url
     * @param int $createTime
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function getArticleByUrl(string $url, int $createTime)
    {
        return Article::query()->where('status', 1)->where('url', $url)->where('created_at', date("Y-m-d H:i:s", $createTime))->firstOrFail([
            'id', 'title', 'url', 'description', 'keywords', 'weight', 'like', 'html', 'created_at', 'updated_at', 'status', 'views', 'summary'
        ]);
    }

    /**
     * 文章列表.
     * 关联查询.
     */
    public function getArticleList()
    {
        // $res = Article::with('hasManyTag')->with(['hasManyCate' => function ($query) {
        //     $query->with('belongsToCategory');
        // }])->orderByDesc('created_at')->limit(2)->get()->toArray();
        // dump($res);
        // die;

        $res = Article::with('hasManyTag')->with(['hasManyCate' => function ($query) {
            $query->with('belongsToCategory');
        }])->orderByDesc('created_at')->paginate(10);

        return $res;
    }

    /**
     * 根据 articleId, 获取上篇文章和下篇文章.
     * @param $id
     * @return array
     */
    public function getPrevAndNext($id)
    {
        $prev = Article::query()->where('id', '<', $id)->orderBy('id', 'desc')->first()->toArray();
        $next = Article::query()->where('id', '>', $id)->orderBy('id', 'asc')->first()->toArray();

        return ['prev' => $prev, 'next' => $next];
    }

    /**
     * 获取阅读量最多的文章列表.
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getArticleByViews(int $limit)
    {
        return Article::with('hasManyTag')->with(['hasManyCate' => function ($query) {
            $query->with('belongsToCategory');
        }])->orderByDesc('views')->limit($limit)->get();
    }

    /**
     * 根据时间, 获取文章列表, 存在缓存.
     * @return mixed
     */
    public function getAllArticleByTime()
    {
        $cacheName = __FUNCTION__;
        $cacheTtl = 3600;

        if ($cache = Cache::get($cacheName)) {
            return $cache;
        } else {
            $res = Article::with('hasManyTag')->with(['hasManyCate' => function ($query) {
                $query->with('belongsToCategory');
            }])->orderByDesc('updated_at')->get()->toArray();

            try {
                Cache::set($cacheName, $res, $cacheTtl);
            } catch (InvalidArgumentException $e) {
                abort(404);
            }
        }
    }
}
