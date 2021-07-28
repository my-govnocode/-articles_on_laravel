<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\News;
use App\Services\CommentsCreator;

class CommentsController extends Controller
{
   public function article(Article $article, Request $request, CommentsCreator $commentsCreator)
   {
      $commentsCreator->create($article, $request);
      return redirect(route('articles.show', compact('article')))->with('success', 'Коментарий успешно оставлен!');
   }

   public function news(News $news, Request $request, CommentsCreator $commentsCreator)
   {
      $commentsCreator->create($news, $request);
      return redirect(route('news.show', compact('news')))->with('success', 'Коментарий успешно оставлен!');
   }
}
