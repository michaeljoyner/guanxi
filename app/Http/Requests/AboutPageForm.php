<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutPageForm extends FormRequest
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
            //
        ];
    }

    public function storyContent()
    {
        return $this->attributeContent('story');
    }

    public function marketingContent()
    {
        return $this->attributeContent('marketing');
    }

    public function eventsContent()
    {
        return $this->attributeContent('events_text');
    }

    public function contributeContent()
    {
        return $this->attributeContent('contribute');
    }

    public function contactContent()
    {
        return $this->attributeContent('contact');
    }

    protected function attributeContent($attribute)
    {
        return [
            'en' => $this->{$attribute} ?? '',
            'zh' => $this->{'zh_' . $attribute} ?? ''
        ];
    }
}
