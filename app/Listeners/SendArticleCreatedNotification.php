<?php

namespace App\Listeners;

use App\Events\ArticleCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\ArticleCreated as MailArticleCreated;
use Illuminate\Support\Facades\Mail;

class SendArticleCreatedNotification
{
    /**
     * Handle the event.
     *
     * @param  ArticleCreated  $event
     * @return void
     */
    public function handle(ArticleCreated $event)
    {
        Mail::to(env('MAIL_ADMIN'))->send(
            new MailArticleCreated($event->article)
        );
    }
}
