<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Article
 *
 * @mixin \Eloquent
 */
class Article extends Model
{
    /**
     * @var string 定义表名
     */
    protected $table = 'article';

    /**
     * @var array todo. 这个是啥?
     */
    protected $guarded = [];

    /**
     * 一对多, 一个文章, 有多个tag. Article 对应多个 Tag, tag 表中有 article_id 字段.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hasManyTag()
    {
        return $this->hasMany(Tag::class);
    }

    /**
     * 一对多, 一个文章, 有多个分类.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hasManyCate()
    {
        return $this->hasMany(ArticleCategory::class);
    }
}
