<?php

namespace Qihucms\Wechat\Requests\MiniApp;

use Illuminate\Foundation\Http\FormRequest;

class AppCodeRequest extends FormRequest
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
            'path' => ['required', 'max:255'],
            'width' => ['filled', 'integer'],
            'line_color' => ['filled', 'array'],
            'filename' => ['filled', 'max:126'],
        ];
    }

    /**
     * @return array|\Illuminate\Contracts\Translation\Translator|null|string
     */
    public function attributes()
    {
        return trans('attribute.app_code');
    }
}