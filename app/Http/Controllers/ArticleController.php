<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ArticleService;
use Illuminate\Support\Facades\Event;
use App\Events\ArticlePageViews;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * @var ArticleService \App\Services\ArticleService
     */
    protected $articleService;

    /**
     * ArticleController constructor.
     * @param ArticleService $articleService
     */
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * 文章详细页.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function article()
    {
        $urlName = (string)request()->route('urlName');
        $createTime = (integer)request()->route('createTime');

        $article = $this->articleService->getArticleByUrl($urlName, $createTime);

        // 浏览事件
        Event::fire(new ArticlePageViews($article));
        return view('article', $article);
    }

    /**
     * 文章列表页.
     */
    public function list()
    {
        $page = (integer)(request()->route('page') ?: 1);

        $articles = $this->articleService->getArticleList();

        return view('articleList', ['articles' => $articles]);
    }
}
