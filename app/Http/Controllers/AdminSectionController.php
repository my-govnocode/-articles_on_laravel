<?php

namespace App\Http\Controllers;

use App\Models\Article;


class AdminSectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Article $article)
    {
        $articles = $article->with('tags')->latest()->get();
        return view('admin.index', compact(['articles']));
    }

    public function approved(Article $article)
    {
        $article->approved = !($article->approved);
        $article->update();
        $message = $article->approved?'Статья опубликована!':'Статья снята с публикации!';
        return redirect()->route('admin.index')->with('success', $message);

    }
}
