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

        return redirect('/articles/')->with('success', 'Статья успешно создана!');
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(CreateArticleRequest $request, Article $article)
    {
        $article->update($request->validated());

        return redirect('/articles/')->with('success', 'Статья успешно обновлена!');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect('/articles/')->with('success', 'Статья успешно удалена!');
    }
}
