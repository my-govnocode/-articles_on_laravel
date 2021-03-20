<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index(Article $article)
    {
        $articles = $article->latest()->get();
        return view('articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(CreateArticleRequest $request)
    {
        Article::create($request->validated());

        return redirect('/articles/');
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(Article $article)
    {
        $validate = request()->validate([
            'code' => 'required|unique:articles,id|regex:/[a-zA-Z0-9_\-]+/',
            'title' => 'required||between:5,100',
            'short_message' => 'required|max:255',
            'message' => 'required',
        ]);
        
        $article->update($validate);

        return redirect('/articles/');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect('/articles/');
    }
}
