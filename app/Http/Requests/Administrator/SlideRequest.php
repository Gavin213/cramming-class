<?php

namespace App\Http\Requests\Administrator;

class SlideRequest extends Request
{
    public function rules()
    {
        return [
            'group' => 'required|integer',
            'title' => 'required|min:1|max:255',
            'image' => 'required|max:255',
            'link' => 'required|url',
            'description' => 'nullable|max:255',
            'target' => 'required|min:1,max:255',
            'order' => 'nullable|integer',
            'status' => 'nullable|integer',
        ];
    }

    public function messages()
    {
        return [
            'image.required' => '图片不能为空.',
        ];
    }
}
