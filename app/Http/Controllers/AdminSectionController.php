<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\News;
use App\Jobs\ItemCountReport;

class AdminSectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function news(News $news)
    {
        $news = $news->with('tags')->latest()->paginate(20);
        return view('admin.news', compact(['news']));
    }

    public function articles(Article $article)
    {
        $articles = $article->with('tags')->latest()->paginate(20);
        return view('admin.articles', compact(['articles']));
    }

    public function approvedArtile(Article $article)
    {
        $article->approved = !($article->approved);
        $article->save();
        $message = $article->approved ? 'Статья опубликована!' : 'Статья снята с публикации!';
        return redirect()->route('admin.articles')->with('success', $message);
    }

    public function approvedNews(News $news)
    {
        $news->approved = !($news->approved);
        $news->save();
        $message = $news->approved ? 'Новость опубликована!' : 'Новость снята с публикации!';
        return redirect()->route('admin.news')->with('success', $message);
    }

    public function reports()
    {
        return view('admin.reports.index');
    }

    public function totals()
    {
        return view('admin.reports.totals');
    }

    public function totalsProccess(Request $request)
    {
        $data = $request->input();
        ItemCountReport::dispatch($data);
        return redirect()->route('admin.reports')->with('success', 'Отчет успешно отправлен на почту!');
    }
}
