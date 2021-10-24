<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\CountingElements;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
        $articles = isset($this->data['articles']) ? DB::table('articles')->count() : null;
        $news = isset($this->data['news']) ? DB::table($this->data['news'])->count() : null;
        $tags = isset($this->data['tags']) ? DB::table($this->data['tags'])->count() : null;
        $comments = isset($this->data['comments']) ? DB::table($this->data['comments'])->count() : null;
        $users = isset($this->data['users']) ? DB::table('users')->count() : null;

        Mail::to(auth()->user()->email)->send(new CountingElements(['Статьи' => $articles, 'Новости' => $news, 'Теги' => $tags, 'Комментарии' => $comments, 'Пользователи' => $users]));
    }
}
