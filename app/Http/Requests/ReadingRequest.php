<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReadingRequest extends FormRequest
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
            'topic_id' => 'required|exists:topics,id',
            'level_id' => 'required|exists:levels,id',
            'title' => 'required',
            'description' => 'required',
        ];

        if ($this->isMethod('POST')) {
            $rules += [
                'newImages' => 'nullable|array|max:3', //se permiten máximo hasta 3 imágenes
                'newImages.*' => 'nullable|image|mimes:jpeg,jpg,png|max:1024', // 1MB Max
            ];
        }
        if ($this->isMethod('PUT')) {
            $numberOfNewImages = $this->hasFile('newImages') ? count($this->file('newImages')) : 0;
            $numberOfOldImages = $this->has('oldImages') ? count($this->get('oldImages')) : 0;
            $totalImages = $numberOfNewImages + $numberOfOldImages;

            if ($totalImages > 3) {
                $rules += [
                    'numberOfImagesAllowed' => 'required',
                ];
            } else {
                $rules += [
                    'newImages' => 'nullable|array',
                    'oldImages' => 'nullable|array',
                    'newImages.*' => 'nullable|image|mimes:jpeg,jpg,png|max:1024', // 1MB Max
                ];
            }
        }
        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'numberOfImagesAllowed.required' => 'Solo se permiten hasta 3 imágenes'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            
        ];
    }
}
