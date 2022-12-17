<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsersUpdateRequest extends FormRequest
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
        $emails = collect($this->users)->map(fn ($user) => $user['email']);
        return [
            'users' => ['required'],
            'users.*.id' => ['required', 'regex:/^[0-9]+$/i'],
            'users.*.name' => ['required', 'min:2', 'max:55'],
            'users.*.username' => ['required', 'min:2', 'max:55'],
            'users.*.email' => ['required', 'min:2', 'max:55', 'email',],
            'users.*.is_email_verified' => ['required', 'boolean',],
        ];
    }
}
