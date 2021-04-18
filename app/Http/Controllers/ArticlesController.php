<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Models\Article;
use App\Services\TagsSynchronizer;
use App\Notifications\ArticleCreationCompleted;
use App\Notifications\ArticleUpdateCompleted;
use App\Notifications\ArticleDeleteCompleted;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:update,article')->except(['index', 'store', 'create']);
    }

    public function index(Article $article)
    {
        $articles = auth()->user()->articles()->with('tags')->latest()->get();
        return view('articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        $tags = $article->tags;
        return view('articles.show', compact('article', 'tags'));
    }

    public function create()
    {
        $article = new Article();
        return view('articles.create', compact('article'));
    }

    public function store(CreateArticleRequest $request, TagsSynchronizer $tagsSynchronizer)
    {
        $data = $request->validated();
        $data['owner_id'] = auth()->id();
        $article =  Article::create($data);
        //event(new ArticleCreated($article));
        auth()->user()->notify(new ArticleCreationCompleted($article));

        if (isset($data['tags']) && !empty($data['tags'])) {
            $tagsSynchronizer->sync($data['tags'], $article);
        }

        return redirect()->route('articles')->with('success', 'Статья успешно создана!');
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(CreateArticleRequest $request, Article $article, TagsSynchronizer $tagsSynchronizer)
    {
        $data = $request->validated();
        $article->update($data);
        auth()->user()->notify(new ArticleUpdateCompleted($article));
        if (isset($data['tags']) && !empty($data['tags'])) {
            $tagsSynchronizer->sync($data['tags'], $article);
        }

        return redirect()->route('articles')->with('success', 'Статья успешно обновлена!');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        auth()->user()->notify(new ArticleDeleteCompleted($article));
        return redirect()->route('articles')->with('success', 'Статья успешно удалена!');
    }
}
