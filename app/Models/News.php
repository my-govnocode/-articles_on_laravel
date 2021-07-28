<?php

namespace App\Models;

use App\InterfacesModels\TagsCommunicationType;
use App\InterfacesModels\CommentsCommunicationType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use App\Models\Comment;

class News extends Model implements TagsCommunicationType, CommentsCommunicationType
{
    use HasFactory;
    
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
        return $this->morphToMany(Tag::class, 'tagable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

}
