<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class AdminEditUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        $user = User::findOrFail($request->user);

        return [
            'email' => ['required','email','exists:email', Rule::unique('users')->ignore($user->id)],
            'name' =>'required|unique:users|min:6'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'آدرس ایمیل خود را وارد کنید.',
            'email.email' =>'آدرس ایمیل وارد شده معتبر نمی باشد.',
            'exists:email'=>'آدرس ایمیل وارد شده تکراری است.',
            'name.required' => 'نام کاربری را وارد کنید.',
            'name.unique'=> 'نام کاربری تکراری است.',
            'name.min' => 'نام کاربری حداقل ۶ کاراکتر باید داشته باشد',
        ];
    }
}
