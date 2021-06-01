<?php

namespace App\Listeners;

use App\Interfaces\IActionMail;
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