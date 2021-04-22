<?php

namespace App\Listeners;

use App\Events\ArticleCreated;
use App\Interfaces\IActionMail;
use App\Mail\ArticleCreated as MailArticleCreated;
use Illuminate\Support\Facades\Mail;

class ArticleActionListener
{
    /**
     * Handle the event.
     *
     * @param  IActionMail $event
     * @return void
     */
    public function handle(IActionMail $event)
    {
        $mail = config('app.MAIL_ADMIN');

        if (!$mail) {
            return;
        }

        Mail::to($mail)->send($event->toMail());
    }
}