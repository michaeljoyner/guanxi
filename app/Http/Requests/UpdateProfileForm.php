<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isSuperAdmin() || ($this->user()->id === $this->profile->user_id);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $social = collect(config('social.allowed_platforms'))->flatMap(function($platform) {
            return $platform === 'email' ?  [$platform => 'email'] : [$platform => 'url'];
        })->toArray();
        return array_merge([
            'name' => 'required|max:255'
        ], $social);
    }

    public function requiredFields()
    {
        $default = [
            'name'=> '',
            'title' => '',
            'zh_title' => '',
            'intro' => '',
            'zh_intro' => '',
            'bio' => '',
            'zh_bio' => ''
        ];

        $provided = collect($this->only(array_keys($default)))->filter(function($attribute) {
            return $attribute;
        })->toArray();

        return array_merge($default, $provided);
    }

    public function socialLinkFields()
    {
        return collect($this->only(config('social.allowed_platforms')))->filter(function($link) {
            return $link;
        })->toArray();
    }
}
