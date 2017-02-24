<?php

namespace App\Http\Requests;


class StoreUser extends UpdateUser
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
        return array_merge( parent::rules(), [
            'password' => 'required|confirmed|min:2'
        ]);
    }
}
