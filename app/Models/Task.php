<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public static function scopeCompleted($query)
    {
        return $query->where('completed', 0)->get();
    }
}
