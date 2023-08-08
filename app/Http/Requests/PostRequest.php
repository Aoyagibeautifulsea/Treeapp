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
        ['post.title' => 'required|string|max:100',
         'post.released_date' => 'required|regex:/^[0-9]+$/',
         'post.released_date' => 'required|regex:/^\d{1,4}$/',
         'name' => 'required|string|max:100',
         'post.explanation' => 'required|string|max:300',
         'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
         'external_link' => 'required|url',
         'external_link_explanation' => 'required|string|max:150',
         
            
        ];
    }
}
