<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
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
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => [
                'required',
                Rule::unique('posts', 'title')->ignore($this->post)
            ],
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
        ]
        +
        ($this->isMethod('POST') ? $this->store() : $this->update());
    }

    protected function store()
    {
       return [
           'thumbnail' => 'required|image|max:2048|mimes:png,jpg,jpeg'
       ];
    }

   protected function update()
   {
       return [
           'thumbnail' => 'nullable|image|max:2048|mimes:png,jpg,jpeg'
       ];
   }
}
