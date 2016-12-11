<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotoForm extends FormRequest
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
            'title' => 'required|max:255'
        ];
    }

    public function requiredFields()
    {
        $defaults = [
            'title' => '',
            'zh_title' => '',
            'description' => '',
            'zh_description' => ''
        ];

        return array_merge(
            $defaults,
            collect($this->only(array_keys($defaults)))->reject(function($field) {
                return is_null($field);
            })->toArray());
    }
}
