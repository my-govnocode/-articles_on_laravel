<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ArticleChange implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $articleTitle;
    public $articleOld;
    public $articleNew;
    public $articleLink;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($article)
    {
        $this->articleTitle = $article->title;
        $this->articleOld = $article->history->sortByDesc('created_at')->last()->pivot->before;
        $this->articleNew = $article->history->sortByDesc('created_at')->last()->pivot->after;
        $this->articleLink = route('articles.show', $article->code);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('article-change');
    }

    public function broadcastAs()
    {
        return "article-change";
    }
}
