<?php

namespace App\Listeners;

use App\Events\ArticleUpdated;
use App\Mail\ArticleUpdated as MailArticleUpdated;
use Illuminate\Support\Facades\Mail;

class SendArticleUpdatedNotification
{
    /**
     * Handle the event.
     *
     * @param  ArticleCreated  $event
     * @return void
     */
    public function handle(ArticleUpdated $event)
    {
        Mail::to(config('app.MAIL_ADMIN'))->send(new MailArticleUpdated($event->article));
    }
}