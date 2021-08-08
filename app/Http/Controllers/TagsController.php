<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public  function index(Tag $tag)
    {
        return view('layouts.taggable', ['articles' => $tag->articles, 'news' => $tag->news]);
    }

    public  function news(Tag $tag)
    {
        return view('news.index', ['news' => $tag->news]);
    }
}
