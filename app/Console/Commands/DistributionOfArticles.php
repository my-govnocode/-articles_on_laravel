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
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:distribution_of_articles {time=7}';

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
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();
        $time = $this->argument('time');
        $articles = Article::whereDate('created_at', '<', Carbon::now()->subDays(-$time)->toDateString())->get();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new NewArticle($articles));
        }
    }
}
