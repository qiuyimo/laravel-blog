<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ArticleService;

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
        $urlName = request()->route('urlName');
        $createTime = request()->route('createTime');

        $markdown = $this->articleService->getArticleByUrl($urlName . '/' . $createTime);

        return view('article', $markdown);
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
