<?php

namespace App\Http\Requests\Profile;

use App\Models\User;
use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class CredentialUpdateRequest extends FormRequest
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

    public function rules()
    {

        return [
            'email' => 'required|email|max:255|unique:users,email,' . $this->id,
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore(Auth::user()->id)],
            'password' => 'required|min:6|confirmed',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function getValidRequest()
    {
        //dd($this->password);
        return [
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ];
    }
}
