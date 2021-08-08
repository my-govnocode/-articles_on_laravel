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

        $userWithLargeNumberArticles = User::whereHas('articles')->orderByDesc('articles_count')->withCount('articles')->first();

        $averageNumberArticles = Article::selectRaw('count(*) as count')
        ->groupBy('owner_id')
        ->havingRaw('count(*) > 1')
        ->get()
        ->avg('count');

        $articleDiscussed = Article::whereHas('comments')->orderByDesc('comments_count')->withCount('comments')->first();;

        $articleNoPermanent = Article::whereHas('history')->orderByDesc('history_count')->withCount('history')->first();

        return view('statistic', compact(['articlesCount', 'newsCount', 'articleMax', 'articleMin', 'userWithLargeNumberArticles', 'averageNumberArticles', 'articleDiscussed', 'articleNoPermanent']));
    }
}
