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
        return $this->morphedByMany(Article::class, 'tagable');
    }

    public function news()
    {
        return $this->morphedByMany(News::class, 'tagable');
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
