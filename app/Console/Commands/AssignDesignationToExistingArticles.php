<?php

namespace App\Console\Commands;

use App\Content\Article;
use App\Content\Category;
use Illuminate\Console\Command;

class AssignDesignationToExistingArticles extends Command
{

    protected $signature = 'articles:designate';


    protected $description = 'Assign existing articles to Taiwan or World';


    public function handle()
    {
        $c = Article::all()
                    ->reject(fn(Article $a) => !!$a->designation)
                    ->each(function (Article $article) {
                        if ($article->categories->contains(fn(Category $c) => $c->getTranslation('name',
                                'en') === 'Taiwan')) {
                            $article->designation = Article::TAIWAN;
                            $article->save();

                            return;
                        }

                        $article->designation = Article::WORLD;
                        $article->save();

                    });

        return 0;
    }
}
