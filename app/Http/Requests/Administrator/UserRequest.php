<?php

namespace App\Http\Requests\Administrator;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
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

        switch($this->method())
        {
            // CREATE
            case 'POST':
                {
                    return [
                        'name' => 'required|between:3,25',
                        'email' => 'required|email|unique:cmsuser,email',
                        'phone' => 'required|regex:/^1[3456789]\d{9}$/|unique:cmsuser,phone',
                        'password' => 'required|between:3,25'
                    ];
                }
            // UPDATE
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'name' => 'required|between:3,25',
                        'email' => 'required|email|unique:cmsuser,email,'. $this->user->id,
                        'phone' => 'required|regex:/^1[3456789]\d{9}$/|unique:cmsuser,phone,'. $this->user->id,
                        'password' => 'nullable|between:3,25'
                    ];
                }
            case 'GET':
            case 'DELETE':
            default:
                {
                    return [];
                };
        }
    }
}
