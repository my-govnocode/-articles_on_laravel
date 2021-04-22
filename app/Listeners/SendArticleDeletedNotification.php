<?php

namespace App\Listeners;

use App\Events\ArticleDeleted;
use App\Mail\ArticleDeleted as MailArticleDeleted;
use Illuminate\Support\Facades\Mail;

class SendArticleDeletedNotification
{
    /**
     * Handle the event.
     *
     * @param  ArticleCreated  $event
     * @return void
     */
    public function handle(ArticleDeleted $event)
    {
        Mail::to(config('app.MAIL_ADMIN'))->send(new MailArticleDeleted($event->article));
    }
}