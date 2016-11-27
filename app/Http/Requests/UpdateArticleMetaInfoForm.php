<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleMetaInfoForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required_without:zh_title',
            'zh_title' => 'required_without:title',
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
        return array_merge($defaults, $this->only(['title', 'zh_title', 'description', 'zh_description']));
    }
}
