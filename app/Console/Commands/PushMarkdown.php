<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Finder\Finder;
use App\Models\Article;
use App\Models\Category;
use App\Models\ArticleCategory;
use App\Models\Tag;

class PushMarkdown extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'markdown:push';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'push markdown into table';

    /**
     * @var \Symfony\Component\Finder\Finder
     */
    protected $finder;

    /**
     * Create a new command instance.
     *
     * @param Finder $finder
     */
    public function __construct(Finder $finder)
    {
        $this->finder = $finder;
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(\Parsedown $parsedown)
    {
        // 获取到所有的 markdown 文件名称.
        $this->finder->files()->in(resource_path('markdown'));

        // 匹配出 YAML Front Matter, markdown 正文.
        $markdowns = [];
        foreach ($this->finder as $file) {
            // 匹配出 yamlFrontMatter.
            preg_match('/(---([\d\D]*)---)/U', $file->getContents(), $match);
            $header = explode("\n", trim($match[2] ?? ''));

            // 验证数据的 yamlFrontMatter 是否有效.
            // 没有 yamlFrontMatter 或者 超过10行, 或者没有title, create_time 信息, 则认为非有效数据.
            if (! $header) {
                continue;
            } else {
                $yamlFrontMatter = [];
                foreach ($header as $key => $val) {
                    $pos = strpos($val, ':');
                    $yamlFrontMatter[substr($val, 0, $pos)] = substr($val, ($pos + 1));
                }
            }
            if (! array_key_exists('title', $yamlFrontMatter)) {
                continue;
            }
            if (! array_key_exists('create_time', $yamlFrontMatter)) {
                continue;
            }
            if (isset($yamlFrontMatter['is_show']) && ($yamlFrontMatter['is_show'] == 0)) {
                continue;
            }
            if (count($header) > 10) {
                continue;
            }

            // 转换为数组格式.
            $markdowns[$file->getRelativePathname()]['markdown'] = trim(str_replace($match[1], '', $file->getContents()));
            foreach ($header as $val) {
                $pos = strpos($val, ':');
                if ($pos !== false) {
                    $markdowns[$file->getRelativePathname()][substr($val, 0, $pos)] = trim(substr($val, $pos + 1));
                }
            }
        }

        // 查询表, 不存在或者时间不一致, 则新增或者更新.
        foreach ($markdowns as $fileName => $markdown) {
            // 获取文章的数据.
            $article = [];
            $article['title'] = $markdown['title'];
            $article['url'] = $markdown['url'] ?? app('translug')->translug($article['title']);
            $article['description'] = $markdown['description'] ?? '';
            $article['keywords'] = $markdown['keywords'] ?? config('article.keywords.default');
            $article['weight'] = (integer)($markdown['weight'] ?? 0);
            $article['markdown'] = $markdown['markdown'];
            $article['html'] = $parsedown->text($article['markdown']);
            $article['created_at'] = $markdown['create_time'];
            $article['status'] = 1;
            $article['file_name'] = $fileName;

            // 事务.
            try {
                DB::beginTransaction();

                // 更新或者创建文章.
                $articleData = Article::query()->updateOrCreate(['url' => $article['url']], $article)->toArray();

                // 创建新分类. 记录 article category 的关系.
                $categories = explode(',', trim($markdown['category'] ?? ''));
                if ($categories) {
                    foreach ($categories as $key => $category) {
                        // 创建新分类
                        $categoryData = Category::query()->firstOrCreate(['name' => trim(strtoupper($category))], ['description' => '', 'image_url' => ''])->toArray();

                        // 记录 article category 的关系.
                        $articleCategory = [];
                        $articleCategory['article_id'] = $articleData['id'];
                        $articleCategory['category_id'] = $categoryData['id'];
                        ArticleCategory::query()->firstOrCreate($articleCategory)->toArray();
                    }
                }

                // 获取 tags, 记录到 tag 表中.
                $tags = explode(',', trim($markdown['tag'] ?? ''));
                if ($tags) {
                    foreach ($tags as $key => $tag) {
                        $tagInfo = [];
                        $tagInfo['article_id'] = $articleData['id'];
                        $tagInfo['tag_name'] = trim(strtoupper($tag));
                        Tag::query()->firstOrCreate($tagInfo)->toArray();
                    }
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();

                dump($e);
                die;
            }
        }

        dump('有效 article: ' . count($markdowns));
    }
}
