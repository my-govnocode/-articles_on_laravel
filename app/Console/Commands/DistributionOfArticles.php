<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewArticle;
use App\Models\Article;
use App\Models\User;
use Carbon\Carbon;

class DistributionOfArticles extends Command
{
    private $to;
    private $from;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:distribution_of_articles {from?} {to?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->from = Carbon::today()->subDays(7)->toDateString();
        $this->to = Carbon::today()->toDateString();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();
        $from = $this->argument('from')?:$this->from;
        $to = $this->argument('to')?:$this->to;
        $articles = Article::whereBetween('created_at', [
            $from,
            $to
        ])->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new NewArticle($articles));
        }
    }
}
