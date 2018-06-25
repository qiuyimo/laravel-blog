<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Finder\Finder;
use App\Models\Article;
use App\Models\Category;
use App\Models\ArticleCategory;
use App\Models\Tag;

class ModifyMarkdownHeader extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'markdown:modify-header';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Modify markdown header';

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
    public function handle()
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

            if (count($header) > 10) {
                continue;
            }

            // 文件名称.
            $fileName = $file->getRelativePathname();

            // 获取文件名中的日期.
            preg_match('/^([0-9]{4}-[0-9]{2}-[0-9]{2})-[0-9a-zA-Z\-\.]*/', $fileName, $matchDate);
            $date = $matchDate[1] ?? '';
            if (! $date) {
                continue;
            }

            // 转换为数组格式.
            foreach ($header as $val) {
                $pos = strpos($val, ':');
                if ($pos !== false) {
                    $markdowns[$fileName][substr($val, 0, $pos)] = trim(substr($val, $pos + 1));
                }
            }

            // 纠正

            if (!isset($markdowns[$fileName]['create_time'])) {
                $markdowns[$fileName]['create_time'] = $date;
            }
            if (isset($markdowns[$fileName]['layout'])) {
                unset($markdowns[$fileName]['layout']);
            }
            if (isset($markdowns[$fileName]['keywords'])) {
                $markdowns[$fileName]['tag'] = $markdowns[$fileName]['keywords'];
            }
            if (isset($markdowns[$fileName]['categories'])) {
                $markdowns[$fileName]['category'] = $markdowns[$fileName]['categories'];
                unset($markdowns[$fileName]['categories']);
            }

            $str = "\n";
            foreach ($markdowns[$fileName] as $k => $v) {
                $str .= $k . ': ' . $v . "\n";
            }


            $mk = str_replace($match[2], $str, $file->getContents());

            file_put_contents($file->getRealPath(), $mk);
        }
    }
}
