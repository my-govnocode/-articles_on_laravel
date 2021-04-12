<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'code',
        'title',
        'short_message',
        'message',
        'created_at',
        'updated_at'
    ];




    public function tags()
    {
        return $this->belongsToMany(Tag::class, ArticleTag::class, 'article_id', 'tag_id', 'id', 'id');
    }
}
