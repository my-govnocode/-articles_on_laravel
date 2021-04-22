<?php

namespace App\Listeners;

use App\Events\ArticleCreated;
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
        $mail = config('app.MAIL_ADMIN');

        if (!$mail) {
            return;
        }

        Mail::to(config('app.MAIL_ADMIN'))->send(new MailArticleCreated($event->article));
    }
}