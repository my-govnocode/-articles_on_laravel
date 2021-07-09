<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\News;

class CommentsController extends Controller
{
   public function article(Article $article)
   {
       $data = $this->validate(request(), [
        'body' => 'required',
       ]);
       $data['owner_id'] = auth()->user()->id;

       $article->comments()->create($data);

    return redirect(route('articles.show', compact('article')))->with('success', 'Коментарий успешно оставлен!');
   }

   public function news(News $news)
   {
       $data = $this->validate(request(), [
        'body' => 'required',
       ]);
       $data['owner_id'] = auth()->user()->id;

       $news->comments()->create($data);

    return redirect(route('news.show', compact('news')))->with('success', 'Коментарий успешно оставлен!');
   }
}
