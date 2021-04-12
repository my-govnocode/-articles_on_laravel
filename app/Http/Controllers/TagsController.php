<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagsController extends Controller
{
    public  function index(Tag $tag)
    {
        return view('articles.index', ['articles' => $tag->articles]);
    }
}
