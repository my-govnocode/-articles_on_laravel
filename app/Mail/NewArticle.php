<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Article;

class NewArticle extends Mailable
{
    use Queueable, SerializesModels;

    public $articles;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($articles)
    {
        $this->articles = $articles;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.article-new');
    }
}
