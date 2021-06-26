<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Models\Article;
use App\Services\TagsSynchronizer;
use App\Events\ArticleAction;
use App\Services\Pushall;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Article::class, 'article');
    }

    public function index(Article $article)
    {
        $articles = $article->where('approved', '=', true)->with('tags')->latest()->get();
        return view('articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        $tags = $article->tags;
        $comments = $article->comments->sortByDesc('created_at');
        return view('articles.show', compact('article', 'tags', 'comments'));
    }

    public function create()
    {
        $article = new Article();
        return view('articles.create', compact('article'));
    }

    public function store(CreateArticleRequest $request, TagsSynchronizer $tagsSynchronizer, Pushall $pushall)
    {
        $data = $request->validated();
        $data['owner_id'] = auth()->id();
        $article =  Article::create($data);
        event(new ArticleAction($article, ArticleAction::CREATED));
        $pushall->send($data['title'], $data['message'], route('articles.show', $article->code));

        if (isset($data['tags']) && !empty($data['tags'])) {
            $tagsSynchronizer->sync($data['tags'], $article);
        }
        return redirect()->route('articles.index')->with('success', 'Статья успешно создана!');
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(CreateArticleRequest $request, Article $article, TagsSynchronizer $tagsSynchronizer)
    {
        $data = $request->validated();
        $article->update($data);
        event(new ArticleAction($article, ArticleAction::UPDATED));
        if (isset($data['tags']) && !empty($data['tags'])) {
            $tagsSynchronizer->sync($data['tags'], $article);
        }

        return redirect()->route('articles.index')->with('success', 'Статья успешно обновлена!');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        event(new ArticleAction($article, ArticleAction::DELETED));
        return redirect()->route('articles.index')->with('success', 'Статья успешно удалена!');
    }
}
