<?php

namespace App\Http\Requests\Administrator;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class BannerRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
//          create
            case 'POST': {
                return [
                    'name' => 'required|max:191',
                    'link' => 'required|max:191',
                    'img' => 'required|max:191',
                    'status' => 'required|'.Rule::in(['1','2']),
                ];
            }
//          update
            case 'PUT':
            case 'PATCH': {
                return [
                    'name' => 'required|max:191',
                    'link' => 'required|max:191',
                    'img' => 'required|max:191',
                    'status' => 'required|'.Rule::in(['1','2']),
                ];
            }
        }
    }
}
