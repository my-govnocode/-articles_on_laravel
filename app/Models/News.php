<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
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
}
