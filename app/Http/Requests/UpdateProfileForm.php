<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileForm extends FormRequest
{

    public function authorize()
    {
        return $this->user()->isSuperAdmin() || ($this->user()->id === $this->profile->user_id);
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255'
        ];
    }

    public function requiredFields()
    {
        $default = [
            'name'     => '',
            'title'    => '',
            'zh_title' => '',
            'intro'    => '',
            'zh_intro' => '',
        ];

        $provided = collect($this->only(array_keys($default)))->filter(function ($attribute) {
            return $attribute;
        })->toArray();

        return array_merge($default, $provided);
    }
}
