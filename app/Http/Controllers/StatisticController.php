<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\News;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function index()
    {
        $articlesCount = Article::count();
        $newsCount = News::count();
        $articleMax = Article::select()->orderBy(DB::raw('LENGTH(message)'), 'DESC')->first();
        $articleMin = Article::select()->orderBy(DB::raw('LENGTH(message)'), 'ASC')->first();

        $userWithLargeNumberArticles = User::select()
        ->where('id', DB::table('articles')
            ->selectRaw('count(*) as count, owner_id')
            ->groupBy('owner_id')
            ->orderBy('count', 'DESC')
            ->first()
            ->owner_id)
        ->first();

        $averageNumberArticles = Article::selectRaw('count(*) as count')
        ->groupBy('owner_id')
        ->havingRaw('count(*) > 1')
        ->get()
        ->avg('count');

        $articleDiscussed = Article::select()
        ->where('id', DB::table('comments')
            ->selectRaw('count(*) as count, commentable_id')
            ->groupBy('commentable_id')
            ->orderBy('count', 'DESC')
            ->first()
            ->commentable_id)
        ->first();

        $articleNoPermanent = Article::select()
        ->where('id', DB::table('article_histories')
            ->selectRaw('count(*) as count, article_id')
            ->groupBy('article_id')
            ->orderBy('count', 'DESC')
            ->first()
            ->article_id)
        ->first();

        return view('statistic', compact(['articlesCount', 'newsCount', 'articleMax', 'articleMin', 'userWithLargeNumberArticles', 'averageNumberArticles', 'articleDiscussed', 'articleNoPermanent']));
    }
}
