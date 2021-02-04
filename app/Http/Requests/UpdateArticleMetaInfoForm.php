<?php

namespace App\Http\Requests;

use App\Content\Article;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateArticleMetaInfoForm extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'title' => 'required_without:zh_title',
            'zh_title' => 'required_without:title',
            'designation' => ['required', Rule::in([Article::TAIWAN, Article::WORLD])],
        ];
    }

    public function requiredAttributes()
    {
        $defaults = [
            'title' => '',
            'zh_title' => '',
            'description' => '',
            'zh_description' => ''
        ];
        return array_merge($defaults, $this->only(['title', 'zh_title', 'description', 'zh_description', 'designation']));
    }
}
