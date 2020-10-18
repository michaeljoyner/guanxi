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
        return [
            'title' => $this->title ?? '',
            'zh_title' => $this->zh_title ?? '',
            'description' => $this->description ?? '',
            'zh_description' => $this->zh_description ?? '',
        ];
    }
}
