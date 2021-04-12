<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function articles()
    {
        return $this->belongsToMany(Article::class, ArticleTag::class, 'tag_id', 'article_id', 'id', 'id');
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    public static function tagsCloud()
    {
        return Tag::has('articles')->get();
    }
}
