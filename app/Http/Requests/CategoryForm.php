<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryForm extends FormRequest
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
            'name' => 'required_without:zh_name',
            'zh_name' => 'required_without:name'
        ];
    }

    public function requiredAttributes()
    {
        $defaults = [
            'name'           => '',
            'zh_name'        => '',
            'description'    => '',
            'zh_description' => '',
            'writeup'        => '',
            'zh_writeup'     => ''
        ];
        return array_merge($defaults, $this->only(array_keys($defaults)));
    }
}
