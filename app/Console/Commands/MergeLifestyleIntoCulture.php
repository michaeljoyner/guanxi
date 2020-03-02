<?php

namespace App\Console\Commands;

use App\Content\Article;
use Illuminate\Console\Command;

class MergeLifestyleIntoCulture extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:merge-lifestyle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Take all lifestyle articles and move into culture';

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
     * @return mixed
     */
    public function handle()
    {
        $articles = Article::with('categories')->get();

        $lifestyles = $articles
            ->filter(function($article) {
                return $article->categories->some(function($cat) {
                    return $cat->id === 4;
                });
            });

        $lifestyles->each(function($art) {
            $art->categories()->detach(4);
            $art->categories()->attach(3);
        });

    }
}
