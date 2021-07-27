<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function index()
    {
        $articlesCount = DB::table('articles')->count();
        $newsCount = DB::table('news')->count();
        $articleMax = DB::table('articles')->select()->orderBy(DB::raw('LENGTH(message)'), 'DESC')->first();
        $articleMin = DB::table('articles')->select()->orderBy(DB::raw('LENGTH(message)'), 'ASC')->first();

        $userWithLargeNumberArticles = DB::table('users')
        ->select()
        ->where('id', DB::table('articles')
            ->selectRaw('count(*) as count, owner_id')
            ->groupBy('owner_id')
            ->orderBy('count', 'DESC')
            ->first()
            ->owner_id)
        ->first();

        $averageNumberArticles = DB::table('articles')
        ->selectRaw('count(*) as count')
        ->groupBy('owner_id')
        ->havingRaw('count(*) > 1')
        ->get()
        ->avg('count');

        $articleDiscussed = DB::table('articles')
        ->select()
        ->where('id', DB::table('comments')
            ->selectRaw('count(*) as count, commentable_id')
            ->groupBy('commentable_id')
            ->orderBy('count', 'DESC')
            ->first()
            ->commentable_id)
        ->first();

        $articleNoPermanent = DB::table('articles')
        ->select()
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
