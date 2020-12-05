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
        return [
            'topic_id' => 'required|exists:topics,id',
            'level_id' => 'required|exists:levels,id',
            'title' => 'required',
            'description' => 'required',
            'newImages' => 'nullable|array|max:3',//se permiten máximo hasta 3 imágenes
            'newImages.*' => 'nullable|image|mimes:jpeg,jpg,png|max:1024', // 1MB Max
        ];
    }
}
