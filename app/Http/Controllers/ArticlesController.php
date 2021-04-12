<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Models\Article;
use App\Models\Tag;
use App\Services\TagsSynchronizer;

class ArticlesController extends Controller
{
    public function index(Article $article)
    {
        $articles = $article->with('tags')->latest()->get();
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
        $article =  Article::create($data);

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
        if (isset($data['tags']) && !empty($data['tags'])) {
            $tagsSynchronizer->sync($data['tags'], $article);
        }

        return redirect()->route('articles')->with('success', 'Статья успешно обновлена!');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles')->with('success', 'Статья успешно удалена!');
    }
}
