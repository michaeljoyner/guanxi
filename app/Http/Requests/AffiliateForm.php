<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AffiliateForm extends FormRequest
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
        $social = collect(config('social.allowed_platforms'))->flatMap(function($platform) {
            return $platform === 'email' ?  [$platform => 'email'] : [$platform => 'url'];
        })->toArray();
        return array_merge([
            'name' => 'required|max:255',
            'website' => 'url|max:255',
            'phone' => 'max:255'
        ], $social);
    }

    public function requiredFields()
    {
        $default = [
            'name' => '',
            'location' => '',
            'zh_location' => '',
            'writeup' => '',
            'zh_writeup' => '',
            'website' => null,
            'phone' => null
        ];

        return $this->transformFields(array_merge($default, $this->only(array_keys($default))));
    }

    public function socialLinkFields()
    {
        return collect($this->only(config('social.allowed_platforms')))->filter(function($link) {
            return $link;
        })->toArray();
    }

    protected function transformFields($fields)
    {
        return $this->resetEmptyStringFields($this->resetNullFields($fields));
    }

    protected function resetNullFields($fields)
    {
        $nullableFields = ['phone', 'website'];
        return collect($fields)->flatMap(function($value, $field) use ($nullableFields) {
            if(in_array($field, $nullableFields) && $value === '') {
                return [$field => null];
            }
            return [$field => $value];
        })->toArray();
    }

    protected function resetEmptyStringFields($fields)
    {
        $stringFields = ['location', 'zh_location', 'writeup', 'zh_writeup'];
        return collect($fields)->flatMap(function($value, $field) use ($stringFields) {
            if(in_array($field, $stringFields) && $value === null) {
                return [$field => ''];
            }
            return [$field => $value];
        })->toArray();
    }
}
