<?php

namespace Oxygencms\Phrases\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminPhraseRequest extends FormRequest
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
        $key = $this->isMethod('POST') ? '' : $this->phrase->id;

        return [
            'group' => 'required|string|in:' . implode(',', config('phrases.groups')),
            'key' => "required|string|unique:phrases,key,$key,id,group,$this->group",

            'text' => 'array|distinct',
            'text.*' => 'nullable|string',
        ];
    }
}
