<?php

namespace App\View\Components;

use App\Content\Article;
use Illuminate\View\Component;

class CategoryBreadcrumbs extends Component
{

    public function __construct(public string $category, public string $designation = '')
    {}


    public function render()
    {
        return view('components.category-breadcrumbs');
    }

    public function designationLink(): string
    {
        if($this->designation === Article::WORLD) {
            return localUrl('/articles?designation=world');
        }

        if($this->designation === Article::TAIWAN) {
            return localUrl('/articles?designation=taiwan');
        }

        return localUrl('/articles');
    }

    public function designationText(): string
    {
        if($this->designation === Article::WORLD) {
            return 'world';
        }

        if($this->designation === Article::TAIWAN) {
            return 'taiwan';
        }

        return '';
    }
}
