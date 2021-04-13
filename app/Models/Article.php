<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\InterfacesModels\TagsCommunicationType;

class Article extends Model implements TagsCommunicationType
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
        return $this->belongsToMany(Tag::class, 'tag_article', 'article_id', 'tag_id', 'id', 'id');
    }
}
