<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        return 
        [
         'post.title' => 'required|string|max:100',
         'post.released_date' => 'required|regex:/^[0-9]+$/',
         'post.released_date' => 'required|regex:/^\d{1,4}$/',
         'name' => 'min:1', // 一つ目の名前フィールドは必須
         'name.*' => 'nullable|string|max:100', // 他の名前フィールドは任意
         'post.explanation' => 'required|string|max:300',
         'image_url' => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable',
         'external_link.*' => 'nullable|url',
         'external_link_explanation.*' => 'nullable|string|max:150',
         
            
        ];
    }
}
