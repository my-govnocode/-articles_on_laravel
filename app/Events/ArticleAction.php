<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Interfaces\IActionMail;
use App\Mail\ArticleCreated;
use App\Mail\ArticleDeleted;
use App\Mail\ArticleUpdated;
use App\Models\Article;
use Illuminate\Contracts\Mail\Mailable;

class ArticleAction implements IActionMail
{
    use Dispatchable, SerializesModels;

    public $article;
    public $action;
    public const CREATED = 0;
    public const UPDATED = 1;
    public const DELETED = 2;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Article $article, int $action)
    {
        $this->article = $article;
        $this->action = $action;
    }

    public function toMail(): Mailable
    {
        switch ($this->action) {
            case self::CREATED:
                return new ArticleCreated($this->article);
            case self::UPDATED:
                return new ArticleUpdated($this->article);
            case self::DELETED:
                return new ArticleDeleted($this->article);
        }
    }
}
