<?php

namespace App\Http\Requests;

use App\Content\Article;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateArticleRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'lang' => 'required|in:en,zh',
            'designation' => ['required', Rule::in([Article::TAIWAN, Article::WORLD])],
        ];
    }

    public function translatedTitle(): array
    {
        $default = ['en' => "", 'zh' => ""];

        return array_merge($default, [$this->lang => $this->title]);
    }
}
