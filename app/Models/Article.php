<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\InterfacesModels\TagsCommunicationType;
use App\Events\ArticleCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model implements TagsCommunicationType
{
    use HasFactory;

    protected $table = 'articles';
    protected $dispatchEvents = [
        'created' => ArticleCreated::class,
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'owner_id',
        'code',
        'title',
        'short_message',
        'message',
        'approved',
        'created_at',
        'updated_at'
    ];




    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_article', 'article_id', 'tag_id', 'id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
