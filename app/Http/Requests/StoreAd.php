<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAd extends FormRequest
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
            'title' => 'required|min:3|max:50|string',
            'description' => 'required|min:3|max:200|string',
            'type' => 'required|in:free,paid',
            'start_date' => 'required|date|date_format:Y-m-d|after_or_equal:now',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'tags' => 'required|array|min:1',
            'tags.*' => 'exists:tags,id',
        ];
    }
}
