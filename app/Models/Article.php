<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\InterfacesModels\TagsCommunicationType;
use App\Events\ArticleCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Illuminate\Support\Arr;

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

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($article) {
            $after = $article->getDirty();
            $article->history()->attach(auth()->user()->id, [
                'before' => json_encode(Arr::only($article->fresh()->toArray(), array_keys($after))),
                'after' => json_encode($after),
            ]);
        });
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'tagable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function history()
    {
        return $this->belongsToMany(User::class, 'article_histories')->withPivot('before', 'after')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
