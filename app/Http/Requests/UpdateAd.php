<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAd extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'min:3|max:50|string',
            'description' => 'max:200|string',
            'type' => 'in:free,paid',
            'start_date' => 'date|date_format:Y-m-d|after_or_equal:now',
            'category_id' => 'exists:categories,id',
            'user_id' => 'exists:users,id',
            'tags' => 'array|min:1',
            'tags.*' => 'exists:tags,id',
        ];
    }
}
