<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ArticleService;
use Illuminate\Support\Facades\Event;
use App\Events\ArticlePageViews;

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

        $info = $article->toArray();

        $info['prevAndNextArticle'] = $this->articleService->getPrevAndNext($article->id);

        return view('article', $info);
    }

    /**
     * 文章列表页.
     */
    public function list()
    {
        $articles = $this->articleService->getArticleList();

        $info = [];
        foreach ($articles as $article) {
            $info[] = $article->toArray();
        }

        return view('articleList', ['articles' => $articles, 'info' => $info]);
    }

    /**
     * 时间轴页面.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function time()
    {
        $article = $this->articleService->getAllArticleByTime();

        return view('articleTime', ['articles' => $article]);
    }

    /**
     * tags页面.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tags()
    {
        $tags = $this->articleService->getTagInfo();

        return view('tags', ['tags' => $tags]);
    }
}
