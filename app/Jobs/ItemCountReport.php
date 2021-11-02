<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\CountingElements;
use Illuminate\Support\Facades\Mail;
use App\Models\Article;
use App\Models\News;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\User;

class ItemCountReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $articles = isset($this->data['articles']) ? Article::count() : null;
        $news = isset($this->data['news']) ? News::count() : null;
        $tags = isset($this->data['tags']) ? Tag::count() : null;
        $comments = isset($this->data['comments']) ? Comment::count() : null;
        $users = isset($this->data['users']) ? User::count() : null;

        Mail::to(auth()->user()->email)->send(new CountingElements(['Статьи' => $articles, 'Новости' => $news, 'Теги' => $tags, 'Комментарии' => $comments, 'Пользователи' => $users]));
    }
}
