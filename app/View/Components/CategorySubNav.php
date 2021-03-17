<?php

namespace App\View\Components;

use App\Content\Article;
use App\Content\Category;
use Illuminate\View\Component;

class CategorySubNav extends Component
{

    public function __construct(public string $designation = '')
    {
    }


    public function render()
    {
        return view('components.category-sub-nav');
    }

    public function categories()
    {
        return $this->getCategories()
                    ->map(fn(Category $category) => [
                        'url'   => localUrl("/categories/{$category->slug}?designation={$this->designation}"),
                        'title' => $category->getTranslation('name', app()->getLocale())
                    ]);
    }

    private function getCategories()
    {
        if ($this->designation === Article::TAIWAN) {
            return Category::forTaiwan()->get();
        }

        if ($this->designation === Article::TAIWAN) {
            return Category::forTaiwan()->get();
        }

        return Category::hasPublishedArticles()->get();
    }
}
