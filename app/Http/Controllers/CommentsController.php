<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentsController extends Controller
{
   public function store(Article $article)
   {
       $data = $this->validate(request(), [
        'body' => 'required',
       ]);
       $data['article_id'] = $article->id;
       $data['owner_id'] = auth()->user()->id;

       $article->comments()->create($data);

    return redirect(route('articles.show', compact('article')))->with('success', 'Коментарий успешно оставлен!');
   }
}
