<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Finder\Finder;
use App\Models\Article;
use App\Models\Category;
use App\Models\InvalidMarkdown;
use App\Models\ArticleCategory;
use App\Models\Tag;

/**
 * 目的: 把 markdown 转化为表数据.
 * 涉及到的表: article, article_category, category, tag.
 *
 * 根据 markdown 中的 YAML Front Matter 包括:
 *      title, description, keywords, create_time, is_show, category, tag, [url], [weight].
 *
 * markdown 中第一个段落为 summary.
 *
 * Class PushMarkdown
 * @package App\Console\Commands
 */
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
     * @var array 所有 markdown 的文件名.
     */
    protected $fileNames;

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

        // 所有的文件名称组成的数组.
        $this->fileNames = [];
        foreach ($this->finder as $file) {
            $this->fileNames[] = $file->getRelativePathname();

            // 查询, 此 MD5 是否存在
            $md5 = md5($file->getContents());
            if (Article::query()->where('md5', $md5)->first(['id'])) {
                $this->info('此文章没有改变, title: ' . $file->getRelativePathname());
                continue;
            }

            // 匹配出 yamlFrontMatter.
            preg_match('/(---([\d\D]*)---)/U', $file->getContents(), $match);
            $header = explode("\n", trim($match[2] ?? ''));

            // 验证数据的 yamlFrontMatter 是否有效.
            // 没有 yamlFrontMatter 或者 超过10行, 或者没有title, create_time 信息, 则认为非有效数据.
            if (! $header) {
                $this->saveInvalid($file->getRelativePathname(), '没有 yaml front matter 信息');
                continue;
            } else {
                $yamlFrontMatter = [];
                foreach ($header as $key => $val) {
                    $pos = strpos($val, ':');
                    $yamlFrontMatter[substr($val, 0, $pos)] = substr($val, ($pos + 1));
                }
            }
            if (! array_key_exists('title', $yamlFrontMatter)) {
                $this->saveInvalid($file->getRelativePathname(), 'yaml front matter 信息中没有 title');
                continue;
            }
            if (! array_key_exists('create_time', $yamlFrontMatter)) {
                $this->saveInvalid($file->getRelativePathname(), 'yaml front matter 信息中没有 create_time');
                continue;
            }
            if (count($header) > 10) {
                $this->saveInvalid($file->getRelativePathname(), 'yaml front matter 信息大于 10 行');
                continue;
            }

            $md = trim(str_replace($match[1], '', $file->getContents()));

            $summary = trim(substr($md, 0, strpos($md, "\n\n")));
            if (in_array(mb_substr($summary, 0, 1), ['#', '*', '!', '`'])) {
                $summary = '';
            }

            // 转换为数组格式.
            $markdowns[$file->getRelativePathname()]['summary'] = $summary;
            $markdowns[$file->getRelativePathname()]['markdown'] = $md;
            $markdowns[$file->getRelativePathname()]['md5'] = md5($file->getContents());

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
            $article['status'] = (integer)($markdown['is_show']?? 1);
            $article['summary'] = $markdown['summary'];
            $article['file_name'] = $fileName;
            $article['md5'] = $markdown['md5'];

            // 事务.
            try {
                DB::beginTransaction();

                // 更新或者创建文章.
                $articleData = Article::query()->updateOrCreate(['url' => $article['url']], $article)->toArray();

                // 创建新分类. 记录 article category 的关系.
                $categories = explode(',', trim($markdown['category'] ?? ''));

                $categoryUpWord = [];
                if ($categories) {
                    foreach ($categories as $key => $category) {
                        $categoryUpWord[] = trim(strtoupper($category));
                        // 创建新分类
                        $categoryData = Category::query()->firstOrCreate(['name' => trim(strtoupper($category))], ['description' => '', 'image_url' => ''])->toArray();

                        // 记录 article category 的关系.
                        $articleCategory = [];
                        $articleCategory['article_id'] = $articleData['id'];
                        $articleCategory['category_id'] = $categoryData['id'];
                        ArticleCategory::query()->firstOrCreate($articleCategory)->toArray();
                    }
                }

                // 删除 markdown 中不存在, 但是 category 表中存在的分类.
                $categoryData = ArticleCategory::query()->with('belongsToCategory')->where('article_id', $articleData['id'])->get();
                if ($categoryData) {
                    $cate = [];
                    foreach ($categoryData->toArray() as $key => $val) {
                        $cate[$val['belongs_to_category']['name']] = $val;
                    }

                    $data = [];
                    foreach ($cate as $key => $val) {
                        $data[] = $val['belongs_to_category']['name'];
                    }
                    $res = collect($data)->flatten()->diff($categoryUpWord)->toArray();
                    if ($res) {
                        foreach ($res as $key => $val) {
                            ArticleCategory::query()->where('id', $cate[$val]['id'])->delete();
                            $this->warn('删除 article_category: ' . $cate[$val]['belongs_to_category']['name']);

                            if (!(ArticleCategory::query()->where('category_id', $cate[$val]['category_id'])->first(['id']))) {
                                Category::query()->where('id', $cate[$val]['category_id'])->delete();
                                $this->warn('删除 category: ' . $cate[$val]['belongs_to_category']['name']);
                            }
                        }
                    }
                }

                // 获取 tags, 记录到 tag 表中.
                $tags = explode(',', trim($markdown['tag'] ?? ''));
                if ($tags) {
                    $tagsUpWord = [];
                    foreach ($tags as $key => $tag) {
                        $tagsUpWord[] = trim(strtoupper($tag));
                        $tagInfo = [];
                        $tagInfo['article_id'] = $articleData['id'];
                        $tagInfo['tag_name'] = trim(strtoupper($tag));
                        Tag::query()->firstOrCreate($tagInfo)->toArray();
                    }

                    // 删除 markdown 中不存在, 但是 tag 表中存在的 tag.
                    $tagData = Tag::query()->where('article_id', $articleData['id'])->get(['tag_name'])->toArray();
                    if ($diff = collect($tagData)->flatten()->diff($tagsUpWord)->toArray()) {
                        foreach ($diff as $val) {
                            Tag::query()->where('article_id', $articleData['id'])->where('tag_name', $val)->delete();
                            $this->warn('删除tag: ' . $val);
                        }
                    }
                }

                DB::commit();

                $this->info('添加完毕, title: ' . $article['title']);
            } catch (\Exception $e) {
                DB::rollBack();

                dump($e);
                die;
            }
        }

        $this->info('最新保存 article: ' . count($markdowns));

        // 验证 article 表中的数据, 对应的 markdown 是否存在.
        $articles = Article::query()->get(['id', 'file_name'])->toArray();
        foreach ($articles as $key => $article) {
            if (! in_array($article['file_name'], $this->fileNames)) {
                $log = $article['file_name'] . ' 此文章已经不存在. id: ' . $article['id'];
                $this->error($log);

                $this->saveInvalid($article['file_name'], $log, 2);
            }
        }

        // 结束.
        $this->info('complete');
    }

    /**
     * 保存失效的 markdown 数据.
     * @param $fileName
     * @param $log
     * @param int $type
     */
    public function saveInvalid($fileName, $log, $type = 1)
    {
        InvalidMarkdown::query()->updateOrCreate(['file_name' => $fileName], ['log' => $log, 'type' => $type, 'updated_at' => date("Y-m-d H:i:s", time())]);
        $this->error('log: ' . $log . ' fileName: ' . $fileName);
    }
}
