<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class planRegisterRequest extends FormRequest
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
        $rules = [
            'title' => 'required',
            // 'country' => 'required',
            'start' => 'required',
            'end' => 'required',
            'public' => 'required',
        ];

        if ($this->has('country')) {
            $rules['country'] = 'required';
        }

        return $rules;
        // return [
        //     'title' => 'required',
        //     'country' => 'required',
        //     'start' => 'required',
        //     'end' => 'required',
        // ];
    }
}
