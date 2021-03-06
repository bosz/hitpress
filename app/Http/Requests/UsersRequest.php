<?php

namespace hitpress\Http\Requests;

use hitpress\Http\Requests\Request;

class UsersRequest extends Request
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
            //
            'name'=>'required',
            'email'=>'required',
            'role_id'=>'required',
            'is_active'=>'required',
//            'photo_id'=>''
            'password'=>'required',
        ];
    }
}
